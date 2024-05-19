<?php

return [
    'enums' => [
        // Directory path where enums are located
        'dir_path' => app_path('Enums'),

        // Namespace for enums
        'namespace' => 'App\Enums',
    ],
    'zip' => [
        // Directory path where zip will be save
        'to_dir' => storage_path('zips'),
    ],
];
