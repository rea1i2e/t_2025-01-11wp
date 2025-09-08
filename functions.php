<?php

/**
 * Functions
 */
// 基本設定
get_template_part('functions-lib/func-base');

// セキュリティー対応
get_template_part('functions-lib/func-security');

// ページの自動生成を防ぐ
get_template_part('functions-lib/func-no-auto-generate');

// All-in-One WP Migrationによるエクスポート除外設定
get_template_part('functions-lib/func-add-ai1wm-exclude');

// ショートコードの設定
get_template_part('functions-lib/func-shortcode');

// URLのショートカット設定
get_template_part('functions-lib/func-url');

// スクリプト、スタイルシートの設定
get_template_part('functions-lib/func-enqueue-assets');

// デフォルト投稿タイプのラベル変更
get_template_part('functions-lib/func-add-posttype-post');

// カスタム投稿の設定
get_template_part('functions-lib/func-add-posttype-works');

// 投稿が指定した日数以内であるか判定（未設定の場合は7日）
// ※未検証
get_template_part('functions-lib/func-utility');

// メインクエリのSP表示件数設定
// ※未検証
get_template_part('functions-lib/func-posts-edit');

// メンテナンスモード
// get_template_part('functions-lib/func-maintenance-mode');

// YouTubeのoEmbedを修正（チャンネル外の関連動画を非表示）
get_template_part('functions-lib/func-modify-youtube-oembed');

// reCAPTCHAの表示制御
get_template_part('functions-lib/func-recaptcha');

// サムネイルの設定
get_template_part('functions-lib/func-thumbnail');

// ナビゲーションアイテムの設定
get_template_part('functions-lib/func-nav-items');
