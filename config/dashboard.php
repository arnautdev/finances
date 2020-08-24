<?php

return [

    'header-class' => 'navbar-default', // 'navbar-inverse ' : 'navbar-default '

    'sidebarTransparent' => '', // sidebar-transparent
    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */
    'sidebar' => [
        'MAIN NAVIGATION',
        [
            'label' => 'Administration',
            'url' => 'dashboard.home',
            'icon' => 'fa fa-cogs',
            'caret' => false,
            'driver' => false,
            'submenu' => [
                [
                    'label' => 'Users',
                    'url' => 'users.index',
                ],
                [
                    'label' => 'User groups',
                    'url' => 'user-group.index',
                ]
            ],
        ],

        [
            'label' => 'Dashboard',
            'url' => 'dashboard.home',
            'icon' => 'fa fa-th-large',
            'caret' => false,
            'driver' => false,
        ],

        [
            'label' => 'Web',
            'url' => '#',
            'icon' => 'fa fa-globe',
            'caret' => false,
            'driver' => false,
            'submenu' => [
                [
                    'label' => 'Text pages',
                    'url' => 'text-page.index',
                ],
                [
                    'label' => 'News',
                    'url' => 'news.index',
                ],
                [
                    'label' => 'Contact form',
                    'url' => 'contact-messages.index',
                ],
                [
                    'label' => 'Newsletter',
                    'url' => 'd-newsletter.index',
                ],
            ],
        ],

        [
            'label' => 'Store',
            'url' => '#',
            'icon' => 'fa fa-cube',
            'caret' => false,
            'driver' => false,
            'submenu' => [
                [
                    'label' => 'Catalog',
                    'url' => 'catalog.index',
                ],
                [
                    'label' => 'Product params',
                    'url' => 'product-params.index',
                ],
                [
                    'label' => 'Categories',
                    'url' => 'categories.index',
                ],
                [
                    'label' => 'Brands',
                    'url' => 'brands.index',
                ],
            ],
        ],
        [
            'label' => 'Orders',
            'url' => 'orders.index',
            'icon' => 'fa fa-cube',
            'caret' => false,
            'driver' => false,
//            'submenu' => [
//                [
//                    'label' => 'All orders',
//                    'url' => 'orders.index',
//                ],
//                [
//                    'label' => 'New orders',
//                    'url' => 'product-params.index',
//                ]
//            ],
        ],
        'SYSTEM NAVIGATION',
        [
            'label' => 'Communications',
            'url' => '#',
            'icon' => 'fa fa-list',
            'caret' => false,
            'driver' => false,
            'submenu' => [
                [
                    'label' => 'Email',
                    'url' => 'email-log.index',
                ]
            ],
        ],
        [
            'label' => 'System',
            'url' => '#',
            'icon' => 'fa fa-cogs',
            'caret' => false,
            'driver' => false,
            'submenu' => [
                [
                    'label' => 'Labels',
                    'url' => 'languages',
                ]
            ],
        ],
    ],
    'top-menu' => [
//        [
//            'label' => 'Products',
//            'url' => '#',
//            'icon' => 'fa fa-database fa-fw',
//            'caret' => true,
//            'driver' => false,
//            'submenu' => [
//                [
//                    'label' => 'Add New product',
//                    'url' => '#',
//                    'icon' => '',
//                    'caret' => false,
//                    'driver' => false,
//                ]
//            ]
//        ],
//        [
//            'label' => 'Clients',
//            'url' => '#',
//            'icon' => 'fa fa-gem fa-fw',
//            'caret' => false,
//            'driver' => false,
//        ]
    ]
];
