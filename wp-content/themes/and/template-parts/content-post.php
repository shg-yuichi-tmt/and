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
        <?php
        if (!empty(the_post_thumbnail('post_thumbnail'))) :
            the_post_thumbnail('post_thumbnail');
        else :
            echo '<img src="/assets/img/logo_symbol.png" alt="">';
        endif;
        ?>
    </div>
    <div class="tx">
        <header class="entry-header">
            <?php the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
            <div class="entry-meta">
                <?php the_date('Y年m月d日 H:i'); ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->
        <div class="desc">
            <?php the_excerpt(); ?>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->