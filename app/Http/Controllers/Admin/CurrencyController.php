<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.currency.index', [
            'currencies' => Currency::getCurrencies(),
        ]);
    }

    public function currencyStatus(Request $request)
    {
        if ($request->mode == 'true') {
            Currency::where('id', $request->id)->update(['status' => 'active']);
        } else {
            Currency::where('id', $request->id)->update(['status' => 'inactive']);
        }

        return response()->json(['msg' => 'Status updated successfully.', 'status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        $data = $request->validated();
        return Currency::create($data)
            ? redirect()->route('currency.index')->with('success', 'Successfully created currency')
            : back()->with('errors', 'Error creating currency');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return $currency
            ? view('admin.currency.edit', compact('currency'))
            : back()->with('error', 'Date not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRequest $request, Currency $currency)
    {
        if ($currency) {
            $data = $request->validated();

            return $currency->fill($data)->save()
                ? redirect()->route('currency.index')->with('success', 'Successfully updated currency')
                : back()->with('errors', 'Error creating currency');
        } else {
            return back()->with('error', 'Date not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        if ($currency) {
            return $currency->delete()
                ? redirect()->route('currency.index')->with('success', 'Currency deleted successfully')
                : back()->with('error', 'Something went wrong');
        } else {
            return back()->with('error', 'Date not found');
        }
    }

    public function currencyLoad(Request $request)
    {
        session()->put('currency_code', $request->currency_code);
        $currency = Currency::where('code', $request->currency_code)->first();
        session()->put('currency_symbol', $currency->symbol);
        session()->put('currency_exchange_rate', $currency->exchange_rate);

        $response['status'] = true;

        return $response;
    }
}
