<?php

/**
 * The template for displaying schedule pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package and
 */

get_header();
?>

<main id="primary" class="site-main type-page post-type-archive-therapist">

    <?php if (have_posts()) : ?>

        <header class="entry-header">
            <div class="thumbnail">
                <?php if (wp_is_mobile()) : ?>
                    <img width="585" height="345" src="/wp-content/uploads/2023/06/schedule_thumbnail-585x345.png" class="attachment-mobile_thumbnail size-mobile_thumbnail wp-post-image" alt="" decoding="async">
                <?php else : ?>
                    <img width="1536" height="321" src="/wp-content/uploads/2023/06/schedule_thumbnail-1536x321.png" class="attachment-desktop_thumbnail size-desktop_thumbnail wp-post-image" alt="" decoding="async">
                <?php endif; ?>
                <h1 class="entry-title">出勤スケジュール <span>-SCHEDULE-</span></h1>
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
            <div class="container fadein">
                <div class="date">
                    <?php
                    $weekdays = array('日', '月', '火', '水', '木', '金', '土');
                    $current_date = date('Y-m-d');
                    for ($i = 0; $i < 7; $i++) {
                        $date = date('m/d', strtotime("+$i days"));
                        $data_date = date('Y-m-d', strtotime("+$i days"));
                        $weekday = $weekdays[date('w', strtotime("+$i days"))];
                    ?>
                        <div class="item <?php if ($current_date == $data_date) : echo 'current';
                                            endif; ?>" id="post-load-<?php echo $data_date ?>" data-date="<?php echo $data_date ?>"><?php echo $date ?> (<?php echo $weekday ?>)</div>
                    <?php } ?>
                </div>
                <div class="list">

                    <?php
                    $args = array(
                        'post_type' => 'therapist',
                        'posts_per_page' => 8,
                        'meta_query' => array(
                            array(
                                'key' => 'therapist__schedule__field__' . $current_date,
                                'compare' => '!=',
                                'value' => '',
                            ),
                        ),
                    );

                    $query = new WP_Query($args);
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
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
                                    <div class="name">
                                        <h3><?php echo get_post_meta($post->ID, '__therapist__name__field', true); ?></h3>
                                        <span class="age">〇〇歳</span>
                                    </div>
                                    <div class="info">T.<?php echo get_post_meta($post->ID, '__therapist__height__field', true); ?>cm</div>
                                </div>
                                <div class="hour"><?php echo get_post_meta($post->ID, 'therapist__schedule__field__' . $current_date, true); ?></div>
                            </article><!-- #post-<?php the_ID(); ?> -->
                    <?php
                        }
                    }

                    // ループ後の処理を行います（必要な場合）。
                    wp_reset_postdata();
                    ?>

                </div>

                <?php the_posts_navigation(); ?>

            </div>
        </div>

    <?php else :

        get_template_part('template-parts/content', 'none');

    endif;
    ?>

</main><!-- #main -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var items = document.querySelectorAll('.date .item');

        items.forEach(function(item) {
            item.addEventListener('click', function() {
                items.forEach(function(otherItem) {
                    otherItem.classList.remove('current');
                });
                this.classList.add('current');
            });
        });
    });
</script>
<?php
get_footer();
