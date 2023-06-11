<?php
function ajaxurl()
{
?>
    <script>
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
<?php
}

add_action('wp_head', 'ajaxurl', 1);
add_action('wp_ajax_load_posts', 'load_posts');
add_action('wp_ajax_nopriv_load_posts', 'load_posts');
function load_posts()
{
    $date = $_POST['date'];

    // 投稿データの取得処理
    $args = array(
        'post_type' => 'therapist',
        'posts_per_page' => 8,
        'meta_query' => array(
            array(
                'key' => 'therapist__schedule__field__' . $date,
                'compare' => '!=',
                'value' => '',
            ),
        ),
    );
    // 投稿データ取得
    $query = new WP_Query($args);

    // 
    $html = "";
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        $thumbnail = get_the_post_thumbnail($post_id);
        $link = get_the_permalink($post_id);

        // 出力用HTML
        $html .= '<article id="post-' . $post_id . '"><div class="img"><a href="' . $link . '" class="link"></a>';
        if (!empty(get_post_meta($post_id, '__therapist__twitter__field', true))) :
            $html .= '<a href="https://twitter.com/' . get_post_meta($post_id, '__therapist__twitter__field', true) . '" target="_blank" class="tw_icon"><img src="/assets/img/tw_icon.png" alt="Twitterのアイコン"></a>';
        endif;
        if (!empty(get_post_meta($post_id, 'therapist__new__field', true))) :
            $html .= '<div class="new"><span>New</span></div>';
        endif;
        $html .= $thumbnail;
        $html .= '<div class="tx"><div class="name"><h3>' . get_post_meta($post_id, '__therapist__name__field', true) . '</h3><span class="age">〇〇歳</span></div><div class="info">T.' . get_post_meta($post_id, '__therapist__height__field', true) . 'cm</div></div><div class="hour">' . get_post_meta($post_id, 'therapist__schedule__field__' . $date, true) . '</div></article>';
    }
    wp_reset_postdata();

    echo $html;

    wp_die(); // 必ず終了する
}
