<?php 

/**
* This is the sidebar config file.
* Add all sidebar menu items here
*/

return [
    [
        'title' => 'Dashboard',
        'icon'  => 'bi bi-speedometer',
        'route'   => 'dashboard',
        'order' => 1,
        'children' => [] // No submenus
    ],
    [
        'title' => 'Users',
        'icon'  => 'bi bi-people',
        'route'   => '', // Parent menu has no direct link
        'order' => 2,
        'children' => [
            [
                'title' => 'All Users',
                'icon'  => 'bi bi-list',
                'route'   => 'dashboard',
                'order' => 1,
            ],
            [
                'title' => 'Create User',
                'icon'  => 'bi bi-plus',
                'route'   => 'dashboard',
                'order' => 2,
            ]
        ]
    ],
];
