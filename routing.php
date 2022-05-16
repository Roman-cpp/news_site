<?php
use Application\Controller\News;
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
    ]
];
