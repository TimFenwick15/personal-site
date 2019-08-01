www.timfenwick.co.uk

## Learns
### Laravel
If you plan to run $ php artisan make:auth, ALWAYS do this before working on the app.

It's possible that it overwrote my HomeController even though I answered no when adding auth.

If a page is redirecting to the login screen, look in its controllers __construct for a  $this->middleware('auth'); and remove it.

Middleware didn't seem to be working with post requests (failing silently) so they couldn't be used with other controller methods which use the auth middleware.
Instead, make a seperate controller with each method to control a backend resource.

You can say $ php artisan make:request <request_name>
The advantage of doing this is you get a rules method where you can specify the fields that must exists for the server to accept a request.
This also handles authorisation.

To add a new page:
- Make a new controller
- Make a new PHP file in the App folder
- Add a route to web.php
- Add a new database migration
- Log into the Homestead VM ($ vagrant ssh)
- Run database migrations
    
### If JavaScript is disabled
If JavaScript is disabled, the page will show a link offering a server rendered version of the page.
Credit to: https://stackoverflow.com/questions/2489376/how-to-redirect-if-javascript-is-disabled :heart:

A better approach is 'progressive enhancement' where the page works by default without JavaScript and the page is enhanced if it is allowed. I designed the site to lazy load the main content to improve page load time so it would need redesigning to follow this approach.

An advantage of my approach is the initial page load is vastly improved by lazy loading content so the user gets something to look at ASAP.

### Accessibility
A disadvantage of my lazy loaded content is the page may not be fully loaded if a user it using the tab key to navigate the page. I haven't yet found a good solution to this.

I am using 'Skip to content' links which toggle to visible using CSS if a user is using tab to navigate the page.

### Twitter Integration
The Twitter API uses OAuth which requires several steps before a valid request can be made.

I'm using the https://github.com/J7mbo/twitter-api-php repo to acomplish this. :heart:

The TwitterAPIExchange.php file in the Controllers directory is lifted from there.

I didn't see this in the API docs; if a Tweet is longer than 140 characters, it will be truncated by default. You should include $extended=true in the URL if you want to recieve the full Tweet, regardless of length. In this case, the Tweet will be under the "full_text" JSON key instead of "text".

### Problems
Currently, if you visit /logout while not authenticated, you get an error page.
It's not that this is something I expect a user to do, but I'd rather the app didn't blow up if someone attempts this.

Haven't worked out how to authenticate api methods. I've tried:
- Adding middleware to the route - this seems to block the request
- In postArticleRequest, use Auth::check() in the authorize method - this is returning null. https://laravel.io/forum/03-22-2016-authcheck-not-working suggested adding 'web' middleware but then I run into the same problem above that middleware seems to block the request without an error - try again, blocking this endpoint for now
