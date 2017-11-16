Preview: www.timfenwick.co.uk

## Learns
If you plan to run $ php artisan make:auth, ALWAYS do this before working on the app.

It's possible that it overwrote my HomeController even though I answered no when adding auth.

If a page is redirecting to the login screen, look in its controllers __construct for a  $this->middleware('auth'); and remove it.
    