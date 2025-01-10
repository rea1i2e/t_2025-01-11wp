<?php
/**
 * メンテナンスモード
 *
 */

 function maintenance_mode() {
    if (!current_user_can('edit_themes') || !is_user_logged_in()) {
        wp_die('当サイトはメンテナンス中です。');
    }
}
add_action('get_header', 'maintenance_mode');