<?php

/**
 * functions-lib内のファイルを自動読み込み
 * 個別に順序を決めて読み込みたい場合は、require_onceを使用
 * （ループの中で再度読み込むが、require_onceなので、2回目は読み込まれない）
 */

// 個別に順序を決めて読み込み
// require_once get_theme_file_path('functions-lib/func-xxx.php');

// 一括読み込み（順序に依存しない場合のみ）
foreach (glob(get_theme_file_path('functions-lib/*.php')) as $file) {
  require_once $file;
}


?>
