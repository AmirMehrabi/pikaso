<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf6e30b78fd79c0482a6b5864079e3999
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
        ),
        'I' => 
        array (
            'Intervention\\Image\\' => 19,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Intervention\\Image\\' => 
        array (
            0 => __DIR__ . '/..' . '/intervention/image/src/Intervention/Image',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twitter\\Text\\' => 
            array (
                0 => __DIR__ . '/..' . '/nojimage/twitter-text-php/lib',
            ),
        ),
    );

    public static $classMap = array (
        'TwitterAPIExchange' => __DIR__ . '/..' . '/j7mbo/twitter-api-php/TwitterAPIExchange.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf6e30b78fd79c0482a6b5864079e3999::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf6e30b78fd79c0482a6b5864079e3999::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitf6e30b78fd79c0482a6b5864079e3999::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitf6e30b78fd79c0482a6b5864079e3999::$classMap;

        }, null, ClassLoader::class);
    }
}
