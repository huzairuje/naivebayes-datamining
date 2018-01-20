<?php

return [

    'delimiter' => ',',

    /**
     * Menu action list that can be have.
     */
    'menu' => [
        'admin/user' => [
            'index'  => 'index',
            'action' => ['index', 'detail', 'create', 'update', 'activate', 'deactivate'],
        ],
        'admin/role' => [
            'index'  => 'index',
            'action' => ['index', 'detail', 'create', 'update', 'delete'],
        ],
        'admin/menu' => [
            'index'  => 'index',
            'action' => ['index', 'detail', 'create', 'update', 'delete'],
        ],
        'admin/scoring' => [
            'index'  => 'index',
            'action' => ['index', 'detail', 'create', 'update', 'delete'],
        ],
    ],

];
