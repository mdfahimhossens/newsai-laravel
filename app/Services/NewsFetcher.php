<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewsFetcher
{
    /**
     * Fetch articles from GNews for a given section/keyword + language.
     * $section can be 'sports', 'technology' or any keyword.
     */
    public function fetch(string $section, string $language = 'en', int $limit = 6): array
    {
        $key = config('services.news.gnews.key');
        if (! $key) {
            Log::warning('GNews API key not configured.');
            return [];
        }

        $url = 'https://gnews.io/api/v4/search';

        try {
            $res = Http::timeout(10)->get($url, [
                'q' => $section,
                'lang' => $language,
                'max' => $limit,
                'token' => $key,
            ]);

            if (! $res->successful()) {
                Log::error('GNews API returned error: ' . $res->status());
                return [];
            }

            $json = $res->json();

            return collect($json['articles'] ?? [])->map(function($a){
                return [
                    'title' => $a['title'] ?? '',
                    'summary' => $a['description'] ?? '',
                    'url' => $a['url'] ?? '',
                    'source' => $a['source']['name'] ?? '',
                    'published_at' => $a['publishedAt'] ?? '',
                    'image' => $a['image'] ?? '',
                ];
            })->toArray();
        } catch (\Throwable $e) {
            Log::error('GNews fetch error: ' . $e->getMessage());
            return [];
        }
    }
}
