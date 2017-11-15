<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Data;
use Log;

class DataController extends Controller
{
    public function populate() {
        // run a set of requests to populate the db

        // Livingroom Data
        $data = array( 'status' => false );
        $dataRequest = @file_get_contents('https://murmuring-reaches-74774.herokuapp.com/data');
        if ($dataRequest && strpos($http_response_header[0], '200')) {
            $data = json_decode($dataRequest, true);
            $data['status'] = true;
        }
        if ($data['status']) {
            Data::updateOrCreate([
                'name' => 'Temperature',
                'type' => 'Data',
                'headline' => $data['temperature'] . ' &deg;C',
                'caption' => 'The temperature of my living room',
            ]);
            Data::updateOrCreate([
                'name' => 'Light',
                'type' => 'Data',
                'headline' => $data['light'] . ' light',
                'caption' => 'The light of my living room',
            ]);
        }

        // Github
        /*$data = array( 'status' => false );
        $dataRequest = @file_get_contents('https://api.github.com/users/timfenwick15/events');
        Log::info($http_response_header[0]);
        Log::info($dataRequest);
        if ($dataRequest && strpos($http_response_header[0], '200')) {
            $data = json_decode($dataRequest, true);
            $data['status'] = true;
        }
        // for now, I'll just grab most recent
        Log::info($data);*/

    }
    public function render() {
        $data = collect(DB::select('SELECT * FROM data'))
            ->map(function($x){ return (array) $x; })
            ->toArray();
        return view('cards', ['cards' => $data]);
    }
}
