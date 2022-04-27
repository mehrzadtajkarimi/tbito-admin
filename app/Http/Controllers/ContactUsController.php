<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $this->authorize('contact-us-read');
        $data['contactUs'] = ContactUs::all();

        return view('contactUs.all', compact('data'));
    }
}
