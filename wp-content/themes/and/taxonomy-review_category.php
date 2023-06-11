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
                    <img width="585" height="345" src="/wp-content/uploads/2023/06/reviews_thumbnail-585x345.png" class="attachment-mobile_thumbnail size-mobile_thumbnail wp-post-image" alt="" decoding="async">
                <?php else : ?>
                    <img width="1536" height="321" src="/wp-content/uploads/2023/06/reviews_thumbnail-1536x321.png" class="attachment-desktop_thumbnail size-desktop_thumbnail wp-post-image" alt="" decoding="async">
                <?php endif; ?>
                <?php
                $term = get_queried_object();
                $term_name = $term->name;
                ?>
                <h1 class="entry-title"><?php echo $term_name; ?>さんへの口コミ一覧 <span>-REVIEWS-</span></h1>
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

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <div class="entry-content">
                <div class="container">
                    <section class="reviews fadein">
                        <div class="h">
                            <h2>口コミ一覧</h2>
                            <span>REVIEWS</span>
                        </div>
                        <div class="list">
                            <ul>

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

                            endwhile;

                        else :

                            get_template_part('template-parts/content', 'none');

                        endif;
                            ?>

                            </ul>
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
                    </section>
                </div>
            </div>
        </article>

</main><!-- #main -->

<?php
get_footer();
