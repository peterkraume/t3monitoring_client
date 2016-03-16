<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Client extension for the t3monitoring service',
    'description' => '',
    'category' => 'plugin',
    'author' => 'Georg Ringer',
    'author_email' => '',
    'state' => 'alpha',
    'internal' => '',
    'uploadfolder' => false,
    'createDirs' => '',
    'clearCacheOnLoad' => true,
    'version' => '0.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '6.2.0-7.6.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
