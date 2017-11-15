<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Data;
use Log;

class DataController extends Controller
{
    public function populate() {
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
        $data = array( 'status' => false );
        $opts = [
            "http" => [
                'method' => 'GET',
                'header' => 'User-Agent: request',
            ]
        ];
        $context = stream_context_create($opts);
        $dataRequest = @file_get_contents('https://api.github.com/users/timfenwick15/events', false, $context);
        if ($dataRequest && strpos($http_response_header[0], '200')) {
            $data = json_decode($dataRequest, true);
        }
        Data::updateOrCreate([
            'name' => 'GitHub',
            'type' => 'Data',
            'headline' => explode('/', $data[0]['repo']['name'])[1],
            'caption' => 'Repo updated',
            'main_content_url' => $data[0]['repo']['url']
        ]);

        // GoodReads
        $dataRequest = @file_get_contents(
            'https://www.goodreads.com/review/list?v=2&id=' .
            env(GOODREADS_USER_ID) . '&key=' .
            env(GOODREADS_KEY) . '&shelf=read&sort=date_read&per_page=5&page=1'
        );
        if ($dataRequest && strpos($http_response_header[0], '200')) {
            $titleArray = explode('<title>', $dataRequest)[1];
            $title = explode('</title>', $titleArray)[0];
            $ratingArray = explode('<rating>', $dataRequest)[1];
            $rating = explode('</rating>', $ratingArray)[0];
            $linkArray = explode('<link>', $dataRequest)[1];
            $link = explode('</link>', $linkArray)[0];
            Data::updateOrCreate([
                'name' => 'Goodreads',
                'type' => 'Data',
                'headline' => $title,
                'caption' => 'I rated this ' . $rating . ' out of 5',
                'main_content_url' => $link,
            ]);
        }
    }
    public function render() {
        $data = collect(DB::select('SELECT * FROM data'))
            ->map(function($x){ return (array) $x; })
            ->toArray();
        return view('cards', ['cards' => $data]);
    }
}
