<?php get_header(); ?>
<main>
  <?php get_template_part('parts/project/mv'); ?>
  <?php get_template_part('parts/project/hero-paption'); ?>





  <div class="l-inner">
    <br><br><br><br><br>

    <br><br><br><br><br>
    <h2>フォントサイズの指定</h2>
    <p>フォントサイズのみ、<br />font-size: maxrem(16); のように指定</p>
    <p class="fz12">10pxの指定をした場合、rem(12)だと画面幅768pxに近づくにつれ、小さくなり過ぎる。10px未満になる。</p>
    <p style="font-size: 12px;">10pxの指定をした場合、maxrem(12)だと画面幅768pxに近づくにつれ、最小で10pxになる。</p>
  </div>
</main>
<?php get_footer(); ?>