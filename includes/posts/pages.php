<?php

add_action('graphql_register_types', function () {

    register_graphql_field('RootQuery', 'pageBySlug', [
        'type' => 'Page',
        'args' => [
            'slug' => [
                'type' => 'String',
                'description' => __('The slug of the page', 'webspace-theme'),
            ],
        ],
        'resolve' => function ($source, array $args, $context, $info) {
            if (empty($args['slug'])) {
                throw new \GraphQL\Error\UserError(__('Slug is required', 'webspace-theme'));
            }

            $page = get_page_by_path($args['slug'], OBJECT, 'page');

            if (!$page) {
                throw new \GraphQL\Error\UserError(__('No page found for this slug', 'webspace-theme'));
            }

            return new \WPGraphQL\Model\Post($page);
        },
    ]);

    // Your existing code...
});
