<?php
ini_set('display_errors', 1);
require_once('vendor/autoload.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "736459597-SWOhi44BIUzuUTdOrZ4XYVpYlbwFSjldP8OjzeFH",
    'oauth_access_token_secret' => "hsROJ4uFyLaNrF4One56u5bnxzxv6KIAh5qkwTlpFMwUJ",
    'consumer_key' => "fblz9XthCfG6m9iqCBbEWdJYF",
    'consumer_secret' => "Yj7k0ltvGQFPzN5tGN1ZFjXcF5caf0zFvQ2YZbiO8JVSNfMh1e"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
// $url = 'https://api.twitter.com/1.1/blocks/create.json';
// $requestMethod = 'POST';

// /** POST fields required by the URL above. See relevant docs as above **/
// $postfields = array(
//     'screen_name' => 'usernameToBlock', 
//     'skip_status' => '1'
// );

// /** Perform a POST request and echo the response **/
// $twitter = new TwitterAPIExchange($settings);
// echo $twitter->buildOauth($url, $requestMethod)
//              ->setPostfields($postfields)
//              ->performRequest();

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/statuses/show/1248659166857695238.json';
$getfield = '&texst=';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$tweet = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)
             ->performRequest();

             $tweet = get_object_vars(json_decode($tweet));
            $user = get_object_vars($tweet['user']);
             var_dump($user['profile_image_url']);