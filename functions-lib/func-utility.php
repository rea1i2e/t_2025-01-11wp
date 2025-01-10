<?php
/**
 * func-utility
 * ユーティリティ関数
 * 投稿が指定した日数以内であるか判定（未設定の場合は7日）
 * 例）$modifier = new_posting(3) ? 'p-post-items--new' : '';
 */
function new_posting($days = 7 ,$entry_time = null){
  $today = date_i18n('U');
  if(!$entry_time) {
    $entry = get_the_time('U');
  }
  $posting = date('U',($today - $entry)) / 86400;
  if( $days > $posting) {
    return true;
  }
  return false;
}