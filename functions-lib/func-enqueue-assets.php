<?php

/**
 * func-enqueue-assets
 * CSSとJavaScriptの読み込み
 */
function my_script_init()
{
  // WordPressのデフォルトjQueryを使用
  // プラグインとの互換性が高く、依存関係の管理が適切に行われる
  
  // 基本JavaScript（type="module"で読み込み、ES6モジュールとして実行）
  wp_enqueue_script('my-script', get_theme_file_uri() . '/assets/js/bundle.js', [], filemtime(get_theme_file_path('assets/js/bundle.js')), false);
  
  // 基本CSS
  wp_enqueue_style('my-style', get_theme_file_uri() . '/assets/css/style.css', [], filemtime(get_theme_file_path('assets/css/style.css')), 'all');
}
add_action('wp_enqueue_scripts', 'my_script_init');

/**
 * bundle.jsにtype="module"属性を追加
 */
function add_module_type_to_script($tag, $handle, $src)
{
  if ('my-script' === $handle) {
    $tag = str_replace('<script ', '<script type="module" ', $tag);
  }
  return $tag;
}
add_filter('script_loader_tag', 'add_module_type_to_script', 10, 3);
