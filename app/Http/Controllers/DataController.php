<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use Log;

class DataController extends Controller
{
    public function populate() {
        // run a set of requests to populate the db

        // Livingroom Data
        $data = array( 'status' => false );
        //$user = Auth::user();
        $dataRequest = @file_get_contents('https://murmuring-reaches-74774.herokuapp.com/data');
        if ($dataRequest && strpos($http_response_header[0], '200')) {
            $data = json_decode($dataRequest, true);
            $data['status'] = true;
        }
        if ($data['status']) {
            Data::create([
                'name' => 'Temperature',
                'type' => 'Data',
                'headline' => $data['temperature'] . ' &deg;C',
                'caption' => 'The temperature of my living room',
            ]);
            Data::create([
                'name' => 'Light',
                'type' => 'Data',
                'headline' => $data['light'] . ' light',
                'caption' => 'The light of my living room',
            ]);
        }
    }
}
