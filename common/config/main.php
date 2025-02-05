<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Europe/Moscow',  // Yii считает, что время в базе уже в этом часовом поясе
            'timeZone' => 'Europe/Moscow', // Отключаем конвертацию
            'datetimeFormat' => 'php:Y-m-d H:i:s',
        ],
    ],
];
