<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Data;
use Log;
use DateTime;

use App\Classes\TwitterAPIExchange;

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

                // php built in XML parsers don't like Goodreads data so we'll parse the response by hand
                $titleArray = explode('<title>', $dataRequest)[$i + 1];
                $title = explode('</title>', $titleArray)[0];

                $ratingArray = explode('<rating>', $dataRequest)[$i + 1];
                $rating = explode('</rating>', $ratingArray)[0];

                // There are a few <link> tags, the one we want always follows a <large_image_url/>
                $getCorrectLinkArray = explode('<large_image_url/>', $dataRequest)[$i + 1];
                $linkArray = explode('<link>', $getCorrectLinkArray)[1];
                $link = explode('</link>', $linkArray)[0];

                $imageArray = explode('<image_url>', $dataRequest)[$i + 1];
                $image = explode('</image_url>', $imageArray)[0];

                // Goodreads is using a fun date format... We have to convert:
                // Sat Oct 07 17:21:25 -0700 2017
                // into:
                // 2017-10-07 17:21:25
                $dateArray = explode('<read_at>', $dataRequest)[$i + 1];
                $dateString = explode('</read_at>', $dateArray)[0];

                // The Goodreads read date is optional so be careful about missing values
                $formattedDate = '';
                if ($dateString !== '') {
                    $dateObject = DateTime::createFromFormat('D M d H:i:s e Y', $dateString);
                    $formattedDate = explode('.', get_object_vars($dateObject)['date'])[0];
                }
                else
                    $formattedDate = 'Read date: Unkown';
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

        // Twitter
        $twitterSettings = array(
            'oauth_access_token' => env('oauth_access_token'),
            'oauth_access_token_secret' => env('oauth_access_token_secret'),
            'consumer_key' => env('consumer_key'),
            'consumer_secret' => env('consumer_secret')
        );
        $twitterUrl = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $twitterRequestMethod = 'GET';
        $twitterGetfields = '?screen_name=' . env('twitter_username') . '&count=5';
        $twitter = new TwitterAPIExchange($twitterSettings);
        $twitterResponse = json_decode($twitter
            ->setGetfield($twitterGetfields)
            ->buildOauth($twitterUrl, $twitterRequestMethod)
            ->performRequest()
        );
        foreach ($twitterResponse as $tweet) {
            // If the Tweet contains a URL or image, drop it because it isn't trivial to make this show well on the UI
            // If the Tweet is a reply, drop it because it won't make sense out of context
            if (
                !property_exists($tweet->entities, 'media') &&
                !sizeof($tweet->entities->urls) &&
                is_null($tweet->in_reply_to_status_id)
            ) {
                // Format the date. eg Fri Feb 02 18:40:21 +0000 2018
                $tweetDate = $tweet->created_at;
                $tweetDateObject = DateTime::createFromFormat('D M d H:i:s e Y', $tweetDate);
                $tweetDateFormatted = explode('.', get_object_vars($tweetDateObject)['date'])[0];

                // Build the URL to the Tweet
                $tweetURL = 'https://twitter.com/' . env('twitter_username') . '/status/' . $tweet->id_str;

                Data::updateOrCreate([
                    'name' => 'Tweet',
                    'type' => 'Data',
                    'headline' => 'I posted on Twitter',
                    'caption' => $tweet->text,
                    'main_content_url' => $tweetURL,
                    'image_url' => asset('image/Twitter_Logo_Blue.svg'),
                    'source_update_time' => $tweetDateFormatted
                ]);
            }
        }
    }
    public function render() {
        $data = collect(DB::select('SELECT * FROM data ORDER BY source_update_time DESC'))
            ->map(function($x){ return (array) $x; })
            ->toArray();
        return view('cards', ['cards' => $data, 'visible' => false]);
    }
}
