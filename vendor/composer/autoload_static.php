<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit58f8beafe4e8ded3819fa50c0fd6371b
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit58f8beafe4e8ded3819fa50c0fd6371b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit58f8beafe4e8ded3819fa50c0fd6371b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
