<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb3d428b8bc4e0d1b046fcd9562c8f4f4
{
    public static $files = array (
        '941748b3c8cae4466c827dfb5ca9602a' => __DIR__ . '/..' . '/rmccue/requests/library/Deprecated.php',
        '13906c19e3d8fcd1341b24ed4d51cf72' => __DIR__ . '/..' . '/razorpay/razorpay/Deprecated.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WpOrg\\Requests\\' => 15,
        ),
        'R' => 
        array (
            'Razorpay\\Tests\\' => 15,
            'Razorpay\\Api\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WpOrg\\Requests\\' => 
        array (
            0 => __DIR__ . '/..' . '/rmccue/requests/src',
        ),
        'Razorpay\\Tests\\' => 
        array (
            0 => __DIR__ . '/..' . '/razorpay/razorpay/tests',
        ),
        'Razorpay\\Api\\' => 
        array (
            0 => __DIR__ . '/..' . '/razorpay/razorpay/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Requests' => __DIR__ . '/..' . '/rmccue/requests/library/Requests.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb3d428b8bc4e0d1b046fcd9562c8f4f4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb3d428b8bc4e0d1b046fcd9562c8f4f4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb3d428b8bc4e0d1b046fcd9562c8f4f4::$classMap;

        }, null, ClassLoader::class);
    }
}
