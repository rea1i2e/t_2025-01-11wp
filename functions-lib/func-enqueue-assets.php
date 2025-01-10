<?php

/**
 * func-enqueue-assets
 * CSSとJavaScriptの読み込み
 * スライダーを使用しない場合
 *
 * @codex https://wpdocs.osdn.jp/%E3%83%8A%E3%83%93%E3%82%B2%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%83%A1%E3%83%8B%E3%83%A5%E3%83%BC
 */
function my_script_init()
{
  // フォントの設定
  wp_enqueue_style('NotoSansJP', '//fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap', [], null);

  // WordPressがデフォルトで提供するjQueryは使用しない
  wp_deregister_script('jquery');
  // jQuery
  wp_enqueue_script('jquery', '//code.jquery.com/jquery-3.6.1.min.js', [], '3.6.1');
  // Splide用のJS
  wp_enqueue_script('splide-script', '//cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/js/splide.min.js', [], null, true);
  // 基本JavaScript
  wp_enqueue_script('my-script', get_theme_file_uri() . '/assets/js/script.js', [], filemtime(get_theme_file_path('assets/js/script.js')), true);
  // Splide用のCSS
  wp_enqueue_style('splide-style', '//cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/css/splide-core.min.css', [], null, 'all');
  // 基本CSS
  wp_enqueue_style('my-style', get_theme_file_uri() . '/assets/css/style.css', [], filemtime(get_theme_file_path('assets/css/style.css')), 'all');
}
add_action('wp_enqueue_scripts', 'my_script_init');
