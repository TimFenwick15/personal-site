<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        return view('adminHome');
    }
    public function postArticle() {
        Data::create([
            'name' => 'Article',
            'type' => 'Article',
            'headline' => 'Article',
            'caption' => 'Article',
            'source_update_time' => 'Article',
        ]);
    }
}
