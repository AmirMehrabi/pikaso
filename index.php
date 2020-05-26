<?php

require 'vendor/autoload.php';

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
$center_y    = 150;
$max_len     = 80;
$font_size   = 23;
$font_height = 17;

$text = 'امیرمسعود می‌خواهمت و نمیدانی که چقدر مشتاااق دیدارم بس که تو را دوست دارم و می‌خواهم خوشحال ببینمت و عربی حرف نزنیم و گچپژ را پاااااس بداااااریییییییم و چه خوبی!';

$lines = explode("\n", wordwrap($text, $max_len));
$y     = $center_y - ((count($lines) - 1) * $font_height);
// $img   = Image::canvas($width, $height, '#777');
$img = Image::make('sample.jpg');


// Name
$img->text(per_text('امیر مهرابیان'), 415, 23, function($font) use ($font_size){
	$font->file('/var/www/html/pikaso/fonts/IRANSansWeb.ttf');
	$font->size(25);
	$font->color('#000');
	$font->align('right');
	$font->valign('top');
});


// Username
$img->text('@ammir_ir', 415, 57, function($font) use ($font_size){
	$font->file('/var/www/html/pikaso/fonts/IRANSansWeb.ttf');
	$font->size(17);
	$font->color('#909090');
	$font->align('right');
	$font->valign('top');
});

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