<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscriber\StoreSubscriberRequest;
use App\Http\Requests\Subscriber\UpdateSubscriberRequest;
use App\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
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
        // If status is selected
        if ($filters['status']) {
            $subscribers->where('status', $filters['status']);
        }
        // If type is selected
        if ($filters['type']) {
            $subscribers->where('type', $filters['type']);
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
        //
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
            // Successfully response
            return response()->custom(200, "Subscriber updated!", $subscriber);
        }
        // Error response
        return response()->custom(400, "Subscriber not updated!", $subscriber);
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
