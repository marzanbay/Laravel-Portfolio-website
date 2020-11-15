<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolicyConroller extends Controller
{
    function PolicyPage(){
        return view('Policy') ;
    }
}
