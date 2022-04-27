<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteContentController extends Controller
{
    public function index()
    {
        $this->authorize('site-content-read');

        return view('siteContent.all');
    }
    public function update()
    {
        $this->authorize('site-content-update');
        return 'update SiteContentController';
    }
}
