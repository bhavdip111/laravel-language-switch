<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    // Set Local language
    public function language(Request $request)
    {
        if($request->ajax())
        {
            $request->session()->put('locale', $request->locale);
            echo Session::get('locale');
        }
        else
        {
            echo app('translator')->getFromJson('Something went wrong.');
        }
    }
}
