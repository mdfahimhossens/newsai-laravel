<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterMail;
use App\Models\User;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletter = Newsletter::where('user_id', Auth::id())->first();

        if ($newsletter) {
            return redirect()->route('newsletter.show');
        }

        return redirect()->route('newsletter.create');
    }

    public function create()
    {
        $newsletter = Newsletter::where('user_id', auth()->id())->first();

        if ($newsletter) {
            return redirect()->route('newsletter.show');
        }

        return view('frontend.newsletter-create');
    }

    public function store(Request $request)
    {
        $exists = Newsletter::where('user_id', auth()->id())->exists();

        if ($exists) {
            return redirect()->route('newsletter.show');
        }

        $request->validate([
            'title' => 'required|string|max:50',
            'days' => 'required|in:daily,weekly',
            'timezone' => 'required|string',
            'language' => 'required|string',
            'section_name' => 'required|string|max:50',
            'section_description' => 'nullable|string|max:500',
        ]);

        Newsletter::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'days' => $request->days,
            'timezone' => $request->timezone,
            'language' => $request->language,
            'section_name' => $request->section_name,
            'section_description' => $request->section_description,
        ]);

        return redirect()->route('newsletter.show')
                         ->with('success', 'Newsletter created successfully!');
    }

    public function show()
    {
        $newsletter = Newsletter::where('user_id', auth()->id())->firstOrFail();
        return view('frontend.newsletter', compact('newsletter'));
    }

    public function edit()
    {
        $newsletter = Newsletter::where('user_id', auth()->id())->firstOrFail();
        return view('frontend.setting', compact('newsletter'));
    }

    public function update(Request $request)
    {
        $newsletter = Newsletter::where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:50',
            'days' => 'required|in:daily,weekly',
            'timezone' => 'required|string',
            'language' => 'required|string',
            'section_name' => 'required|string|max:50',
            'section_description' => 'nullable|string|max:500',
        ]);

        $newsletter->update([
            'title' => $request->title,
            'days' => $request->days,
            'timezone' => $request->timezone,
            'language' => $request->language,
            'section_name' => $request->section_name,
            'section_description' => $request->section_description,
        ]);

        return redirect()->route('newsletter.show')
                         ->with('success', 'Newsletter updated successfully!');
    }

    public function send($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->queue(new NewsletterMail($newsletter));
        }

        $newsletter->update(['status' => 'sent']);

        return redirect()->route('newsletter.show')
                         ->with('success', 'Newsletter sent successfully!');
    }

    public function sendNewsletters()
    {
        $newsletters = Newsletter::all();
        $today = now();

        foreach ($newsletters as $newsletter) {
            if ($newsletter->days === 'daily') {
                $this->dispatchNewsletter($newsletter);
            } elseif ($newsletter->days === 'weekly' && $today->isSunday()) {
                $this->dispatchNewsletter($newsletter);
            }
        }

        return back()->with('success', 'All scheduled newsletters sent!');
    }

    protected function dispatchNewsletter($newsletter)
    {
        foreach (User::all() as $user) {
            Mail::to($user->email)->queue(new NewsletterMail($newsletter));
        }
    }
}
