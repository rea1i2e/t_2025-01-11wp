<?php

/**
 * 自動生成されるページの表示を防ぐ（404エラーにする）
 * is_author()の部分で、表示したくないページを指定する
 * 例 if(is_category() || is_tag() || is_date() || is_author()) など
 * ・デフォルト投稿詳細ページ is_singular('post') ※()内は、投稿タイプ名
 * ・投稿者一覧ページ is_author()
 * ・カテゴリーページ is_category()
 * ・タグページ is_tag()
 * ・日付ページ is_date()
 * ・検索結果ページ is_search()
 * ・404ページ is_404()
 * ・メンバーズページ is_member() ※会員専用ページ／会員制ページ
 */

// 投稿者一覧ページ404エラーにする
add_action('template_redirect', function () {
  if (is_author()) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    nocache_headers();
  }
});
