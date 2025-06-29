<footer class="p-footer l-footer">
  <div class="p-footer__inner l-inner">
  <div class="p-footer__nav">
      <ul class="p-footer__nav-items">
        <?php foreach (get_nav_items() as $item) : ?>
          <?php // 現在のページがナビゲーションのリンク先と一致しているかどうかを判定
          if (is_front_page() && $item['slug'] === 'top') {
            $is_current_class = 'is-current';
          } elseif (is_page($item['slug']) || is_post_type_archive($item['slug']) || is_category($item['slug']) || is_tax($item['slug']) ) {
            $is_current_class = 'is-current';
          } else {
            $is_current_class = '';
          }
          ?>
          <li class="p-footer__nav-item <?php echo isset($item['modifier']) ? 'p-footer__nav-item--' . $item['modifier'] : ''; ?> <?php echo $is_current_class; ?>">
            <a class="p-footer__nav-link" href="<?php echo $item['slug'] === 'top' ? page_path() : page_path($item['slug']); ?>"><?php echo $item['text'] ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    <p class="p-footer__copyright">
      <small>copyright</small>
    </p>
  </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>