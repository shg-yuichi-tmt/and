<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package and
 */

?>

<li>
    <article>
        <div class="tx">
            <?php if (!wp_is_mobile()) : ?>
                <div class="title">
                    <h3 class="name">
                        <?php
                        $therapist_id = get_post_meta($post->ID, '__review__therapist__field', true);
                        echo 'お客様から ';
                        echo get_the_title($therapist_id);
                        echo 'さん への口コミ';
                        ?>
                    </h3>
                    <div class="date">
                        <?php echo get_the_time('Y年n月j日 H:i', $post->ID); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="comment">
                <h3>セラピストに対しての口コミ</h3>
                <p><?php echo get_post_meta($post->ID, '__review__comment__field', true); ?></p>
            </div>
            <div class="comment">
                <h3>お店に対しての口コミ</h3>
                <p><?php echo get_post_meta($post->ID, '__review__store__comment__field', true); ?></p>
            </div>
            <div class="link">
                <?php
                $terms = get_the_terms($post->ID, 'review_category');

                if ($terms && !is_wp_error($terms)) :
                    foreach ($terms as $term) :
                        $term_id = $term->term_id;
                        $term_name = $term->name;
                        $category_link = get_term_link($term_id, 'review_category');
                ?>

                        <a href="<?php echo esc_url($category_link); ?>"><?php echo $term_name; ?>さんの口コミ一覧</a>
                <?php endforeach;
                endif; ?>
            </div>
        </div>
        <div class="img">
            <?php if (wp_is_mobile()) : ?>
                <div class="title">
                    <h3 class="name">
                        <?php
                        $therapist_id = get_post_meta($post->ID, '__review__therapist__field', true);
                        echo 'お客様から ';
                        echo get_the_title($therapist_id);
                        echo 'さん への口コミ';
                        ?>
                    </h3>
                    <div class="date">
                        <?php echo get_the_time('Y年n月j日 H:i', $post->ID); ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php echo get_the_post_thumbnail($therapist_id); ?>
        </div>
    </article>
</li>