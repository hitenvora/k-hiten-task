<?php

namespace App\Main;

class SideMenu
{
    /**
     * List of side menu items.
     */
    public static function menu(): array
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Dashboard',
                'sub_menu' => [
                    'dashboard-overview-1' => [
                        'icon' => 'activity',
                        'route_name' => 'dashboard-overview-1',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Overview 1'
                    ],
                    'dashboard-overview-2' => [
                        'icon' => 'activity',
                        'route_name' => 'dashboard-overview-2',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Overview 2'
                    ],
                    'dashboard-overview-3' => [
                        'icon' => 'activity',
                        'route_name' => 'dashboard-overview-3',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Overview 3'
                    ],
                    'dashboard-overview-4' => [
                        'icon' => 'activity',
                        'route_name' => 'dashboard-overview-4',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Overview 4'
                    ]
                ]
            ],
            "User's " => [
                'icon' => 'User',
                'title' => "User's ",
                'sub_menu' => [
                    'Employee' => [
                        'icon' => 'activity',
                        'title' => 'Employee',
                        'route_name' => 'employee.list',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                    ],
                    'Customer List' => [
                        'icon' => 'activity',
                        'title' => 'Admin Customer',
                        'route_name' => 'admin.customerList',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                    ],
                    'User' => [
                        'icon' => 'activity',
                        'title' => "User's",
                        'route_name' => 'admin.User.List',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                    ],
                ],
            ],
            // 'Category' => [
            //     'icon' => 'box',
            //     'title' => 'Category',
            //     'route_name' => 'categorie.list',
            //     'params' => [
            //         'layout' => 'side-menu'
            //     ],
            // ],



            // 'Gst & Taxes' => [
            //     'icon' => 'DollarSign',
            //     'title' => 'Gst & Taxes',
            //     'route_name' => 'gst.list',
            //     'params' => [
            //         'layout' => 'side-menu'
            //     ],
            // ],
            // 'Firm' => [
            //     'icon' => 'Briefcase',
            //     'title' => 'Firm',
            //     'route_name' => 'firm.list',
            //     'params' => [
            //         'layout' => 'side-menu'
            //     ],
            // ],
            // 'Product' => [
            //     'icon' => 'ShoppingBag',
            //     'title' => 'Product',
            //     'route_name' => 'products.list',
            //     'params' => [
            //         'layout' => 'side-menu'
            //     ],
            // ],
            // 'Ingredients' => [
            //     'icon' => 'List',
            //     'title' => 'Ingredient',
            //     'route_name' => 'ingredient.list',
            //     'params' => [
            //         'layout' => 'side-menu'
            //     ],
            // ],
            'Product' => [
                'icon' => 'ShoppingBag',
                'title' => 'Product',
                'sub_menu' => [
                    'Sub Category' => [
                        'icon' => 'activity',
                        'title' => 'Category',
                        'route_name' => 'subCategorie.list',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                    ],
                    'Products' => [
                        'icon' => 'activity',
                        'title' => 'Products',
                        'route_name' => 'products.list',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                    ],
                    // 'many-to-one' => [
                    //     'icon' => 'activity',
                    //     'route_name' => 'ManyToOneList',
                    //     'params' => [
                    //         'layout' => 'side-menu',
                    //     ],
                    //     'title' => 'Many To One'
                    // ],
                    'dashboard-overview-1' => [
                        'icon' => 'activity',
                        'route_name' => 'inventory.list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Inventory'
                    ],
                    // 'One to Many' => [
                    //     'icon' => 'activity',
                    //     'title' => 'One to Many',
                    //     'route_name' => 'conversionList.list',
                    //     'params' => [
                    //         'layout' => 'side-menu'
                    //     ],
                    // ],
                ],
            ],
            'Manufacturing' => [
                'icon' => 'ShoppingBag',
                'title' => 'Manufacturing',
                'sub_menu' => [
                    'manufacturing' => [
                        'icon' => 'activity',
                        'route_name' => 'manufacturingList.list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Manufactur'
                    ],
                    // automationHistory
                    'Automation-history' => [
                        'icon' => 'activity',
                        'route_name' => 'automationhistoryList.list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Automation-history'
                    ],

                    'many-to-one' => [
                        'icon' => 'activity',
                        'route_name' => 'ManyToOneList',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Many To One'
                    ],
                    'One to Many' => [
                        'icon' => 'activity',
                        'title' => 'One to Many',
                        'route_name' => 'conversionList.list',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                    ],
                ],
            ],

            'App Order' => [
                'icon' => 'Package',
                'title' => 'App Order',
                'sub_menu' => [
                    // 'Customer' => [
                    //     'icon' => 'activity',
                    //     'title' => 'App Customer',
                    //     'route_name' => 'customer.list',
                    //     'params' => [
                    //         'layout' => 'side-menu'
                    //     ],
                    // ],
                    'dashboard-overview-1' => [
                        'icon' => 'activity',
                        'route_name' => 'app.order.list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'App Order List'
                    ],
                    // 'dashboard-overview-2' => [
                    //     'icon' => 'activity',
                    //     'route_name' => 'returnProductView',
                    //     'params' => [
                    //         'layout' => 'side-menu',
                    //     ],
                    //     'title' => 'Return App Order List'
                    // ],
                ],
            ],

            'admin order' => [
                'icon' => 'Package',
                'title' => 'Admin Order',
                'sub_menu' => [
                    // 'admin-customerList' => [
                    //     'icon' => 'activity',
                    //     'route_name' => 'admin.customerList',
                    //     'params' => [
                    //         'layout' => 'side-menu',
                    //     ],
                    //     'title' => 'Add Customer'
                    // ],
                    'new-amin-order' => [
                        'icon' => 'activity',
                        'route_name' => 'amin.order.list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Admin Order LIst'
                    ],
                    // 'new-return-order' => [
                    //     'icon' => 'activity',
                    //     'route_name' => 'returnOrderView',
                    //     'params' => [
                    //         'layout' => 'side-menu',
                    //     ],
                    //     'title' => 'Return Admin Order List'
                    // ],
                ]
            ],



            'web_order' => [
                'icon' => 'ShoppingCart',
                'title' => 'Web Order',
                'sub_menu' => [
                    'admin-customerList' => [
                        'icon' => 'activity',
                        'route_name' => 'weborder.list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Order List'
                    ],
                    'new-amin-order' => [
                        'icon' => 'Star',
                        'route_name' => 'review.list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Rating'
                    ],
                    // 'new-return-order' => [
                    //     'icon' => 'activity',
                    //     'route_name' => 'returnOrderView',
                    //     'params' => [
                    //         'layout' => 'side-menu',
                    //     ],
                    //     'title' => 'Return Admin Order List'
                    // ],
                ]
            ],




            'Purchase' => [
                'icon' => 'Truck',
                'title' => 'Purchase',
                'sub_menu' => [
                    'perch-partyList' => [
                        'icon' => 'activity',
                        'route_name' => 'admin.perchparty.list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Purchase Party'
                    ],
                    'perch-order-list' => [
                        'icon' => 'activity',
                        'route_name' => 'perch.order.list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Purchase Order List'
                    ],
                    // 'purchase -return-order' => [
                    //     'icon' => 'activity',
                    //     'route_name' => 'perchOrdersRetrunView',
                    //     'params' => [
                    //         'layout' => 'side-menu',
                    //     ],
                    //     'title' => 'Purchase Return Order List'
                    // ],
                ]
            ],


            // 'ledgers' => [
            //     'icon' => 'Book',
            //     'title' => 'Ledgers',
            //     'sub_menu' => [
            //         'ledgerlist' => [
            //             'icon' => 'activity',
            //             'route_name' => 'ledgers.list',
            //             'params' => [
            //                 'layout' => 'side-menu',
            //             ],
            //             'title' => 'Add Ledgers'
            //         ]
            //     ]
            // ],




            'Site-setting' => [
                'icon' => 'Image',
                'title' => 'Site - Setting',
                'sub_menu' => [
                    'front-image' => [
                        'icon' => 'activity',
                        'route_name' => 'front_image.list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Front- Image'
                    ],
                    'Founder-Manage' => [
                        'icon' => 'activity',
                        'route_name' => 'founder_mange.list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Founder-Manage'
                    ],
                    'Pin-code' => [
                        'icon' => 'activity',
                        'route_name' => 'order_pincode.list',
                        'params' => [
                            'layout' => 'side-menu',
                        ],
                        'title' => 'Pin-code'
                    ],
                    'blogs' => [
                        'icon' => 'activity',
                        'title' => 'Blogs',
                        'route_name' => 'blog.list',
                        'params' => [
                            'layout' => 'side-menu'
                        ],
                    ],
                    // 'purchase -return-order' => [
                    //     'icon' => 'activity',
                    //     'route_name' => 'perchOrdersRetrunView',
                    //     'params' => [
                    //         'layout' => 'side-menu',
                    //     ],
                    //     'title' => 'Purchase Return Order List'
                    // ],
                ]
            ],

            'ledgers' => [
                'icon' => 'Book',
                'title' => 'Ledgers',
                'route_name' => 'ledgers.list',
                'params' => [
                    'layout' => 'side-menu'
                ],
            ],



            'contect-us' => [
                'icon' => 'MessageCircle',
                'title' => 'Contact Us',
                'route_name' => 'contect_us.list',
                'params' => [
                    'layout' => 'side-menu'
                ],
            ],

            // 'blogs' => [
            //     'icon' => 'Bookmark',
            //     'title' => 'Blogs',
            //     'route_name' => 'blog.list',
            //     'params' => [
            //         'layout' => 'side-menu'
            //     ],
            // ],

            // 'Weborder' => [
            //     'icon' => 'ShoppingCart',
            //     'title' => 'Web Order',
            //     'route_name' => 'weborder.list',
            //     'params' => [
            //         'layout' => 'side-menu'
            //     ],
            // ],


            // 'Front-Image' => [
            //     'icon' => 'Image',
            //     'title' => 'Front-Image',
            //     'route_name' => 'front_image.list',
            //     'params' => [
            //         'layout' => 'side-menu'
            //     ],
            // ],

            // 'Founder-Manage' => [
            //     'icon' => 'User',
            //     'title' => 'Founder-Manage',
            //     'route_name' => 'founder_mange.list',
            //     'params' => [
            //         'layout' => 'side-menu'
            //     ],
            // ],


            // 'Pin-code' => [
            //     'icon' => 'MapPin',
            //     'title' => 'Pin Code',
            //     'route_name' => 'order_pincode.list',
            //     'params' => [
            //         'layout' => 'side-menu'
            //     ],
            // ],

            // 'Rating' => [
            //     'icon' => 'Star',
            //     'title' => 'Product Rating',
            //     'route_name' => 'review.list',
            //     'params' => [
            //         'layout' => 'side-menu'
            //     ],
            // ],


            // 'Entry' => [
            //     'icon' => 'Book',
            //     'title' => 'Ledger',
            //     'sub_menu' => [
            //         'ledgerlist' => [
            //             'icon' => 'activity',
            //             'route_name' => 'ledger.list',
            //             'params' => [
            //                 'layout' => 'side-menu',
            //             ],
            //             'title' => 'Entry list'
            //         ],



            // 'entrylist' => [
            //     'icon' => 'activity',
            //     'route_name' => 'entry.list',
            //     'params' => [
            //         'layout' => 'side-menu',
            //     ],
            //     'title' => 'Purchase Ledger'
            // ],
            // 'saleentrylist' => [
            //     'icon' => 'activity',
            //     'route_name' => 'sale.report.list',
            //     'params' => [
            //         'layout' => 'side-menu',
            //     ],
            //     'title' => 'Sale Ledger'
            // ]
            // ]
            // ],




            // 'Bank' => [
            //     'icon' => 'Book',
            //     'title' => 'Bank',
            //     'sub_menu' => [
            //         'ledgerlist' => [
            //             'icon' => 'activity',
            //             'route_name' => 'bank.list',
            //             'params' => [
            //                 'layout' => 'side-menu',
            //             ],
            //             'title' => 'Add Bank Details'
            //         ],
            //     ]
            // ],





            // 'Product Conversion' => [
            //     'icon' => 'List',
            //     'title' => 'Product Conversion',
            //     'route_name' => 'conversionList.list',
            //     'params' => [
            //         'layout' => 'side-menu'
            //     ],
            // ],

            // 'menu-layout' => [
            // 'icon' => 'box',
            // 'title' => 'Menu Layout',
            // 'sub_menu' => [
            // 'side-menu' => [
            // 'icon' => 'activity',
            // 'route_name' => 'dashboard-overview-1',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Side Menu'
            // ],
            // 'simple-menu' => [
            // 'icon' => 'activity',
            // 'route_name' => 'dashboard-overview-1',
            // 'params' => [
            // 'layout' => 'simple-menu'
            // ],
            // 'title' => 'Simple Menu'
            // ],
            // 'top-menu' => [
            // 'icon' => 'activity',
            // 'route_name' => 'dashboard-overview-1',
            // 'params' => [
            // 'layout' => 'top-menu'
            // ],
            // 'title' => 'Top Menu'
            // ]
            //     ]
            // ],
            // 'e-commerce' => [
            //     'icon' => 'shopping-bag',
            // 'title' => 'E-Commerce',
            // 'sub_menu' => [
            // 'categories' => [
            // 'icon' => 'activity',
            // 'route_name' => 'categories',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Categories'
            // ],
            // 'add-product' => [
            // 'icon' => 'activity',
            // 'route_name' => 'add-product',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Add Product',
            // ],
            // 'products' => [
            // 'icon' => 'activity',
            // 'title' => 'Products',
            // 'sub_menu' => [
            // 'product-list' => [
            // 'icon' => 'zap',
            // 'route_name' => 'product-list',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Product List'
            // ],
            // 'product-grid' => [
            // 'icon' => 'zap',
            // 'route_name' => 'product-grid',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Product Grid'
            // ]
            //             ]
            //         ],
            //         'transactions' => [
            //             'icon' => 'activity',
            // 'title' => 'Transactions',
            // 'sub_menu' => [
            // 'transaction-list' => [
            // 'icon' => 'zap',
            // 'route_name' => 'transaction-list',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Transaction List'
            // ],
            // 'transaction-detail' => [
            // 'icon' => 'zap',
            // 'route_name' => 'transaction-detail',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Transaction Detail'
            // ]
            //             ]
            //         ],
            //         'sellers' => [
            //             'icon' => 'activity',
            // 'title' => 'Sellers',
            // 'sub_menu' => [
            // 'seller-list' => [
            // 'icon' => 'zap',
            // 'route_name' => 'seller-list',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Seller List'
            // ],
            // 'seller-detail' => [
            // 'icon' => 'zap',
            // 'route_name' => 'seller-detail',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Seller Detail'
            // ]
            //             ]
            //         ],
            //         'reviews' => [
            //             'icon' => 'activity',
            // 'route_name' => 'reviews',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Reviews'
            // ],
            // ]
            // ],
            // 'inbox' => [
            // 'icon' => 'inbox',
            // 'route_name' => 'inbox',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Inbox'
            // ],
            // 'file-manager' => [
            // 'icon' => 'hard-drive',
            // 'route_name' => 'file-manager',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'File Manager'
            // ],
            // 'point-of-sale' => [
            // 'icon' => 'credit-card',
            // 'route_name' => 'point-of-sale',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Point of Sale'
            // ],
            // 'chat' => [
            // 'icon' => 'message-square',
            // 'route_name' => 'chat',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Chat'
            // ],
            // 'post' => [
            // 'icon' => 'file-text',
            // 'route_name' => 'post',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Post'
            // ],
            // 'calendar' => [
            // 'icon' => 'calendar',
            // 'route_name' => 'calendar',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Calendar'
            // ],
            // 'divider',
            // 'crud' => [
            // 'icon' => 'edit',
            // 'title' => 'Crud',
            // 'sub_menu' => [
            // 'crud-data-list' => [
            // 'icon' => 'activity',
            // 'route_name' => 'crud-data-list',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Data List'
            // ],
            // 'crud-form' => [
            // 'icon' => 'activity',
            // 'route_name' => 'crud-form',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            //             'title' => 'Form'
            //         ]
            //     ]
            // ],
            // 'users' => [
            //     'icon' => 'users',
            //     'title' => 'Users',
            //     'sub_menu' => [
            //         'users-layout-1' => [
            // 'icon' => 'activity',
            // 'route_name' => 'users-layout-1',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 1'
            // ],
            // 'users-layout-2' => [
            // 'icon' => 'activity',
            // 'route_name' => 'users-layout-2',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 2'
            // ],
            // 'users-layout-3' => [
            // 'icon' => 'activity',
            // 'route_name' => 'users-layout-3',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 3'
            // ]
            //     ]
            // ],
            // 'profile' => [
            //     'icon' => 'trello',
            //     'title' => 'Profile',
            // 'sub_menu' => [
            // 'profile-overview-1' => [
            // 'icon' => 'activity',
            // 'route_name' => 'profile-overview-1',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Overview 1'
            // ],
            // 'profile-overview-2' => [
            // 'icon' => 'activity',
            // 'route_name' => 'profile-overview-2',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Overview 2'
            // ],
            // 'profile-overview-3' => [
            // 'icon' => 'activity',
            // 'route_name' => 'profile-overview-3',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Overview 3'
            // ]
            //     ]
            // ],
            // 'pages' => [
            //     'icon' => 'layout',
            //     'title' => 'Pages',
            //     'sub_menu' => [
            //         'wizards' => [
            //             'icon' => 'activity',
            // 'title' => 'Wizards',
            // 'sub_menu' => [
            // 'wizard-layout-1' => [
            // 'icon' => 'zap',
            // 'route_name' => 'wizard-layout-1',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 1'
            // ],
            // 'wizard-layout-2' => [
            // 'icon' => 'zap',
            // 'route_name' => 'wizard-layout-2',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 2'
            // ],
            // 'wizard-layout-3' => [
            // 'icon' => 'zap',
            // 'route_name' => 'wizard-layout-3',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 3'
            // ]
            //             ]
            //         ],
            //         'blog' => [
            //             'icon' => 'activity',
            // 'title' => 'Blog',
            // 'sub_menu' => [
            // 'blog-layout-1' => [
            // 'icon' => 'zap',
            // 'route_name' => 'blog-layout-1',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 1'
            // ],
            // 'blog-layout-2' => [
            // 'icon' => 'zap',
            // 'route_name' => 'blog-layout-2',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 2'
            // ],
            // 'blog-layout-3' => [
            // 'icon' => 'zap',
            // 'route_name' => 'blog-layout-3',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 3'
            // ]
            //             ]
            //         ],
            //         'pricing' => [
            //             'icon' => 'activity',
            // 'title' => 'Pricing',
            // 'sub_menu' => [
            // 'pricing-layout-1' => [
            // 'icon' => 'zap',
            // 'route_name' => 'pricing-layout-1',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 1'
            // ],
            // 'pricing-layout-2' => [
            // 'icon' => 'zap',
            // 'route_name' => 'pricing-layout-2',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 2'
            // ]
            //             ]
            //         ],
            //         'invoice' => [
            //             'icon' => 'activity',
            // 'title' => 'Invoice',
            // 'sub_menu' => [
            // 'invoice-layout-1' => [
            // 'icon' => 'zap',
            // 'route_name' => 'invoice-layout-1',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 1'
            // ],
            // 'invoice-layout-2' => [
            // 'icon' => 'zap',
            // 'route_name' => 'invoice-layout-2',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 2'
            // ]
            //             ]
            //         ],
            //         'faq' => [
            //             'icon' => 'activity',
            // 'title' => 'FAQ',
            // 'sub_menu' => [
            // 'faq-layout-1' => [
            // 'icon' => 'zap',
            // 'route_name' => 'faq-layout-1',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 1'
            // ],
            // 'faq-layout-2' => [
            // 'icon' => 'zap',
            // 'route_name' => 'faq-layout-2',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 2'
            // ],
            // 'faq-layout-3' => [
            // 'icon' => 'zap',
            // 'route_name' => 'faq-layout-3',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Layout 3'
            // ]
            //             ]
            //         ],
            //         'login' => [
            //             'icon' => 'activity',
            // 'route_name' => 'login',
            // 'params' => [
            // 'layout' => 'base'
            // ],
            // 'title' => 'Login'
            // ],
            // 'register' => [
            // 'icon' => 'activity',
            // 'route_name' => 'register',
            // 'params' => [
            // 'layout' => 'base'
            // ],
            // 'title' => 'Register'
            // ],
            // 'error-page' => [
            // 'icon' => 'activity',
            // 'route_name' => 'error-page',
            // 'params' => [
            // 'layout' => 'base'
            // ],
            // 'title' => 'Error Page'
            // ],
            // 'update-profile' => [
            // 'icon' => 'activity',
            // 'route_name' => 'update-profile',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Update profile'
            // ],
            // 'change-password' => [
            // 'icon' => 'activity',
            // 'route_name' => 'change-password',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Change Password'
            // ]
            //     ]
            // ],
            // 'divider',
            // 'components' => [
            //     'icon' => 'inbox',
            //     'title' => 'Components',
            // 'sub_menu' => [
            // 'grid' => [
            // 'icon' => 'activity',
            // 'title' => 'Grid',
            // 'sub_menu' => [
            // 'regular-table' => [
            // 'icon' => 'zap',
            // 'route_name' => 'regular-table',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Regular Table'
            // ],
            // 'tabulator' => [
            // 'icon' => 'zap',
            // 'route_name' => 'tabulator',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Tabulator'
            // ]
            //             ]
            //         ],
            //         'overlay' => [
            //             'icon' => 'activity',
            // 'title' => 'Overlay',
            // 'sub_menu' => [
            // 'modal' => [
            // 'icon' => 'zap',
            // 'route_name' => 'modal',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Modal'
            // ],
            // 'slide-over' => [
            // 'icon' => 'zap',
            // 'route_name' => 'slide-over',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Slide Over'
            // ],
            // 'notification' => [
            // 'icon' => 'zap',
            // 'route_name' => 'notification',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Notification'
            // ],
            // ]
            //         ],
            // 'tab' => [
            // 'icon' => 'activity',
            // 'route_name' => 'tab',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Tab'
            // ],
            // 'accordion' => [
            // 'icon' => 'activity',
            // 'route_name' => 'accordion',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Accordion'
            // ],
            // 'button' => [
            // 'icon' => 'activity',
            // 'route_name' => 'button',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Button'
            // ],
            // 'alert' => [
            // 'icon' => 'activity',
            // 'route_name' => 'alert',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Alert'
            // ],
            // 'progress-bar' => [
            // 'icon' => 'activity',
            // 'route_name' => 'progress-bar',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Progress Bar'
            // ],
            // 'tooltip' => [
            // 'icon' => 'activity',
            // 'route_name' => 'tooltip',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Tooltip'
            // ],
            // 'dropdown' => [
            // 'icon' => 'activity',
            // 'route_name' => 'dropdown',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Dropdown'
            // ],
            // 'typography' => [
            // 'icon' => 'activity',
            // 'route_name' => 'typography',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Typography'
            // ],
            // 'icon' => [
            // 'icon' => 'activity',
            // 'route_name' => 'icon',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Icon'
            // ],
            // 'loading-icon' => [
            // 'icon' => 'activity',
            // 'route_name' => 'loading-icon',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Loading Icon'
            // ]
            //     ]
            // ],
            // 'forms' => [
            //     'icon' => 'sidebar',
            //     'title' => 'Forms',
            //     'sub_menu' => [
            //         'regular-form' => [
            //             'icon' => 'activity',
            // 'route_name' => 'regular-form',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Regular Form'
            // ],
            // 'datepicker' => [
            // 'icon' => 'activity',
            // 'route_name' => 'datepicker',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Datepicker'
            // ],
            // 'tom-select' => [
            // 'icon' => 'activity',
            // 'route_name' => 'tom-select',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Tom Select'
            // ],
            // 'file-upload' => [
            // 'icon' => 'activity',
            // 'route_name' => 'file-upload',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'File Upload'
            // ],
            // 'wysiwyg-editor' => [
            // 'icon' => 'activity',
            // 'title' => 'Wysiwyg Editor',
            // 'sub_menu' => [
            // 'wysiwyg-editor-classic' => [
            // 'icon' => 'zap',
            // 'route_name' => 'wysiwyg-editor-classic',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Classic'
            // ],
            // 'wysiwyg-editor-inline' => [
            // 'icon' => 'zap',
            // 'route_name' => 'wysiwyg-editor-inline',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Inline'
            // ],
            // 'wysiwyg-editor-balloon' => [
            // 'icon' => 'zap',
            // 'route_name' => 'wysiwyg-editor-balloon',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Balloon'
            // ],
            // 'wysiwyg-editor-balloon-block' => [
            // 'icon' => 'zap',
            // 'route_name' => 'wysiwyg-editor-balloon-block',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Balloon Block'
            // ],
            // 'wysiwyg-editor-document' => [
            // 'icon' => 'zap',
            // 'route_name' => 'wysiwyg-editor-document',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Document'
            // ],
            // ]
            //         ],
            // 'validation' => [
            // 'icon' => 'activity',
            // 'route_name' => 'validation',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Validation'
            // ]
            //     ]
            // ],
            // 'widgets' => [
            //     'icon' => 'hard-drive',
            // 'title' => 'Widgets',
            // 'sub_menu' => [
            // 'chart' => [
            // 'icon' => 'activity',
            // 'route_name' => 'chart',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Chart'
            // ],
            // 'slider' => [
            // 'icon' => 'activity',
            // 'route_name' => 'slider',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Slider'
            // ],
            // 'image-zoom' => [
            // 'icon' => 'activity',
            // 'route_name' => 'image-zoom',
            // 'params' => [
            // 'layout' => 'side-menu'
            // ],
            // 'title' => 'Image Zoom'
            // ]
            //     ]
            // ]
        ];
    }
}
