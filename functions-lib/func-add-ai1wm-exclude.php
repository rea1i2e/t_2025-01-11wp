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
		$exclude_filters[] = $theme_dir . '/.DS_Store';
		$exclude_filters[] = $theme_dir . '/.github';
		$exclude_filters[] = $theme_dir . '/.vscode';
		$exclude_filters[] = $theme_dir . '/src';
		$exclude_filters[] = $theme_dir . '/README.md';
		$exclude_filters[] = $theme_dir . '/package-lock.json';
		$exclude_filters[] = $theme_dir . '/package.json';
		$exclude_filters[] = $theme_dir . '/node_modules';
		return $exclude_filters;
	}
);
