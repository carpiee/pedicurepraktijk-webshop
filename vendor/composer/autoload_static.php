<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4598e1924a1df5c900df5f9de23207b6
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4598e1924a1df5c900df5f9de23207b6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4598e1924a1df5c900df5f9de23207b6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
