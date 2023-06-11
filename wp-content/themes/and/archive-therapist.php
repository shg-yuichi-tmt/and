<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package and
 */

get_header();
?>

<main id="primary" class="site-main type-page">

    <?php if (have_posts()) : ?>

        <header class="entry-header">
            <div class="thumbnail">
                <?php if (wp_is_mobile()) : ?>
                    <img width="585" height="345" src="/wp-content/uploads/2023/06/5066731_m-585x345.jpg" class="attachment-mobile_thumbnail size-mobile_thumbnail wp-post-image" alt="" decoding="async">
                <?php else : ?>
                    <img width="1536" height="321" src="/wp-content/uploads/2023/06/5066731_m-1536x321.jpg" class="attachment-desktop_thumbnail size-desktop_thumbnail wp-post-image" alt="" decoding="async">
                <?php endif; ?>
                <h1 class="entry-title">在籍セラピスト <span>-THERAPIST-</span></h1>
            </div>
            <?php if (!wp_is_mobile()) : ?>
                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'and'); ?></button>
                    <?php
                    wp_nav_menu(
                        array(
                            'menu' => 'Primary',
                            'theme_location' => 'primary',
                            'menu_id'        => 'header-nav',
                        )
                    );
                    ?>
                </nav><!-- #site-navigation -->
            <?php endif; ?>
        </header><!-- .entry-header -->

        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
            <?php if (function_exists('bcn_display')) {
                bcn_display();
            } ?>
        </div>

        <div class="entry-content">
            <div class="container">
                <div class="list fadein">

                    <?php
                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();
                    ?>
                        <?php
                        /**
                         * Template part for displaying posts
                         *
                         * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
                         *
                         * @package and
                         */

                        ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                            <div class="img">
                                <a href="<?php the_permalink(); ?>" class="link"></a>
                                <?php if (!empty(get_post_meta($post->ID, '__therapist__twitter__field', true))) : ?>
                                    <a href="https://twitter.com/<?php echo get_post_meta($post->ID, '__therapist__twitter__field', true); ?>" target="_blank" class="tw_icon">
                                        <img src="/assets/img/tw_icon.png" alt="Twitterのアイコン">
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty(get_post_meta($post->ID, 'therapist__new__field', true))) : ?>
                                    <div class="new">
                                        <span>New</span>
                                    </div>
                                <?php endif; ?>
                                <?php and_post_thumbnail(); ?>
                            </div>

                            <div class="tx">
                                <div class="tx">
                                    <div class="name">
                                        <h3><?php echo get_post_meta($post->ID, '__therapist__name__field', true); ?></h3>
                                        <span class="age"><?php echo get_post_meta($post->ID, '__therapist__age__field', true); ?>歳</span>
                                    </div>
                                    <div class="info">T.<?php echo get_post_meta($post->ID, '__therapist__height__field', true); ?>cm</div>
                                </div>
                            </div>
                        </article><!-- #post-<?php the_ID(); ?> -->
                    <?php endwhile; ?>

                </div>

                <?php
                the_posts_pagination(
                    array(
                        'mid_size' => 2,
                        'prev_next' => true,
                        'prev_text' => __('前へ'),
                        'next_text' => __('次へ'),
                        'type' => 'list',
                    )
                );
                ?>

            </div>
        </div>

    <?php else :

        get_template_part('template-parts/content', 'none');

    endif;
    ?>

</main><!-- #main -->

<?php
get_footer();
