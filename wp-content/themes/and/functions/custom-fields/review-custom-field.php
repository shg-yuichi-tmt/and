<?php

/**
 * フィールドボックスを作成
 */
function add_review_fields()
{
    add_meta_box('review_content', '口コミ内容', 'insert_review_fields', 'review', 'normal', 'high');
}
add_action('admin_menu', 'add_review_fields');

/**
 * カスタムフィールドを作成
 */
function insert_review_fields()
{
    global $post;
    $post_id = $post->ID;

    $review_age = get_post_meta($post_id, '__review__age__field', true);
    $ages = ['20代', '30代', '40代', '50代', '60代'];
?>
    <h4 class="admin_h4">セラピスト</h4>
    <select name="review__therapist__field" id="review__therapist__field">
        <?php
        $args = array(
            'post_type' => 'therapist',
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <option value="<?php the_ID(); ?>"><?php the_title(); ?></option>
        <?php endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </select>
    <h4 class="admin_h4">年齢層</h4>
    <select name="review__age__field" id="review__age__field">
        <?php foreach ($ages as $age) : ?>
            <option value="<?php echo $age; ?>" <?php if ($review_age === $age) : echo 'selected';
                                                endif; ?>><?php echo $age; ?></option>
        <?php endforeach; ?>
    </select>
    <h4 class="admin_h4">セラピストに対する口コミ</h4>
    <textarea name="review__comment__field" id="review__comment__field" cols="80" rows="5"><?php echo get_post_meta($post_id, '__review__comment__field', true); ?></textarea>
    <h4 class="admin_h4">お店に対する口コミ</h4>
    <textarea name="review__store__comment__field" id="review__store__comment__field" cols="80" rows="5"><?php echo get_post_meta($post_id, '__review__store__comment__field', true); ?></textarea>
<?php
    wp_nonce_field('review_field_key', 'review_field_nonce');
}

/**
 * カスタムフィールドの値を保存
 * 
 * @param int $post_ID
 */
function save_review_fields($post_ID)
{
    if (!empty($_POST['review__therapist__field'])) {
        update_post_meta($post_ID, '__review__therapist__field', $_POST['review__therapist__field']);
    }
    if (!empty($_POST['review__age__field'])) {
        update_post_meta($post_ID, '__review__age__field', $_POST['review__age__field']);
    }
    if (!empty($_POST['review__comment__field'])) {
        update_post_meta($post_ID, '__review__comment__field', $_POST['review__comment__field']);
    }
    if (!empty($_POST['review__store__comment__field'])) {
        update_post_meta($post_ID, '__review__store__comment__field', $_POST['review__store__comment__field']);
    } else {
        delete_post_meta($post_ID, 'review__store__comment__field');
    }
}
add_action('save_post', 'save_review_fields');
