<?php

return [
    'plugin' => [
        'name'        => 'SEO Core',
        'description' => 'Flexible generation of meta tags for pages through templates'
    ],
    'permissions' => [
        'settings' => 'Managing SEO Settings',
        'meta_pages' => 'Managing Global SEO Templates.'
    ],
    'components' => [
        'seo_collector' => [
            'name'        => 'SeoCollector',
            'description' => 'Managing meta tags on a page.'
        ]
    ],
    'models' => [
        'settings' => [
            'label' => 'SEO Settings',
            'description' => 'Managing general SEO settings.',
            'search_keywords' => 'SEO search optimization page templates meta meta',
            'tabs' => [
                'general' => 'Settings',
            ],
            'fields' => [
                'title_prefix' => [
                    'label' => 'The prefix for the meta title',
                    'comment' => 'The prefix for the meta title will be automatically substituted on all pages'
                ],
                'title_suffix' => [
                    'label' => 'The suffix for the meta title',
                    'comment' => 'The suffix for the meta title will be automatically substituted on all pages'
                ],
                'head_begin_code' => [
                    'label' => 'The code to insert after the tag <head>',
                ],
                'head_end_code' => [
                    'label' => 'The code to insert before the tag  </head>',
                ],
                'body_begin_code' => [
                    'label' => 'The code to insert after the tag <body>',
                ],
                'body_end_code' => [
                    'label' => 'The code to insert before the tag  </body>',
                ]
            ],
        ],
        'meta_page' => [
            'label' => 'Meta pages',
            'item_label' => 'page',
            'item_all_label' => 'pages',
            'description' => 'Global meta templates for CMS pages.',
            'search_keywords' => 'SEO search optimization page templates meta meta',
            'tabs' => [
                'general' => 'Settings',
            ],
            'columns' => [
                'name' => [
                    'label' => 'Name',
                ],
                'page' => [
                    'label' => 'Relation page'
                ],
            ],
            'fields' => [
                'meta_section' => [
                    'comment' => 'All fields support variables (Twig markup). Check the names of the variables with your developer. The model variable is usually always present.'
                ],
                'name' => [
                    'label' => 'Template name',
                    'placeholder' => 'Template for the post page'
                ],
                'page_id' => [
                    'label' => 'Relation page'
                ],
                'h1_title' => [
                    'label' => 'H1 Title',
                    'comment' => 'Recommended size: up to 70 characters'
                ],
                'meta_title' => [
                    'label' => 'Meta title',
                    'comment' => 'Recommended size: up to 70 characters'
                ],
                'meta_description' => [
                    'label' => 'Meta description',
                    'comment' => 'Recommended size: up to 320 characters'
                ],
                'meta_other' => [
                    'label' => 'Additional markup in <head>',
                    'comment' => 'The data from this field will be rendered inside the <head> section in the template after the meta header and description. Use this field to print additional meta tags, such as canonical or robots.'
                ],
            ]
        ],
    ],
];
