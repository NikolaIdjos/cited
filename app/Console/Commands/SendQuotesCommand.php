<?php

namespace App\Console\Commands;

use App\Mail\Quote\SendQuoteMail;
use App\Quote;
use App\Subscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendQuotesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:quote';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send quote';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Find subscribers
        $subscribers = Subscriber::with('lastQuote')->active()->get();
        // Foreach subscribers
        foreach ($subscribers as $subscriber) {
            // Find last quote or create first quote
            if (isset($subscriber->lastQuote[0])) {
                $nextQuote = Quote::where('id', '>', $subscriber->lastQuote[0]->id)->first();
            } else {
                $nextQuote = Quote::first();
            }
            // If next quote exist
            if ($nextQuote) {
                // Attach subscriber and quote
                $subscriber->quotes()->attach($nextQuote->id);
                // Send mail
                Mail::to($subscriber->email)->queue((new SendQuoteMail($subscriber, $nextQuote))->onQueue('emails'));
            }
        }
    }
}
