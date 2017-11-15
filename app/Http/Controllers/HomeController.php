<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;
use App\Data;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
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
    /*public function cards($type) {
        Log::info($type);
        //Data::select('SELECT *jk') // should be able to do something like this
        $data = collect(DB::select('SELECT * FROM data WHERE type="' . $type . '"'))
            ->map(function($x){ return (array) $x; })
            ->toArray();
        return view('cards', ['cards' => $data]);
    }
    public function contact() {
        $data = collect(DB::select('SELECT * FROM data WHERE type="Contact"'))
            ->map(function($x){ return (array) $x; })
            ->toArray();
        return view('cards', ['cards' => $data]);
    }*/
}
