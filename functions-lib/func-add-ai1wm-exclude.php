<?php
/*
 *All-in-One WP Migrationのエクスポートデータから除外するディレクトリを設定
*/
add_filter(
	'ai1wm_exclude_themes_from_export',
	function ($exclude_filters) {
		$theme_name = 't_2025-01-11wp'; // テーマディレクトリを指定
		$exclude_filters[] = $theme_name . '/.git';
		$exclude_filters[] = $theme_name . '/.gitignore';
		$exclude_filters[] = $theme_name . '/gulp';
		$exclude_filters[] = $theme_name . '/src';
		$exclude_filters[] = $theme_name . '/README.md';

		return $exclude_filters;
	}
);
