<?php
/**
 * func-base
 * WordPressの基本的な機能を設定・追加するための関数群
 *
 * @codex https://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/add_theme_support
 * https://haniwaman.com/functions/
 */

/*--------------------------------------
  テーマ基本機能
--------------------------------------*/
function my_setup() {
  add_theme_support( 'post-thumbnails' );        // アイキャッチ
  add_theme_support( 'automatic-feed-links' );   // RSSフィード
  add_theme_support( 'title-tag' );              // タイトルタグ自動生成
  add_theme_support(
    'html5',
    array( // HTML5での出力
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    )
  );
}
add_action( 'after_setup_theme', 'my_setup' );

/*--------------------------------------
  出力を抑制（絵文字等）
--------------------------------------*/
function my_disable_noise() {
  // 絵文字の無効化（フロント/管理画面/メール/フィード）
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'my_disable_noise' );

/*--------------------------------------
  必要箇所だけ wpautop を無効化
  - 例：お問い合わせページ用テンプレ（page-contact.php）のみ
  - the_content に優先度10で add されているので、'wp' 以降で remove する
--------------------------------------*/
// function my_disable_wpautop_only_where_needed() {
//   if ( is_page_template( 'page-contact.php' ) ) {
//     remove_filter( 'the_content', 'wpautop' );
//     // ※ 抜粋も止めたい場合のみ下を有効化（一覧の体裁が崩れやすいので要注意）
//     // remove_filter( 'the_excerpt', 'wpautop' );
//   }
// }
// add_action( 'wp', 'my_disable_wpautop_only_where_needed' );

/*--------------------------------------
  Contact Form 7 の自動 <p>/<br> 付与を停止
  - CF7 専用フックで最小影響に抑える（the_content の設定とは独立）
--------------------------------------*/
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/*--------------------------------------
  （テンプレ内でピンポイントに止めたい時の例）
  - page-contact.php などで:
  - add_filter('wpcf7_autop_or_not','__return_false');
  - echo do_shortcode('[contact-form-7 id="123" title="お問い合わせ"]');
  - remove_filter('wpcf7_autop_or_not','__return_false');
--------------------------------------*/
