<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Data;
use App\Contact;

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
        return view('home', ['serverRender' => false]);
    }
    public function serverRendered()
    {
        $data = collect(DB::select('SELECT * FROM data ORDER BY source_update_time DESC'))
            ->map(function($x){ return (array) $x; })
            ->toArray();
        $contact = collect(DB::select('SELECT * FROM contact ORDER BY name'))
            ->map(function($x){ return (array) $x; })
            ->toArray();
        return view('home', ['serverRender' => true, 'data' => $data, 'contact' => $contact]);
    }
}
