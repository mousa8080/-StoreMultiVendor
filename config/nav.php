<?php
return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashpoard.dashboard',
        'title' => 'Dashboard',

    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'route' => 'dashpoard.categories.index',
        'title' => 'category',
        //  'ability'=>'categories.view',
        'badge' => 'new'
    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'route' => 'dashpoard.products.index',
        'title' => 'products',
        'badge' => 'new',
        // 'ability'=>'products.view',

    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'route' => 'dashpoard.categories.index',
        'title' => 'Orders',
        'badge' => 'new',
        // 'ability'=>'orders.view',

    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'route' => 'dashpoard.roles.index',
        'title' => 'Roles',
        'badge' => 'new',
        // 'ability'=>'roles.view',

    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'route' => 'dashpoard.admins.index',
        'title' => 'Admins',
        'badge' => 'new',
        // 'ability'=>'admins.view',

    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'route' => 'dashpoard.users.index',
        'title' => 'Users',
        'badge' => 'new',
        // 'ability'=>'users.view',

    ],

];
