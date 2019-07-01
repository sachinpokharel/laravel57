<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    //check the login
    /* if there is no login then it will redirect for loing
    */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('back.dashboard');
    }
}
