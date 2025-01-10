<?php
$footerNavItems = [
  [
    'slug' => 'news',
    'text' => 'お知らせ',
  ],
  [
    'slug' => 'contact',
    'text' => 'お問い合わせ',
  ],
];
?>
<footer class="p-footer l-footer">
  <div class="p-footer__inner l-inner">
    <div class="p-footer__nav">
      <ul class="p-footer__nav-items">
        <?php foreach ($footerNavItems as $item) : ?>
          <li class="p-footer__nav-item">
            <a href="<?php page_path($item['slug']); ?>"><?php echo $item['text'] ?></a>
          </li>
        <?php endforeach; ?>
      </ul>

    </div>
    <p class="p-footer__copyright">
      <small>copyright</small>
    </p>
  </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>