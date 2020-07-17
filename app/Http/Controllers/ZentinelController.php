<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZentinelController extends Controller
{
     public function index()
    {
        return view('zentinel');
    }
}
