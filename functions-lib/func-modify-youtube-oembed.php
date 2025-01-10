<?php
function modify_youtube_oembed($html, $url, $args) {
  if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
      $html = str_replace('?feature=oembed', '?feature=oembed&rel=0', $html);
  }
  return $html;
}
add_filter('oembed_result', 'modify_youtube_oembed', 10, 3);