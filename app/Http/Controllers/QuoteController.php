<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quote\StoreQuoteRequest;
use App\Http\Requests\Quote\UpdateQuoteRequest;
use App\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Show quotes page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return view
        return view('admin.quotes.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function indexData(Request $request)
    {
        // Search quotes
        $quotes = Quote::where('description', 'LIKE', '%'.$request->get('searchKeyword').'%');
        // Successfully response
        return response()->custom(200, "Quotes!", $quotes->orderBy('id', 'desc')->paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreQuoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuoteRequest $request)
    {
        // Create new quote
        $quote = new Quote;
        // Fill data
        $quote->fill($request->all());
        // Save quote
        if ($quote->save()) {
            // Successfully response
            return response()->custom(200, "Quote saved!", $quote);
        }
        // Error response
        return response()->custom(400, "Quote not saved!", $quote);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuoteRequest $request, Quote $quote)
    {
        // Fill data
        $quote->fill($request->all());
        // Update quote
        if ($quote->update()) {
            // Successfully response
            return response()->custom(200, "Quote updated!", $quote);
        }
        // Error response
        return response()->custom(400, "Quote not updated!", $quote);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        try {
            // Delete quote
            $quote->delete();
            // Successfully response
            return response()->custom(200, "Quote deleted!", null);
        } catch (\Exception $e) {
            // Error response
            return response()->custom(400, "Quote not deleted!", null);
        }
    }
}
