<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitba951c526d6b923e1e2962043986cbde
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitba951c526d6b923e1e2962043986cbde::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitba951c526d6b923e1e2962043986cbde::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitba951c526d6b923e1e2962043986cbde::$classMap;

        }, null, ClassLoader::class);
    }
}
