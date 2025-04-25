<?php
/**
 * func-security
 *  セキュリティ対策
 *
 */

/**
 * wordpressバージョン情報の削除
 * @see　https://digitalnavi.net/wordpress/6921/
 */
remove_action('wp_head', 'wp_generator');

/**
 * CSS, JSのバージョン情報削除
 */
function remove_cssjs_ver2( $src ) {
  if ( strpos( $src, 'ver=' ) )
      $src = remove_query_arg( 'ver', $src );
  return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver2', 9999 );
add_filter( 'script_loader_src', 'remove_cssjs_ver2', 9999 );

/**
 * 投稿者一覧ページを自動で生成されないようにする
 * @see　https://mucca-design.com/auther-archive-ineffective/
 */
function disable_author_archive()
{
  if (preg_match('#/author/.+#', $_SERVER['REQUEST_URI'])) {
    wp_redirect(esc_url(home_url('/404.php')));
    exit;
  }
}
add_action('init', 'disable_author_archive');
