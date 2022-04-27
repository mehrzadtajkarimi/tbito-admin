<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('site-settings-read');

        $data['siteSetting'] = SiteSetting::where('editable', 1)->get();



        return view('setting.all', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SiteSetting $siteSetting)
    {
        $this->authorize('site-settings-create');
        $data['siteSetting'] = $siteSetting;
        return view('setting.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SiteSetting $siteSetting)
    {
        $this->authorize('site-settings-create');

        $data = $request->validate([
            'tag' => 'required',
            'key' => 'required',
            'value' => 'required',
            'title' => 'required',
            'text' => 'required',
        ]);


        // return $request->all();
        try {
            $siteSetting->tag = $request->tag;
            $siteSetting->key = $request->key;
            $siteSetting->value = $request->value;
            $siteSetting->title = $request->title;
            $siteSetting->text = $request->text;
            $siteSetting->editable = 1;
            $siteSetting->save();
        } catch (\Exception $th) {
            return back()->with('error', ' موفقیت آمیز نبود مجددا بررسی نمایید!');
        }

        return redirect()->route('site-setting.index')->with('success', 'عملیات با موفقیت انجام شد!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SiteSetting $siteSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteSetting $siteSetting)
    {
        $this->authorize('site-settings-update');
        $data['siteSetting'] = SiteSetting::where('editable', 1)->where('id', $siteSetting->id)->first();
        return view('setting.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteSetting $siteSetting)
    {
        $this->authorize('site-settings-update');

        $request->validate([
            'tag' => 'required',
            'key' => 'required',
            'value' => 'required',
            'title' => 'required',
            'text' => 'required',
        ]);

        try {
            $siteSetting->tag = $request->tag;
            $siteSetting->key = $request->key;
            $siteSetting->value = $request->value;
            $siteSetting->title = $request->title;
            $siteSetting->text = $request->text;
            $siteSetting->save();
        } catch (\Exception $th) {
            return back()->with('error', ' موفقیت آمیز نبود مجددا بررسی نمایید!');
        }

        return back()->with('success', 'عملیات با موفقیت انجام شد!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteSetting $siteSetting)
    {
        $this->authorize('site-settings-delete');
        $siteSetting->delete($siteSetting);
        return back();
    }
}
