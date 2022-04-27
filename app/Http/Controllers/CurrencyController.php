<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('currency-read');
        $data['currencies'] = Currency::orderBy('sort')->paginate()->appends($request->query());;

        return view('currency.all', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Currency $currency)
    {
        $this->authorize('currency-read');
        return view('currency.create', compact('currency'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Currency $currency)
    {
        $this->authorize('currency-create');
        $request->validate([
            'file' => 'mimes:png|dimensions:max_width=32,max_height=32',
            'sort' => 'required|unique:currencies,sort',
            'title' => 'required|unique:currencies,title',
            'name_fa' => 'required',
            'name_en' => 'required|string',
            'tag_name' => 'string',
            'deposit_confirm_count' => 'required',
            'decimals' => 'required',
            'withdraw_min' => 'required',
            'withdraw_fee' => 'required',
        ]);
        try {
            $currency->sort = $request->sort;
            $currency->title = strtoupper($request->title);
            $currency->name_fa = $request->name_fa;
            $currency->name_en = $request->name_en;
            $currency->deposit_confirm_count = $request->deposit_confirm_count;
            $currency->tag_name = $request->tag_name;
            $currency->decimals = $request->decimals;
            $currency->withdraw_min = $request->withdraw_min;
            $currency->withdraw_fee = $request->withdraw_fee;
            $currency->has_networks = $request->has_networks;
            $currency->status = $request->status;
            $currency->save();
        } catch (\Exception $th) {
            return back()->with('error', ' موفقیت آمیز نبود مجددا بررسی نمایید!');
        }

        return redirect()->route('currency.index')->with('success', 'عملیات با موفقیت انجام شد!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        $this->authorize('currency-update');

        return view('currency.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        $this->authorize('currency-update');
        
        $request->validate([
            'file' => 'mimes:png|dimensions:max_width=32,max_height=32',
            'sort' => 'required',
            'title' => ['required',Rule::unique('currencies')->ignore($currency->id)],
            'name_fa' => 'required',
            'name_en' => 'required|string',
            'tag_name' => 'nullable|string',
            'deposit_confirm_count' => 'required',
            'decimals' => 'required',
    
        ]);
        try {
            $currency->sort = $request->sort;
            $currency->title = strtoupper($request->title);
            $currency->name_fa = $request->name_fa;
            $currency->name_en = $request->name_en;
            $currency->deposit_confirm_count = $request->deposit_confirm_count;
            $currency->tag_name = $request->tag_name;
            $currency->decimals = $request->decimals;
            $currency->withdraw_min = $request->withdraw_min;
            $currency->withdraw_fee = $request->withdraw_fee;
            $currency->has_networks = $request->has_networks;
            $currency->status = $request->status;
            $currency->save();
        } catch (\Exception $th) {
            return back()->with('error', ' موفقیت آمیز نبود مجددا بررسی نمایید!');
        }

        return back()->with('success', 'عملیات با موفقیت انجام شد!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        $this->authorize('currency-delete');
        $currency->delete($currency);
        return back();
    }
}
