<?php
/**
 * func-url
 * パスを定義
 * 記述例
 * <img src="<?php img_path('/common/logo.svg'); ?>" alt="">
 * <a class="" href="<?php page_path(); ?>"></a>
 * <a class="" href="<?php page_path('news'); ?>"></a>
 */


/* テンプレートパスを返す */
function temp_path($file= "") {
  echo esc_url(get_theme_file_uri($file));
}
/* assetsパスを返す */
function assets_path($file= "") {
  echo esc_url(get_theme_file_uri('/assets' . $file));
}
/* 画像パスを返す */
function img_path($file= "") {
  echo esc_url(get_theme_file_uri('/assets/images' . $file));
}
/* mediaフォルダへのURL */
function uploads_path() {
  echo esc_url(wp_upload_dir()['baseurl']);
}

/* ホームURLのパスを返す */
function page_path( $page= "" ) {
  $page = $page . '/';
  echo esc_url(home_url($page));
}

?>
