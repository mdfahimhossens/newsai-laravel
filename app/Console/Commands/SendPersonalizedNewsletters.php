<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Newsletter;
use App\Services\NewsFetcher;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyNewsletter;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class SendPersonalizedNewsletters extends Command
{
    protected $signature = 'newsletter:send-personalized';
    protected $description = 'Send personalized newsletters per user preference (section_name)';

    protected $fetcher;

    public function __construct(NewsFetcher $fetcher)
    {
        parent::__construct();
        $this->fetcher = $fetcher;
    }

    public function handle()
    {
        $newsletters = Newsletter::with('user')->get();

        $groups = $newsletters->groupBy(function($n){
            $section = strtolower(trim($n->section_name ?: 'general'));
            $lang = $n->language ?? 'en';
            return $section . '__' . $lang;
        });

        foreach ($groups as $key => $group) {
            [$section, $lang] = explode('__', $key);

            $cacheKey = "news_section_{$section}_{$lang}";
            $newsItems = Cache::remember($cacheKey, now()->addMinutes(30), function() use ($section, $lang) {
                return $this->fetcher->fetch($section, $lang, 6);
            });

            if (empty($newsItems)) continue;

            foreach ($group as $nl) {
                $user = $nl->user;
                if (!$user || !$user->email) continue;

                // 🔹 Testing: send 2 min later
                Mail::to($user->email)
                    ->later(now()->addMinutes(1), new DailyNewsletter($newsItems, $nl));
            }
        }

        $this->info('Personalized newsletters queued (1 min delay).');
    }
}
