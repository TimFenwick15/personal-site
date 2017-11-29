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
                height: 100vh;
                margin: 0;
            }
            .page {
                min-height: 130vh;
            }
            .intro-pane {
                background-color: pink;
            }
            .feed-pane {
                background-color: #ffffff;
            }
            .contact-pane {
                background-color: #ADD8E6;
            }
            .content {
                font-size: 4rem;
                position: sticky;
                top: -1px;
                background-color: inherit;
            }
            .card-container {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
            }
            .card {
                margin: 20px;
                padding-bottom: 30px;
                background: #fefff9;
                box-shadow: rgba(0, 0, 0, 0.5) 0 0 8px 0;
                border-radius: 4px;
                width: 30%;
            }
            .card > .image-circle {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                margin: 5px;
                overflow: hidden;
                display: inline-block;
            }
            img {
                width: 50px;
                height: auto;
                margin: 0 auto;
            }
            .card > .headline {
                min-height: 50px;
                width: 70%;
                margin: 5px;
                display: inline-block;
                vertical-align: top;
                line-height: 50px;
            }
            .card > .caption {
                display: block;
                margin: 5px 5px 5px 70px;
            }
            .read-more {
                margin: 5px 5px 5px 70px;
            }
            .read-more > a {
                color: blue;
                text-decoration: none;
                display: block;
            }
            /* @media only screen and (orientation: portrait) { */
            @media only screen and (max-width: 900px) {
                .card {
                    width: 80%;
                }
                .content {
                    font-size: 2rem;
                }
            }
            #more {
                position: fixed;
                /* left: 50%;
                bottom: 5%; */
                top: 0%;
                right: 0%;
            }
            .nav-link {
                position: relative;
                left: -9000px;
                width: 1px;
                height: 1px;
                overflow: hidden;
                text-align: left;
            }
            .nav-link:focus {
                left: 0;
                z-index: 1;
                width: 75%;
                height: auto;
            }
            .loading {
                width: 100%;
                text-align: center;
                position: fixed;
                top: 50%;
            }
            .invisible {
                opacity: 0;
            }
            .transition-in {
                opacity: 1;
                transition: opacity 0.5s ease-in-out;
            }
            .transition-out {
                opacity: 0;
                transition: opacity 0.5s ease-in-out;
            }
        </style>
    </head>
    <body>
        <textarea name="Text1" cols="40" rows="5"></textarea>
        <a href="{{ route('postArticle') }}"
            onclick="event.preventDefault();
                     document.getElementById('submit-form').submit();">
            Post
        </a>    

        <a href="{{ route('register') }}">
            Register
        </a>

        <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="submit-form" action="{{ route('postArticle') }}" method="POST" style="display: none;">
        </form>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </body>
</html>
