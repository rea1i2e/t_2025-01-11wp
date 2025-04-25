<?php
/*
 *All-in-One WP Migrationのエクスポートデータから除外するディレクトリを設定
*/
add_filter(
	'ai1wm_exclude_themes_from_export',
	function ($exclude_filters) {
		$theme_dir = basename(get_theme_root() . '/' . get_stylesheet()); // 実際のテーマディレクトリ名を取得
		$exclude_filters[] = $theme_dir . '/.git';
		$exclude_filters[] = $theme_dir . '/.gitignore';
		$exclude_filters[] = $theme_dir . '/gulp';
		$exclude_filters[] = $theme_dir . '/src';
		$exclude_filters[] = $theme_dir . '/README.md';

		return $exclude_filters;
	}
);
