<?php

use App\Mail\Subscriber\SubscriberDeactivatedMail;
use App\Mail\Subscriber\SubscriberReactivatedMail;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Constant;

/**
 * Send mail for activate or deactivate
 *
 * @param $subscriber
 * @return mixed
 */
function sendMails($subscriber) {
    // Send email
    if ($subscriber->status == Constant::ACTIVE_STATUS) {
        Mail::to($subscriber->email)->queue((new SubscriberReactivatedMail($subscriber))->onQueue('emails'));
    } elseif ($subscriber->status == Constant::INACTIVE_STATUS) {
        Mail::to($subscriber->email)->queue((new SubscriberDeactivatedMail($subscriber))->onQueue('emails'));
    }
}
