<?php

// use Imagick;
use GraphQL\Type\Definition\ResolveInfo;
use WPGraphQL\AppContext;

add_action('graphql_register_types', function () {

    register_graphql_field('MediaItem', 'placeholderDataURI', [
        'description' => __('Encoded base64 placeholder', 'default'),
        'type' => 'String',
        'resolve' => function (\WPGraphQL\Model\Post $source, $args, AppContext $context, ResolveInfo $info) {
            $file_local_abs_path = get_attached_file($source->databaseId);

            if (!isset($file_local_abs_path)) {
                return null;
            }

            $image = new Imagick($file_local_abs_path);

            $image->resizeImage(128, 128, Imagick::FILTER_CATROM, 1);
            // $image->resizeImage(64, 64, Imagick::FILTER_CATROM, 1);
            $image->setImageFormat('webp');
            $image->blurImage(100, 20);
            $image->stripImage();

            return 'data:image/' . $mime_type . ';base64,' . base64_encode($image);
        }
    ]);
});
