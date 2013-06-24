# TwatAuth v0.1

## Pre-requisites
You'll need to sort out all of your oAuth tokens before you use the script. The short version of that is

1. Go to dev.twitter.com
2. Create an app in your timeline's name
3. Create your tokens inside the UI twitter provides

I wrote a blog post outlining the process a bit better here: <a href="http://blog.doot0.co.uk/blog/2013/06/14/how-to-get-your-tweet-timeline-with-oauth-plus-php/">http://blog.doot0.co.uk/blog/2013/06/14/how-to-get-your-tweet-timeline-with-oauth-plus-php/</a>

## What?
TwatAuth is a fairly crude way of retrieving your timeline of tweets using version 1.1 of Twitter's API.

1.1 requires the use of oAuth, which from what it seems, several people have trouble implementing. This script
is by no means a fully fledged solution to that problem: it's a stepping stone to understanding what's really
going on when you should be using oAuth properly.

## How?
This script is designed to be used in conjunction with an AJAX request.
A jQuery ```$.post('twatAuth.php')``` request is a a great way of requesting tweets from the script.