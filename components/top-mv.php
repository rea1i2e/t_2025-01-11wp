<?php
$common_image_args = [
  'sp' => true,
  'directory' => '/dummy/',
  'lazy' => false,
];

$images = [
  array_merge($common_image_args, [
    'file' => 'dummy1',
    'type' => 'jpg',
    'alt' => '',
    'width' => 1440,
    'height' => 900,
    'spWidth' => 375,
    'spHeight' => 600,
  ]),
  array_merge($common_image_args, [
    'file' => 'dummy2',
    'type' => 'jpg',
    'alt' => '',
    'width' => 1440,
    'height' => 900,
    'spWidth' => 375,
    'spHeight' => 600,
  ]),
  array_merge($common_image_args, [
    'file' => 'dummy3',
    'type' => 'jpg',
    'alt' => '',
    'width' => 1440,
    'height' => 900,
    'spWidth' => 375,
    'spHeight' => 580,
  ]),
];
?>

<section class="p-top-mv l-top-mv" id="js-mv">
  <div class="p-top-mv__slider splide" id="js-top-mv-splide">
    <div class="p-top-mv__slider-track splide__track">
      <ul class="p-top-mv__slider-list splide__list">
        <?php foreach ($images as $args): ?>
        <li class="p-top-mv__slider-item splide__slide">
          <?php get_template_part('components/picture', null, $args); ?>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div class="p-top-mv__copy">
    <div class="p-top-mv__inner l-inner">
      <h2 class="p-top-mv__copy-text">
        問いを持ち、行動する。<br />
        世界と地域をつなぐ視点が、<br />
        ここにある。
      </h2>
    </div>
  </div>
</section>