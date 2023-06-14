<?php

/**
 * フィールドボックスを作成
 */
function add_therapist_fields()
{
    add_meta_box('therapist_info', 'セラピスト情報', 'insert_therapist_fields', 'therapist', 'normal', 'high');
    add_meta_box('therapist_new', 'NEW', 'insert_therapist_new_fields', 'therapist', 'side', 'low');
    add_meta_box('therapist_schedule', 'スケジュール', 'insert_therapist_schedule_field', 'therapist', 'normal', 'high');
}
add_action('admin_menu', 'add_therapist_fields');

/**
 * カスタムフィールドを作成
 */
function insert_therapist_fields()
{
    global $post; ?>
    <h4 class="admin_h4">名前</h4>
    <input type="text" name="therapist__name__field" value="<?php echo get_post_meta($post->ID, '__therapist__name__field', true); ?>" size="40">
    <h4 class="admin_h4">年齢</h4>
    <input type="number" name="therapist__age__field" value="<?php echo get_post_meta($post->ID, '__therapist__age__field', true); ?>" size="10">
    <select name="therapist__unit__field" id="therapist__unit__field">
        <option value="歳" <?php if (get_post_meta($post->ID, '__therapist__unit__field', true) == '歳') : echo 'selected';
                            endif; ?>>歳</option>
        <option value="代" <?php if (get_post_meta($post->ID, '__therapist__unit__field', true) == '代') : echo 'selected';
                            endif; ?>>代</option>
    </select>
    <h4 class="admin_h4">身長</h4>
    <input type="number" name="therapist__height__field" value="<?php echo get_post_meta($post->ID, '__therapist__height__field', true); ?>" size="20">
    <h4 class="admin_h4">入店日</h4>
    <input type="date" name="therapist__join__field" value="<?php echo get_post_meta($post->ID, '__therapist__join__field', true); ?>">
    <h4 class="admin_h4">お店からの紹介</h4>
    <textarea name="therapist__comment__field" id="therapist__comment__field" cols="80" rows="5"><?php echo get_post_meta($post->ID, '__therapist__comment__field', true); ?></textarea>
    <h4 class="admin_h4">Twitter ID</h4>
    <input type="text" name="therapist__twitter__field" value="<?php echo get_post_meta($post->ID, '__therapist__twitter__field', true); ?>" size="40">
<?php
    wp_nonce_field('therapist_field_key', 'therapist_field_nonce');
}

function insert_therapist_new_fields()
{
    global $post;
    if (get_post_meta($post->ID, 'therapist__new__field', true) === 'new') :
        $checked = 'checked';
    endif;
?>
    <input type="checkbox" name="therapist__new__field" id="therapist__new__field" value="new" <?php echo $checked; ?>>
    <label for="therapist__new__field">セラピスト画像上にNEWを表示</label>
<?php
    wp_nonce_field('therapist_field_key', 'therapist_field_nonce');
}

function insert_therapist_schedule_field()
{
    global $post;
    $weekdays = array('日', '月', '火', '水', '木', '金', '土');
    echo '<div class="schedule">';
    echo '<dl>';

    $today = date('Y-m-d');
    $current_month_start = date('Y-m-01', strtotime($today));
    $current_month_end = date('Y-m-t', strtotime($today));

    $current_date = $current_month_start;
    while ($current_date <= $current_month_end) {
        $date = date('n/j（', strtotime($current_date));
        $weekday = $weekdays[date('w', strtotime($current_date))];
        $date .= $weekday . '）';
        echo "<dt>$date</dt>\n";
        $schedule_value = get_post_meta($post->ID, 'therapist__schedule__field__' . $current_date, true);
        echo '<dd><input type="text" name="therapist__schedule__field__' . $current_date . '" value="' . $schedule_value . '"></dd>';
        $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
    }

    echo '</dl>';

    echo '<dl>';

    $next_month_start = date('Y-m-01', strtotime($today . ' +1 month'));
    $next_month_end = date('Y-m-t', strtotime($today . ' +1 month'));

    $current_date = $next_month_start;
    while ($current_date <= $next_month_end) {
        $date = date('n/j（', strtotime($current_date));
        $weekday = $weekdays[date('w', strtotime($current_date))];
        $date .= $weekday . '）';
        echo "<dt>$date</dt>\n";
        $schedule_value = get_post_meta($post->ID, 'therapist__schedule__field__' . $current_date, true);
        echo '<dd><input type="text" name="therapist__schedule__field__' . $current_date . '" value="' . $schedule_value . '"></dd>';
        $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
    }

    echo '</dl>';
    echo '</div>';
}

/**
 * カスタムフィールドの値を保存
 * 
 * @param int $post_ID
 */
function save_therapist_fields($post_ID)
{
    // 当月の月初と月末の日付を取得
    $start_date = date('Y-m-01');
    $end_date = date('Y-m-t');

    // 日付の範囲でループ
    $current_date = $start_date;
    while ($current_date <= $end_date) {
        $meta_key = 'therapist__schedule__field__' . $current_date;

        if (isset($_POST[$meta_key])) {
            $schedule_value = $_POST[$meta_key];
            update_post_meta($post_ID, $meta_key, $schedule_value);
        } else {
            delete_post_meta($post_ID, $meta_key);
        }

        $current_date = date('Y-m-d', strtotime($current_date . '+1 day'));
    }

    if (!empty($_POST['therapist__name__field'])) {
        update_post_meta($post_ID, '__therapist__name__field', $_POST['therapist__name__field']);
    }
    if (!empty($_POST['therapist__age__field'])) {
        update_post_meta($post_ID, '__therapist__age__field', $_POST['therapist__age__field']);
    }
    if (!empty($_POST['therapist__unit__field'])) {
        update_post_meta($post_ID, '__therapist__unit__field', $_POST['therapist__unit__field']);
    }
    if (!empty($_POST['therapist__height__field'])) {
        update_post_meta($post_ID, '__therapist__height__field', $_POST['therapist__height__field']);
    }
    if (!empty($_POST['therapist__join__field'])) {
        update_post_meta($post_ID, '__therapist__join__field', $_POST['therapist__join__field']);
    }
    if (!empty($_POST['therapist__comment__field'])) {
        update_post_meta($post_ID, '__therapist__comment__field', $_POST['therapist__comment__field']);
    }
    if (!empty($_POST['therapist__twitter__field'])) {
        update_post_meta($post_ID, '__therapist__twitter__field', $_POST['therapist__twitter__field']);
    } else {
        delete_post_meta($post_ID, '__therapist__twitter__field');
    }
    if (isset($_POST['therapist__new__field']) && $_POST['therapist__new__field'] === 'new') {
        update_post_meta($post_ID, 'therapist__new__field', $_POST['therapist__new__field']);
    } else {
        delete_post_meta($post_ID, 'therapist__new__field');
    }
}
add_action('save_post', 'save_therapist_fields');
