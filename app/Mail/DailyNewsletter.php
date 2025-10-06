<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyNewsletter extends Mailable
{
   use Queueable, SerializesModels;

    public $newsItems;   // array
    public $newsletter;  // Newsletter model instance

    public function __construct(array $newsItems, $newsletter)
    {
        $this->newsItems = $newsItems;
        $this->newsletter = $newsletter;
    }

    public function build()
    {
        return $this->subject($this->newsletter->title . ' — ' . now()->toDateString())
                    ->markdown('emails.daily_newsletter')
                    ->with([
                        'newsItems' => $this->newsItems,
                        'newsletter' => $this->newsletter,
                    ]);

    }
}
