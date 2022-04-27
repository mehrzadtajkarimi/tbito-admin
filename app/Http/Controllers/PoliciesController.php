<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoliciesController extends Controller
{
    public function index(){
        $this->authorize('policies-read');

        return view('policies.all');
    }
    public function update(Request $request){
        $this->authorize('policies-update');

        return $request->all();
    }
}
