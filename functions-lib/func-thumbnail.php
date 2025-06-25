<?php
function display_thumbnail($size = 'full') {
    $thumbnail_data = get_thumbnail_data($size);
    $url = $thumbnail_data['url'];
    $alt = $thumbnail_data['alt'];
    $width = $thumbnail_data['width'];
    $height = $thumbnail_data['height'];
    $class = $thumbnail_data['class'];

    echo '<img src="' . esc_url($url) . '" alt="' . esc_attr($alt) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" class="' . esc_attr($class) . '">';
}

function get_thumbnail_data($size = 'full') {
    if (has_post_thumbnail()) {
        $thumbnail_id = get_post_thumbnail_id();
        $thumbnail_url = get_the_post_thumbnail_url(null, $size);
        $thumbnail_meta = wp_get_attachment_metadata($thumbnail_id);
        $width = $thumbnail_meta['width']; // デフォルトの幅
        $height = $thumbnail_meta['height']; // デフォルトの高さ
        $class = '';
        
        // サムネイルのaltテキストを取得
        $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        
        // altテキストが空の場合は投稿のタイトルを使用
        if (empty($alt_text)) {
            $alt_text = get_the_title();
        }
    } else {
        $thumbnail_url = esc_url(get_template_directory_uri()) . '/assets/images/common/logo.svg';
        $width = 371; // デフォルトの幅
        $height = 239; // デフォルトの高さ
        $class = 'u-no-image';
        $alt_text = get_the_title(); // デフォルトのaltテキスト
    }
    return [
        'url' => $thumbnail_url,
        'width' => $width,
        'height' => $height,
        'class' => $class,
        'alt' => $alt_text
    ];
} 