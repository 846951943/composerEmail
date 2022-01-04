<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc2c79f4ea730b4e8b83cdf565d50429d
{
    public static $prefixLengthsPsr4 = array (
        'Q' => 
        array (
            'Quan\\Email\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Quan\\Email\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc2c79f4ea730b4e8b83cdf565d50429d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc2c79f4ea730b4e8b83cdf565d50429d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc2c79f4ea730b4e8b83cdf565d50429d::$classMap;

        }, null, ClassLoader::class);
    }
}
