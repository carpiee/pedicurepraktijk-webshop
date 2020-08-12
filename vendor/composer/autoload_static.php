<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4598e1924a1df5c900df5f9de23207b6
{
    public static $files = array (
        'e34dbeb3d0f25df7a8b2bc3b82786feb' => __DIR__ . '/..' . '/cekurte/environment/src/env.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
        'C' => 
        array (
            'Cekurte\\Environment\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
        'Cekurte\\Environment\\' => 
        array (
            0 => __DIR__ . '/..' . '/cekurte/environment/src',
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