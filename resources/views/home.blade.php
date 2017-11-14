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
                background-attachment: fixed;
                background-image: url({{asset('image/background.jpg')}});
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            .full-height {
                height: 100vh;
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

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
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

            .background {
                width: 100%;
                height: 100vh;
                position: fixed;
                background-image: url({{asset('image/background.jpg')}});
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            .top-bar {
                display: block;
                width: 80%;
                height: 100px;
                overflow: hidden;
                background-color: rgba(192,192,192,1.0);
                margin: auto;
            }
            .card-container {
                display: block;
                width: 80%;
                height: 600px;
                margin: auto;
                text-align: center;
            }
            .card {
                width: 45%;
                height: 250px;
                background-color: rgba(255,0,0,1.0);
                box-shadow: 2px 2px 1px #000000;
                display: inline-block;
                margin: 10px;
                float: left;
            }
            .invisible {
                visibility: hidden;
            }
        </style>
    </head>
    <body>
        <div class='top-bar'>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
        <div class='card-container'>
            @foreach ($cards as $card)
            <div class='card'>{{ $card['text'] }}</div>
            @endforeach
        </div>
    </body>
</html>
