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
    <h4 class="admin_h4">画像</h4>
    <div class="upload_media_wrap">
        <?php for ($i = 0; $i < 4; $i++) : ?>
            <div class="item">
                <div class="admin_media">
                    <img id="image-preview-<?php echo $i; ?>" src="<?php echo get_post_meta($post->ID, '__therapist__img' . $i . '__field', true); ?>">
                </div>
                <div class="flex">
                    <input id="upload_image_button-<?php echo $i; ?>" type="button" class="button upload_image_button" value="画像選択" />
                    <input id="remove_image_button-<?php echo $i; ?>" type="button" class="button remove_image_button" value="削除" />
                    <input type="hidden" name="therapist__img<?php echo $i; ?>__field" id="image_attachment_id-<?php echo $i; ?>" value="<?php echo get_post_meta($post->ID, '__therapist__img' . $i . '__field', true); ?>" />
                </div>
            </div>
        <?php endfor; ?>
    </div>
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
    media_selector_print_scripts();
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
    $today = date('Y-m-d');
    $current_month_start = date('Y-m-01', strtotime($today));
    $current_month_end = date('Y-m-t', strtotime($today . ' +1 month'));;

    // 日付の範囲でループ
    $current_date = $current_month_start;
    while ($current_date <= $current_month_end) {
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
    for ($i = 0; $i < 4; $i++) {
        if (isset($_POST['therapist__img' . $i . '__field'])) {
            update_post_meta($post_ID, '__therapist__img' . $i . '__field', $_POST['therapist__img' . $i . '__field']);
        } else {
            delete_post_meta($post_ID, '__therapist__img' . $i . '__field');
        }
    }
}
add_action('save_post', 'save_therapist_fields');

/**
 * 管理画面に追加するメディアアップロードのスクリプト
 *
 * @return void
 */
function media_selector_print_scripts()
{
    $saved_attachment_post_id = get_option('media_selector_attachment_id', 0);
?>
    <script type='text/javascript'>
        jQuery(document).ready(function($) {
            var file_frame;
            var wp_media_post_id = wp.media.model.settings.post.id;
            var set_to_post_id = <?php echo $saved_attachment_post_id; ?>;
            jQuery('.upload_image_button').on('click', function(event) {
                event.preventDefault();

                btn_id = $(this).attr('id');
                btn_no = btn_id.replace('upload_image_button-', '');

                if (file_frame) {
                    file_frame.uploader.uploader.param('post_id', set_to_post_id);
                    file_frame.open();
                    return;
                } else {
                    wp.media.model.settings.post.id = set_to_post_id;
                }
                file_frame = wp.media.frames.file_frame = wp.media({
                    title: '画像を選択',
                    button: {
                        text: '画像を設定',
                    },
                    multiple: false
                });
                file_frame.on('select', function() {
                    attachment = file_frame.state().get('selection').first().toJSON();
                    $('#image-preview-' + btn_no).attr('src', attachment.url);
                    $('#image_attachment_id-' + btn_no).val(attachment.url);
                });
                file_frame.open();
            });

            $('.remove_image_button').on('click', function() {
                btn_id = $(this).attr('id');
                btn_no = btn_id.replace('remove_image_button-', '');
                $('#image-preview-' + btn_no).attr('src', '');
                $('#image_attachment_id-' + btn_no).val('');
            });
        });
    </script>

<?php
}
