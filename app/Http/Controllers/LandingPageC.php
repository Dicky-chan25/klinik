<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageC extends Controller
{
    public function index(){
        return view('landing-page.index');
    }
}
