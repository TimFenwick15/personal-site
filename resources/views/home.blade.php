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
                font-family: 'helvetica', sans-serif;
                height: 100vh;
                margin: 0;
            }
            .page {
                min-height: 150vh;
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
                z-index: 1;
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
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
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
                display: none;
            }
            .transition-in {
                display: block;
                opacity: 1;
                transition: opacity 0.5s ease-in-out;
            }
            .transition-out {
                opacity: 0;
                transition: opacity 0.5s ease-in-out;
            }
            button {
                display: inline-block;
                border: none;
                padding: 1rem 2rem;
                margin: 0 auto;
                text-decoration: none;
                background: #ffffff;
                color: #000000;
                font-family: sans-serif;
                font-size: 2rem;
                cursor: pointer;
                text-align: center;
                box-shadow: rgba(0, 0, 0, 0.5) 0 0 8px 0;
                border-radius: 4px;
            }
            .personal-image {
                background: white;
                box-shadow: rgba(0, 0, 0, 0.5) 0 0 8px 0;
                border-radius: 4px;
                padding: 10px 10px 50px 10px;
                width: 50%;
                display: block;
                position: absolute;
                transition: all 0.5s ease;
            }
            .flight {
                margin: 5vh auto auto 40%;
                transform: rotate(5deg);
            }
            .sheffield {
                margin: 40vh auto auto 10%;
                transform: rotate(-5deg);
            }
            .flight:hover, .sheffield:hover{
                transform: rotate(0deg) scale(1.2);
                box-shadow: rgba(0, 0, 0, 0.5) 0 0 16px 0;
                z-index: 2;
            }
            @media only screen and (max-width: 900px) {
                .card {
                    width: 80%;
                }
                .content {
                    font-size: 2rem;
                }
                .personal-image {
                    width: 70%;
                    margin: 10vh auto;
                    position: relative;
                }
            }
        </style>
    </head>
    <body>
        @if (!$serverRender)
            <noscript>
                <p>This site is best viewed with Javascript. If you are unable to turn on Javascript, please use this <a href="/home">site</a>.</p>
            </noscript>
        @endif
        <div class="intro-pane page">
            <div id="introduction" class="content" tabindex="1">Hello 👋☕️<br>My name is Tim.</div>
            <img class='personal-image flight' alt="View through plane window" src="{{ secure_asset('image/personal.jpg') }}"></img>
            <img class='personal-image sheffield' alt="Image of Sheffield sunset" src="{{ secure_asset('image/sheffield.jpg') }}"></img>
        </div>

        <div class="feed-pane page">
            <div id="feed" class="content data" tabindex="1">Here's what I've been up to 💻📚</div>
            <a class="nav-link" href="#contact" tabindex="1">Press Tab to view this Section. Press Enter to go to the next Section</a>
            <div class="card-container">
                @if ($serverRender)
                    @include('cards', ['cards' => $data, 'visible' => true])
                @endif
            </div>
            <button class="more-cards invisible" tabindex="1">More</button>
        </div>

        <div class='contact-pane page'>
            <div id="contact" class="content contact" tabindex="1">You can find me here 📱🗺️</div>
            <a class="nav-link" href="#feed" tabindex="1">Press Tab to view this Section. Press Enter to go to the previous Section</a>
            <div class="card-container">
                @if ($serverRender)
                    @include('cards', ['cards' => $contact, 'visible' => true])
                @endif
            </div>
            <button class="more-cards invisible" tabindex="1">More</button>
        </div>

        <button id="more" tabindex="-1" style="display:none">More</button>
        <div class="loading invisible">Loading...</div>
    @if (!$serverRender)
        <script src="{{ secure_asset('js/script.js') }}"></script>
    @endif
    </body>
</html>
