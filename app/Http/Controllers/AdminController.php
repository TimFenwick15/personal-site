<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use Log;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        return view('adminHome');
    }
    public function postArticle(array $data) {
        Log::info('working!?!?');
        return Data::updateOrCreate([
            'headline' => $data->headline,
        ],
        [
            'name' => 'Article',
            'type' => 'Article',
            'caption' => $data->content,
            'source_update_time' => date("Y-M-d H:i:s"),
        ]);
    }
}
