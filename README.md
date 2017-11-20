Preview: www.timfenwick.co.uk

## Learns
If you plan to run $ php artisan make:auth, ALWAYS do this before working on the app.

It's possible that it overwrote my HomeController even though I answered no when adding auth.

If a page is redirecting to the login screen, look in its controllers __construct for a  $this->middleware('auth'); and remove it.
    
### If JavaScript is disabled
If JavaScript is disabled, the page will show a link offering a server rendered version of the page.
Credit to: https://stackoverflow.com/questions/2489376/how-to-redirect-if-javascript-is-disabled :heart:

A better approach is 'progressive enhancement' where the page works by default without JavaScript and the page is enhanced if it is allowed. I designed the site to lazy load the main content to improve page load time so it would need redesigning to follow this approach.

An advantage of my approach is the initial page load is vastly improved by lazy loading content so the user gets something to look at ASAP.

### Accessibility
A disadvantage of my lazy loaded content is the page may not be fully loaded if a user it using the tab key to navigate the page. I haven't yet found a good solution to this.

I am using 'Skip to content' links which toggle to visible using CSS if a user is using tab to navigate the page.
