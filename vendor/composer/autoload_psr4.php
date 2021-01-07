<?php
$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);
return array(
    'XdgBaseDir\\' => array($vendorDir . '/dnoegel/php-xdg-base-dir/src'),
    'Vsmoraes\\Pdf\\' => array($vendorDir . '/vsmoraes/laravel-pdf/src'),
    'SuperClosure\\' => array($vendorDir . '/jeremeamia/SuperClosure/src'),
    'Stringy\\' => array($vendorDir . '/danielstjules/stringy/src'),
    'Monolog\\' => array($vendorDir . '/monolog/monolog/src/Monolog'),
    'League\\Flysystem\\' => array($vendorDir . '/league/flysystem/src'),
    'Illuminate\\Html\\' => array($vendorDir . '/illuminate/html'),
    'Illuminate\\' => array($vendorDir . '/laravel/framework/src/Illuminate'),
    'ClassPreloader\\' => array($vendorDir . '/classpreloader/classpreloader/src'),
    'App\\' => array($baseDir . '/app'),
);
