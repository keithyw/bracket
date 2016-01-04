<?php
/**
 * Created by PhpStorm.
 * User: keithwatanabe
 * Date: 9/22/15
 * Time: 4:59 PM
 */

return [
    'admin_base_route' => 'Admin',
    'admin_controllers' => 'Http/Controllers/Admin',
    'default_limit' => 5,
    'messages' => [
        'create' => 'Create',
        'edit' => 'Edit',
        'index_title' => 'List',
    ],
    'models' => 'Models',
    'policies' => 'Policies',
    'repositories' => 'Repositories',
    'rest_controllers' => 'Http/Controllers/Api/V1',
    'rest_base_route' => 'Api\V1',
    'repositoryServiceProvider' => 'RepositoryServiceProvider',
    'transformers' => 'Transformers',
    'ignore_tables' => ['cron_status', 'failed_jobs', 'jobs', 'password_resets', 'user_logs', 'tmp_images', 'user_code_logs'],
    'addresses' => [
        'users' => [
            'hasType' => 'one'
        ],
        'hidden' => [
            'created_at', 'updated_at'
        ],
        'admin_templates' =>[
            'index' => [
                'link_text_field' => 'address'
            ]
        ]
    ],
    'brands' => [
        'products' => [
            'hasType' => 'one'
        ],
        'admin_templates' => [
            'index' => [
                'link_text_field' => 'name'
            ]
        ]
    ],
    'products' => [
        'admin_controller' => [
            'repositories' => [
                'brands'
            ]
        ],
        'admin_templates' => [
            'form' => [
                'brand_id' => [
                    'type' => 'select',
                    'display' => 'name',
                    'items' => 'brands'
                ]
            ]
        ]
    ],
    'users' => [
        'addresses' => [
            'hasType' => 'one'
        ],
        'hidden' => [
            'email', 'zipcode', 'epsilon_profile_id', 'needs_epsilon_update', 'total_points', 'remember_token', 'password', 'birthday'
        ],
        'admin_templates' => [
            'index' => [
                'link_text_field' => 'email'
            ]
        ]
    ],
    'watched_auctions' => [
        'policy' => ['update', 'delete']
    ]
];