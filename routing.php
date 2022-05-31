<?php
use Application\Controller\News;
use Application\Controller\UserData;
const ROUTES=
[
    'news' =>[
        'controller' => News::class,
        'method' => 'showNews',
        'child' => [
            'add_news' => [
                'controller' => News::class,
                'method' => 'addNews',
                'child' => []
            ],
            'edit_news' => [
                'controller' => News::class,
                'method' => 'editNews',
                'child' => []
            ]
        ]
    ],
   'visit_statistics' => [
       'controller' => UserData::class,
       'method' => 'showChart',
       'child' => []
   ]
];
