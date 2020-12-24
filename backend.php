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
// https://twitter.com/AmirMehrabian/status/1338489468538531840
$url = 'https://api.twitter.com/1.1/statuses/show/1338489468538531840.json';
$getfield = '&texst=';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$tweet = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)
             ->performRequest();

             $tweet = get_object_vars(json_decode($tweet));
            $user = get_object_vars($tweet['user']);
             var_dump($user['profile_image_url']);
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;



 function per_text($str)
{
    include_once('bidi.php');

    $text = explode("\n", $str);

    $str = array();

    foreach($text as $line){
        $chars = bidi::utf8Bidi(bidi::UTF8StringToArray($line), 'R');
        $line = '';
        foreach($chars as $char){
            $line .= bidi::unichr($char);
        }

        $str[] = $line;
    }

    return $str = implode("\n", $str);
}

// configure with favored image driver (gd by default)
Image::configure(array('driver' => 'imagick'));

// and you are ready to go ...

// $img->text('The quick brown fox jumps over the lazy dog.');

// write text at position
// $img->text('The quick brown fox jumps over the lazy dog.', 120, 100);

// use callback to define details

$width       = 500;
$height      = 500;
$center_x    = $width - 25;
$center_y    = 190;
$max_len     = 80;
$font_size   = 23;
$font_height = 17;

$text = $tweet['text'];

// $text = 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است';

$lines = explode("\n", wordwrap($text, $max_len));
$y     = $center_y - ((count($lines) - 1) * $font_height);
// $img   = Image::canvas($width, $height, '#777');
$img = Image::make('white.jpg');

echo $user['name'];
// Name
$img->text(per_text($user['name']), 250, 60, function($font) use ($font_size){
	$font->file('/var/www/html/pikaso/fonts/IRANSansWeb.ttf');
	$font->size(21);
	$font->color('#000');
	$font->align('center');
	$font->valign('top');
});

// Username
$img->text('(@'.$user['screen_name'].')', 250, 95, function($font) use ($font_size){
	$font->file('/var/www/html/pikaso/fonts/IRANSansWeb.ttf');
	$font->size(17);
	$font->color('#909090');
	$font->align('center');
	$font->valign('top');
});

// Date
$img->text(per_text($tweet['created_at']), 250, 120, function($font) use ($font_size){
	$font->file('/var/www/html/pikaso/fonts/IRANSansWeb.ttf');
	$font->size(15);
	$font->color('#00dcff');
	$font->align('center');
	$font->valign('top');
});

$watermark = Image::make('https://pbs.twimg.com/profile_images/1138606091971862529/8iTsLwr-_normal.png');
$watermark->circle($watermark->getWidth(), $watermark->getWidth()/2, $watermark->getHeight()/2, function ($draw) {
    $draw->background('#fff');
});
$img->insert($watermark, 'top-center', 10, 10);

foreach ($lines as $line)
{
    $img->text(per_text($line), $center_x, $y, function($font) use ($font_size){
		$font->file('/var/www/html/pikaso/fonts/IRANSansWeb.ttf');
		$font->size($font_size);
		$font->color('#111');
		$font->align('right');
		$font->valign('top');
    });

    $y += $font_height * 2;
}


// $img->text(per_text(''), 300, 450, function($font) {
//     $font->file('/var/www/html/pikaso/fonts/IRANSansWeb.ttf');
//     $font->size(54);
//     $font->color('#111');
//     $font->align('center');
//     $font->valign('top');
//     // $font->angle(45);
// });

$img->save('export/export.png');

// draw transparent text
// $img->text('foo', 0, 0, function($font) {
//     $font->color(array(255, 255, 255, 0.5));
// });