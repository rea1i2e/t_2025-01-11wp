<div class="p-pagenavi">
  <?php
  $args = [
    'mid_size' => 2,
    'prev_text' => '<span class="c-button c-button--back"><span class="c-button__arrow"></span>back</span>',
    'next_text' => '<span class="c-button">next<span class="c-button__arrow"></span></span>',
  ];
  the_posts_pagination($args);
  ?>
</div>