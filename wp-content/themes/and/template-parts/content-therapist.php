<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package and
 */

?>

<article id="post-<?php the_ID(); ?>" class="type-page">
    <header class="entry-header">
        <div class="thumbnail">
            <?php if (wp_is_mobile()) : ?>
                <img width="585" height="345" src="/wp-content/uploads/2023/06/4950140_m-585x345.jpg" class="attachment-mobile_thumbnail size-mobile_thumbnail wp-post-image" alt="" decoding="async">
            <?php else : ?>
                <img width="1536" height="321" src="/wp-content/uploads/2023/06/4950140_m-1536x321.jpg" class="attachment-desktop_thumbnail size-desktop_thumbnail wp-post-image" alt="" decoding="async">
            <?php endif; ?>
            <h1 class="entry-title">セラピスト紹介 <span>-THERAPIST-</span></h1>
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
            <section class="therapist_detail">
                <div class="h">
                    <h2>セラピスト紹介</h2>
                    <span>THERAPIST</span>
                </div>
                <div class="content">
                    <div class="info">
                        <div class="img">
                            <?php if (!empty(get_post_meta($post->ID, 'therapist__new__field', true))) : ?>
                                <div class="new">
                                    <span>New</span>
                                </div>
                            <?php endif; ?>
                            <!-- スライダー-->
                            <?php
                            $thumbnails = [];
                            for ($i = 0; $i < 4; $i++) :
                                $thumbnail = get_post_meta($post->ID, '__therapist__img' . $i . '__field', true);
                                if (!empty($thumbnail)) :
                                    $thumbnails[] = $thumbnail;
                                endif;
                            endfor;
                            ?>
                            <div class="swiper-container slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><?php the_post_thumbnail(); ?></div>
                                    <?php foreach ($thumbnails as $thumbnail) : ?>
                                        <div class="swiper-slide">
                                            <img src="<?php echo $thumbnail; ?>" alt="">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- サムネイル -->
                            <div class="swiper-container slider-thumbnail">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"> <?php the_post_thumbnail(); ?></div>
                                    <?php foreach ($thumbnails as $thumbnail) : ?>
                                        <div class="swiper-slide">
                                            <img src="<?php echo $thumbnail; ?>" alt="">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="tx">
                            <dl>
                                <dt>名前：</dt>
                                <dd><?php echo get_post_meta($post->ID, '__therapist__name__field', true); ?></dd>
                                <dt>年齢：</dt>
                                <dd>
                                    <?php
                                    echo get_post_meta($post->ID, '__therapist__age__field', true);
                                    echo get_post_meta($post->ID, '__therapist__unit__field', true);
                                    ?>
                                </dd>
                                <dt>身長：</dt>
                                <dd><?php echo get_post_meta($post->ID, '__therapist__height__field', true); ?>cm</dd>
                                <?php if (!empty(get_post_meta($post->ID, 'therapist__new__field', true))) : ?>
                                    <dt>入店日：</dt>
                                    <dd>
                                        <?php
                                        echo date('Y年m月d日', strtotime(get_post_meta($post->ID, '__therapist__join__field', true)));
                                        ?>
                                    </dd>
                                <?php endif; ?>
                                <dt class="comment">お店からの紹介：</dt>
                                <dd class="comment"><?php echo nl2br(htmlspecialchars(get_post_meta($post->ID, '__therapist__comment__field', true))); ?></dd>
                            </dl>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="schedule">
                            <dl>
                                <?php
                                $weekdays = array('日', '月', '火', '水', '木', '金', '土');
                                for ($i = 0; $i < 14; $i++) {
                                    $date = date('Y-m-d', strtotime("+$i days"));
                                    $weekday = $weekdays[date('w', strtotime("+$i days"))];
                                    echo "<dt>$date ($weekday)</dt>\n";
                                    echo "<dd>";
                                    $field_data = get_post_meta($post->ID, 'therapist__schedule__field__' . $date, true);
                                    if (!empty($field_data)) :
                                        echo $field_data;
                                    else :
                                        echo '-';
                                    endif;
                                    echo "</dd>\n";
                                }
                                ?>
                            </dl>
                        </div>
                        <div class="twitter">
                            <?php
                            $twitter_id = get_post_meta($post->ID, '__therapist__twitter__field', true);
                            ?>
                            <a class="twitter-timeline" href="https://twitter.com/<?php echo $twitter_id; ?>?ref_src=twsrc%5Etfw"></a>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->