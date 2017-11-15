<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tim Fenwick</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #000000;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                font-size: 1.5rem;
                height: 100vh;
                margin: 0;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px;
            }

            .page {
                height: 130vh;
            }
            .welcome-pane {
                background-color: pink;
            }
            .card-pane {
                background-color: #ffffff;
            }
            .about-pane {
                background-color: #ADD8E6;
            }
            .content {
                font-size: 3rem;
                position: sticky;
                top: -1px;
                opacity: 1;
            }
            .card-container {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                box-sizing: border-box;
            }
            .card {
                position: relative;
                margin: 20px;
                padding-bottom: 30px;
                background: #fefff9;
                box-shadow: rgba(0, 0, 0, 0.5) 0 0 8px 0;
                border-radius: 4px;
                width: 30%;
                float: left;
            }
            #more {
                position: fixed;
                left: 50%;
                top:95%;
            }
            .invisible {
                opacity: 0;
            }
            .transition-in {
                opacity: 1;
                transition: opacity 1s ease-in-out;
            }
            .transition-out {
                opacity: 0;
                transition: opacity 1s ease-in-out;
            }
        </style>
    </head>
    <body>
        <div class='welcome-pane page'>
            <div class='content'>Hello.<br>My name is Tim.</div>
            <div class='card-container'></div>
            <button id='more'>More</button>
        </div>
        <div class='card-pane page'>
            <div class='content'>Here's what I've been up to.</div>
            <div class='card-container'></div>
        </div>
        <div class='about-pane page'>
            <div class='content'>You can find me here.</div>
            <div class='card-container'></div>
        </div>
    <script src="{{ asset('js/loadCards.js') }}"></script>
    </body>
</html>
