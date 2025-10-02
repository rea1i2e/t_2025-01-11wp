<?php
function display_thumbnail($size = 'full') {
    $t = get_thumbnail_data($size);

    // width/height が取れないケース（SVG等）では属性を省略して出力
    $attrs = [
        'src'   => esc_url($t['url']),
        'alt'   => esc_attr($t['alt']),
        'class' => esc_attr($t['class']),
    ];
    if (!empty($t['width']) && !empty($t['height'])) {
        $attrs['width']  = (int) $t['width'];
        $attrs['height'] = (int) $t['height'];
    }

    $html = '<img';
    foreach ($attrs as $k => $v) {
        $html .= ' ' . $k . '="' . $v . '"';
    }
    $html .= '>';
    echo $html;
}

function get_thumbnail_data($size = 'full') {
    if (has_post_thumbnail()) {
        $thumbnail_id  = get_post_thumbnail_id();
        $src           = wp_get_attachment_image_src($thumbnail_id, $size); // [0]=url, [1]=w, [2]=h, [3]=is_intermediate
        $url           = $src ? $src[0] : wp_get_attachment_url($thumbnail_id);
        $width         = $src ? (int) $src[1] : null;
        $height        = $src ? (int) $src[2] : null;
        $class         = '';
        // alt は未設定のケースがあるので、タイトルをフォールバック
        $alt_text      = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        if ($alt_text === '' || $alt_text === null) {
            $alt_text = get_the_title($thumbnail_id) ?: '';
        }
    } else {
        // フォールバック（例: SVG の場合は width/height を省略してもOK）
        $url      = get_template_directory_uri() . '/assets/images/common/logo.svg';
        $width    = 371;   // ここを null にして属性を省略したいなら null に
        $height   = 239;
        $class    = 'u-no-image';
        $alt_text = 'no image';
    }

    return [
        'url'    => $url,
        'width'  => $width,
        'height' => $height,
        'class'  => $class,
        'alt'    => $alt_text,
    ];
}