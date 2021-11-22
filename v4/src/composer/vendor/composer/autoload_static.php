<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit231d95a47f6057b22627d273d62614f7
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Directory\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Directory\\' => 
        array (
            0 => '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit231d95a47f6057b22627d273d62614f7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit231d95a47f6057b22627d273d62614f7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit231d95a47f6057b22627d273d62614f7::$classMap;

        }, null, ClassLoader::class);
    }
}
