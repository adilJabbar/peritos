<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'images' => [
            'driver' => 'local',
            'root' => storage_path('app/expedients/images'),
            'url' => env('APP_URL').'/files/expedients/images',
            'visibility' => 'public',
        ],

        'anexos' => [
            'driver' => 'local',
            'root' => storage_path('app/expedients/anexos'),
            'url' => env('APP_URL').'/files/expedients/anexos',
            'visibility' => 'public',
        ],

        'logos' => [
            'driver' => 'local',
            'root' => storage_path('app/logos'),
            'url' => env('APP_URL').'/logos',
            'visibility' => 'public',
        ],

        'policies' => [
            'driver' => 'local',
            'root' => storage_path('app/policies'),
            'url' => '/files/policies',
            'visibility' => 'public',
        ],

        'products' => [
            'driver' => 'local',
            'root' => storage_path('app/insurance/products'),
            'url' => env('APP_URL').'/files/insurance/products',
            'visibility' => 'public',
        ],

        'expedients' => [
            'driver' => 'local',
            'root' => storage_path('app/expedients'),
            'url' => env('APP_URL').'/files/expedients',
            'visibility' => 'public',
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        'signatures' => [
            'driver' => 'local',
            'root' => storage_path('app/signatures'),
            'url' => env('APP_URL').'/signatures',
            'visibility' => 'public',
        ],

        'templates' => [
            'driver' => 'local',
            'root' => storage_path('app/templates'),
            'url' => env('APP_URL').'/templates',
            'visibility' => 'public',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),

        public_path('logos') => storage_path('app/logos'),

        public_path('templates') => storage_path('app/templates'),

        public_path('files/insurance/products') => storage_path('app/insurance/products'),

        public_path('files/expedients') => storage_path('app/expedients'),

        public_path('files/pictures') => storage_path('app/pictures'),

        public_path('files/anexos') => storage_path('app/anexos'),

        public_path('files/policies') => storage_path('app/policies'),

        public_path('signatures') => storage_path('app/signatures'),
    ],

];
