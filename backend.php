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
$tweeUrl = "https://twitter.com/FaridArzpeyma/status/1341981136306593793";
$url = 'https://api.twitter.com/1.1/statuses/show/'.basename($tweeUrl).'.json';
$getfield = '&tweet_mode=extended&texst=';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$tweet = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)
             ->performRequest();

             $tweet = get_object_vars(json_decode($tweet));
            $user = get_object_vars($tweet['user']);
             var_dump($tweet);
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

$pattern = "/[a-zA-Z]*[:\/\/]*[A-Za-z0-9\-_]+\.+[A-Za-z0-9\.\/%&=\?\-_]+/i";
$replacement = "";
$tweet['full_text'] = preg_replace($pattern, $replacement, $tweet['full_text']);

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
$text = $tweet['full_text'];
$max_len = 95;
$lines = explode("\n", wordwrap($text, $max_len));


// configure with favored image driver (gd by default)
Image::configure(array('driver' => 'imagick'));

$width       = 500;
$height      = 500;

if($tweet['lang'] == 'en') {
    $center_x    =  25;
} else {
    $center_x    = $width - 25;

}
$center_y    = 190;
$font_size   = 23;
$font_height = 17;
$max_len     = 80;


if(count($lines) < 4) {
    
    $font_size   = 23;
    $font_height = 17;


} elseif(count($lines) < 7) {
    $font_size   = 19;
    $font_height = 16;


} elseif(count($lines) <= 10){
    echo "we here";
    $font_size   = 16;
    $font_height = 13;
}



// $text = 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است';

// echo "<br><br><br><br>";
// var_dump(count($lines));
// echo "<br><br><br><br>";
// $y     = $center_y - ((count($lines) - 1) * $font_height);
$y = 150;
// echo "<br><br><br><br>";
// var_dump($y);
// echo "<br><br><br><br>";
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
$img->text(per_text(\Morilog\Jalali\Jalalian::forge($tweet['created_at'])->format('l j F Y - H:i')), 250, 120, function($font) use ($font_size){
	$font->file('/var/www/html/pikaso/fonts/IRANSansWeb.ttf');
	$font->size(15);
	$font->color('#00dcff');
	$font->align('center');
	$font->valign('top');
});

$watermark = Image::make($user['profile_image_url']);
$img->insert($watermark, 'top-center', 10, 10);
foreach ($lines as $line)
{
    $img->text( per_text($line), 250, $y, function($font) use ($font_size, $font_height, $tweet){
		$font->file('/var/www/html/pikaso/fonts/IRANSansWeb.ttf');
		$font->size($font_size);
        $font->color('#111');
        if($tweet['lang'] == 'en') {
            $font->align('center');
        } else {
            $font->align('center');        
        }
		$font->valign('top');
    });

    $y += $font_height + ($font_height - $font_height / 3);
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