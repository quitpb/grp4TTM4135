<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3bf0b51cb1c1b15c688c1f80465b2562
{
    public static $files = array (
        'bd9634f2d41831496de0d3dfe4c94881' => __DIR__ . '/..' . '/symfony/polyfill-php56/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'ttm4135\\' => 8,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Util\\' => 22,
            'Symfony\\Polyfill\\Php56\\' => 23,
            'Sonata\\GoogleAuthenticator\\' => 27,
            'Slim\\Views\\' => 11,
        ),
        'R' => 
        array (
            'ReCaptcha\\' => 10,
        ),
        'P' => 
        array (
            'Psr\\Cache\\' => 10,
            'PragmaRX\\Google2FA\\Tests\\' => 25,
            'PragmaRX\\Google2FA\\' => 19,
            'ParagonIE\\ConstantTime\\' => 23,
        ),
        'G' => 
        array (
            'Google\\Authenticator\\' => 21,
        ),
        'D' => 
        array (
            'Dolondro\\GoogleAuthenticator\\' => 29,
        ),
        'B' => 
        array (
            'Base32\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ttm4135\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Symfony\\Polyfill\\Util\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-util',
        ),
        'Symfony\\Polyfill\\Php56\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php56',
        ),
        'Sonata\\GoogleAuthenticator\\' => 
        array (
            0 => __DIR__ . '/..' . '/sonata-project/google-authenticator/src',
        ),
        'Slim\\Views\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/views',
        ),
        'ReCaptcha\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha',
        ),
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
        ),
        'PragmaRX\\Google2FA\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/pragmarx/google2fa/tests',
        ),
        'PragmaRX\\Google2FA\\' => 
        array (
            0 => __DIR__ . '/..' . '/pragmarx/google2fa/src',
        ),
        'ParagonIE\\ConstantTime\\' => 
        array (
            0 => __DIR__ . '/..' . '/paragonie/constant_time_encoding/src',
        ),
        'Google\\Authenticator\\' => 
        array (
            0 => __DIR__ . '/..' . '/sonata-project/google-authenticator/src',
        ),
        'Dolondro\\GoogleAuthenticator\\' => 
        array (
            0 => __DIR__ . '/..' . '/dolondro/google-authenticator/src',
        ),
        'Base32\\' => 
        array (
            0 => __DIR__ . '/..' . '/christian-riesen/base32/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
        'S' => 
        array (
            'Slim' => 
            array (
                0 => __DIR__ . '/..' . '/slim/slim',
            ),
        ),
    );

    public static $classMap = array (
        'PHPGangsta_GoogleAuthenticator' => __DIR__ . '/..' . '/phpgangsta/googleauthenticator/PHPGangsta/GoogleAuthenticator.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3bf0b51cb1c1b15c688c1f80465b2562::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3bf0b51cb1c1b15c688c1f80465b2562::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit3bf0b51cb1c1b15c688c1f80465b2562::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit3bf0b51cb1c1b15c688c1f80465b2562::$classMap;

        }, null, ClassLoader::class);
    }
}
