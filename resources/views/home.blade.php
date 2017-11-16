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
            .page {
                min-height: 130vh;
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
                font-size: 0.75rem;
                display: inline-block;
                vertical-align: top;
                line-height: 50px;
            }
            .card > .caption {
                font-size: 0.75rem;
                display: block;
                margin: 5px 5px 5px 70px;
            }
            .read-more {
                margin: 5px 5px 5px 70px;
            }
            .read-more > a {
                color: blue;
                font-size: 0.75rem;
                text-decoration: none;
                display: block;
            }
            /* @media only screen and (orientation: portrait) { */
            @media only screen and (max-width: 900px) {
                .card {
                    width: 80%;
                }
            }
            #more {
                position: fixed;
                left: 50%;
                bottom: 5%;
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
            .invisible {
                opacity: 0;
            }
            .transition-in {
                opacity: 1;
                transition: opacity 0.5s ease-in-out;
            }
        </style>
    </head>
    <body>
        <div class="welcome-pane page">
            <div id="introduction" class="content" tabindex="1">Hello.<br>My name is Tim.</div>
            <div class="card-container"></div>
            <button id="more" tabindex="-1">More</button>
        </div>
        <div class="card-pane page">
            <div id="feed" class="content" tabindex="1">Here's what I've been up to.</div>
            <a class="nav-link" href="#contact" tabindex="1">Press Tab to view this Section. Press Enter to go to the next Section</a>
            <div class="card-container data"></div>
        </div>
        <div class='about-pane page'>
            <div id="contact" class="content" tabindex="1">You can find me here.</div>
            <a class="nav-link" href="#feed" tabindex="1">Press Tab to view this Section. Press Enter to go to the previous Section</a>
            <div class="card-container contact"></div>
        </div>
    <script src="{{ asset('js/loadCards.js') }}"></script>
    </body>
</html>
