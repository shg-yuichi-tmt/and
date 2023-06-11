<?php
add_action('init', 'therapist_post_type');
function therapist_post_type()
{
    register_post_type(
        'therapist',
        array(
            'labels' =>
            array(
                'name' => __('セラピスト'),
                'singular_name' => __('セラピスト')
            ),
            'public' => true,
            'has_archive' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-businesswoman',
            'hierarchicla' => true,
            'rewrite' => array('slug' => 'therapist'),
            'supports' => array('title', 'thumbnail', 'hide_setting', 'excerpt', 'author')
        )
    );
}

add_action('init', 'review_post_type');
function review_post_type()
{
    register_post_type(
        'review',
        array(
            'labels' =>
            array(
                'name' => __('口コミ'),
                'singular_name' => __('口コミ')
            ),
            'public' => true,
            'has_archive' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-admin-comments',
            'hierarchicla' => true,
            'rewrite' => array('slug' => 'review'),
            'supports' => array('title', 'thumbnail', 'hide_setting')
        )
    );
}

add_action('init', 'create_review_taxonomy');
function create_review_taxonomy()
{
    $cat_args = array(
        'label' => 'カテゴリー',
        'public' => true,
        'hierarchical' => true
    );
    register_taxonomy(
        'review_category',
        'review',
        $cat_args
    );
    $tag_args = array(
        'label' => 'タグ',
        'public' =>  true,
        'hierarchical' =>  false
    );
    register_taxonomy(
        'review_tag',
        'review',
        $tag_args
    );
}
