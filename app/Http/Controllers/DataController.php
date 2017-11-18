<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Data;
use Log;
use DateTime;

class DataController extends Controller
{
    public function populate() {
        $numberOfRecords = 5; // When needed/possible, how many records should we store?

        // Livingroom Data
        $dataRequest = @file_get_contents('https://murmuring-reaches-74774.herokuapp.com/data');
        if ($dataRequest && strpos($http_response_header[0], '200')) {
            $data = json_decode($dataRequest, true);
            Data::updateOrCreate([
                'name' => 'Temperature',
                'type' => 'Data',
                'caption' => 'The temperature reading of my living room',
            ],
            [
                'headline' => $data['temperature'] . ' &deg;C',
                'source_update_time' => $data['time']
            ]);
            Data::updateOrCreate([
                'name' => 'Light',
                'type' => 'Data',
                'caption' => 'The light reading of my living room',
            ],
            [
                'headline' => $data['light'] . ' light',
                'source_update_time' => $data['time']
            ]);
        }

        // Github
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
            for ($i = 0; $i < $numberOfRecords; $i++) {
                Data::updateOrCreate([
                    'name' => 'GitHub',
                    'type' => 'Data',
                    'headline' => explode('/', $data[0]['repo']['name'])[1],
                    'caption' => 'Repo updated',
                    'image_url' => 'https://assets-cdn.github.com/images/modules/logos_page/GitHub-Mark.png',
                ],
                [
                    'main_content_url' => str_replace('/repos', '', str_replace('api.', '', $data[0]['repo']['url'])),
                    'source_update_time' => str_replace('Z', '', str_replace('T', ' ', $data[0]['created_at']))
                ]);
            }
        }

        // GoodReads
        $dataRequest = @file_get_contents(
            'https://www.goodreads.com/review/list?v=2&id=' .
            env(GOODREADS_USER_ID) . '&key=' .
            env(GOODREADS_KEY) . '&shelf=read&sort=date_read&per_page=' .
            $numberOfRecords . '&page=1'
        );
        if ($dataRequest && strpos($http_response_header[0], '200')) {
            for ($i = 0; $i < $numberOfRecords; $i++) {
                $titleArray = explode('<title>', $dataRequest)[$i + 1];
                $title = explode('</title>', $titleArray)[0];

                $ratingArray = explode('<rating>', $dataRequest)[$i + 1];
                $rating = explode('</rating>', $ratingArray)[0];

                $linkArray = explode('<link>', $dataRequest)[$i + 1];
                $link = explode('</link>', $linkArray)[0];

                $imageArray = explode('<image_url>', $dataRequest)[$i + 1];
                $image = explode('</image_url>', $imageArray)[0];

                // Goodreads is using a fun date format... We have to convert:
                // Sat Oct 07 17:21:25 -0700 2017
                // into:
                // 2017-10-07 17:21:25
                $dateArray = explode('<read_at>', $dataRequest)[1];
                $dateString = explode('</read_at>', $dateArray)[0];
                $dateObject = DateTime::createFromFormat('D M d H:i:s e Y', $dateString);
                $formattedDate = explode('.', get_object_vars($dateObject)['date'])[0];
                Data::updateOrCreate([
                    'name' => 'Goodreads',
                    'type' => 'Data',
                    'headline' => $title,
                    'caption' => 'I rated this ' . $rating . ' out of 5',
                    'main_content_url' => $link,
                    'image_url' => $image,
                    'source_update_time' => $formattedDate
                ]);
            }
        }
    }

    public function render() {
        $data = collect(DB::select('SELECT * FROM data ORDER BY source_update_time DESC'))
            ->map(function($x){ return (array) $x; })
            ->toArray();
        return view('cards', ['cards' => $data]);
    }
}
