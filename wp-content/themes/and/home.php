<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package and
 */

get_header();
?>

<main id="primary" class="site-main type-page">
    <header class="entry-header">
        <div class="thumbnail">
            <?php if (wp_is_mobile()) : ?>
                <img width="585" height="345" src="/wp-content/uploads/2023/06/news_thumbnail-585x345.png" class="attachment-mobile_thumbnail size-mobile_thumbnail wp-post-image" alt="" decoding="async">
            <?php else : ?>
                <img width="1536" height="321" src="/wp-content/uploads/2023/06/news_thumbnail-1536x321.png" class="attachment-desktop_thumbnail size-desktop_thumbnail wp-post-image" alt="" decoding="async">
            <?php endif; ?>
            <h1 class="entry-title">お知らせ <span>-NEWS-</span></h1>
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
            <section class="news fadein">
                <div class="h">
                    <h2>お知らせ</h2>
                    <span>NEWS</span>
                </div>

                <?php
                if (have_posts()) :

                    if (is_home() && !is_front_page()) :
                ?>
                        <header>
                            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                        </header>
                    <?php endif; ?>

                    <div class="list">

                        <?php
                        /* Start the Loop */
                        while (have_posts()) :
                            the_post();

                            /*
                            * Include the Post-Type-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                            */
                            get_template_part('template-parts/content', get_post_type());

                        endwhile; ?>

                    </div>

                <?php else :

                    get_template_part('template-parts/content', 'none');

                endif;

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
            </section>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
