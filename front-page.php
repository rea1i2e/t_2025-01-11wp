<?php get_header(); ?>
<main>
  <?php get_template_part('components/top-mv'); ?>
  <?php get_template_part('components/hero-paption'); ?>

  <div class="l-inner">
    <br /><br /><br /><br /><br />
    <h2>pictureタグ出力コンポーネント</h2>
    <div class="dummy__image">
      <?php
      $args = [
        'sp' => true,
        'directory' => '/dummy/',
        'file' => 'dummy2',
        'type' => 'jpg',
        'width' => '1035',
        'height' => '690',
        'spWidth' => '690',
        'spHeight' => '1035',
        'alt' => 'alt指定',
        'lazy' => true
      ];
      get_template_part('components/picture', null, $args);
      ?>
    </div>
    <h2>モーダル</h2>
    <?php get_template_part('components/p-dialog'); ?>
    <h2>タブ切り替え</h2>
    <?php get_template_part('components/p-tab'); ?>
  </div>
</main>
<?php get_footer(); ?>