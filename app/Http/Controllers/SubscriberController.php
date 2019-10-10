<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Http\Requests\Subscriber\StoreSubscriberRequest;
use App\Http\Requests\Subscriber\UpdateSubscriberRequest;
use App\Mail\Subscriber\SubscriberDeactivatedMail;
use App\Mail\Subscriber\SubscriberReactivatedMail;
use App\Mail\Subscriber\WelcomeSubscriberMail;
use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    /**
     * Instantiate a new controller instance.
     * Middleware.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('unpaid')->only(['update', 'updateStatus']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function indexData(Request $request)
    {
        $filters = $request->get('filters');
        // Search subscribers
        $subscribers = Subscriber::where('email', 'LIKE', '%'.$request->get('searchKeyword').'%');
        // If status is selected find that subscriber
        if ($filters['status']) {
            $subscribers->where('status', $filters['status']);
        }
        // Successfully response
        return response()->custom(200, "Subscribers!", $subscribers->orderBy('id', 'desc')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSubscriberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriberRequest $request)
    {
        // Find subscriber
        $subscriber = Subscriber::where('email', $request->get('email'))->first();
        // If subscriber does not exist
        if (!$subscriber) {
            // Create new subscriber
            $subscriber = new Subscriber;
            // Fill data
            $subscriber->fill($request->all());
            // Save subscriber
            if ($subscriber->save()) {
                // Successfully response
                return response()->custom(200, "Subscriber created!", [
                    'subscriber' => $subscriber,
                    'url' => Url::signedRoute('change-status-active', ['subscriber' => $subscriber->id])
                ]);
            };
            // Error response
            return response()->custom(400, "Subscriber not created!", null);
        }
        // Subscriber profile exist response
        return response()->custom(200, "Subscriber already exist!", $subscriber);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSubscriberRequest  $request
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriberRequest $request, Subscriber $subscriber)
    {
        // If request has status fill it
        if ($request->has('status')) {
            $subscriber->status = $request->get('status');
        }
        // Update subscriber
        if ($subscriber->update()) {
            // Send email
            sendMails($subscriber);
            // Successfully response
            return response()->custom(200, "Subscriber updated!", $subscriber);
        }
        // Error response
        return response()->custom(400, "Subscriber not updated!", $subscriber);
    }

    /**
     * Update status.
     *
     * @param  \App\Subscriber  $subscriber
     * @param  $status
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Subscriber $subscriber, $status)
    {
        // Change status
        if ($status == Constant::ACTIVE_STATUS) {
            $subscriber->status = Constant::ACTIVE_STATUS;
        } elseif ($status == Constant::INACTIVE_STATUS) {
            $subscriber->status = Constant::INACTIVE_STATUS;
        }
        // Update subscriber
        if ($subscriber->update()) {
            // Send email
            sendMails($subscriber);
            // Successfully response
            return redirect('/');
        }
        // Error response
        return redirect('/');
    }

    /**
     * User Payed.
     *
     * @param  \App\Subscriber  $subscriber
     * @param  $status
     * @return \Illuminate\Http\Response
     */
    public function updateActiveStatus(Subscriber $subscriber)
    {
        // Update status to Active
        $subscriber->status = Constant::ACTIVE_STATUS;
        // Update
        if ($subscriber->update()) {
            // Send mail
            Mail::to($subscriber->email)->queue((new WelcomeSubscriberMail($subscriber))->onQueue('emails'));
            // Successfully response
            return response()->custom(200, "Successfully activated!", $subscriber);
        }
        // Error response
        return response()->custom(400, "Unsuccessfully activated!", $subscriber);
    }

    /**
     * Send mail.
     *
     * @param  \App\Subscriber  $subscriber
     * @param  $status
     * @return \Illuminate\Http\Response
     */
    public function sendMail(Subscriber $subscriber)
    {
        // Send email
        sendMails($subscriber);
        // Successfully response
        return response()->custom(200, "Mail!", $subscriber);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        //
    }
}
