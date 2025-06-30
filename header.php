<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="<?php temp_path('/favicon.ico'); ?>">
  <link rel="apple-touch-icon" href="<?php temp_path('/apple-touch-icon.png'); ?>">
  <?php get_template_part('parts/common/adjust-admin-bar'); ?>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header class="l-header p-header" id="js-header">
    <div class="p-header__inner">
      <?php $tag = (is_front_page()) ? 'h1' : 'div'; ?>
      <<?php echo $tag; ?> class="p-header__logo">
        <a class="p-header__logo-link" href="<?php page_path(); ?>">
          <img src="<?php img_path('/common/logo.svg'); ?>" alt="">
        </a>
      </<?php echo $tag; ?>>
      <button class="p-header__menu-button c-menu-button" id="js-menu" type="button" aria-controls="js-drawer" aria-expanded="false" aria-label="メニューを開閉する">
        <span></span>
      </button>
      <nav class="p-header__pc-nav">
        <ul class="p-header__pc-nav-items">
          <?php foreach (get_nav_items() as $item) : ?>
            <?php if (in_array($item['slug'], ['privacy-policy', 'terms-of-use'])) continue; // 一部除外 
            ?>
            <?php // 現在のページがナビゲーションのリンク先と一致しているかどうかを判定
            if (is_front_page() && $item['slug'] === 'top') {
              $is_current_class = 'is-current';
            } elseif (is_page($item['slug']) || is_post_type_archive($item['slug']) || is_category($item['slug']) || is_tax($item['slug'])) {
              $is_current_class = 'is-current';
            } else {
              $is_current_class = '';
            }
            ?>
            <li class="p-header__pc-nav-item <?php echo isset($item['modifier']) ? 'p-header__pc-nav-item--' . $item['modifier'] : ''; ?> <?php echo $is_current_class ?>">
            <a class="p-header__pc-nav-link" href="<?php echo $item['slug'] === 'top' ? page_path() : page_path($item['slug']); ?>"><?php echo $item['text'] ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      </nav>
    </div>
  </header>
  <nav class="l-drawer p-drawer" id="js-drawer" aria-hidden="true">
    <div class="p-drawer__inner l-inner">
      <ul class="p-drawer__nav-items" id="js-drawer-menu">
        <?php foreach (get_nav_items() as $item) : ?>
          <?php if (in_array($item['slug'], ['privacy-policy', 'terms-of-use'])) continue; // 一部除外 
          ?>
          <?php // 現在のページがナビゲーションのリンク先と一致しているかどうかを判定
          if (is_front_page() && $item['slug'] === 'top') {
            $is_current_class = 'is-current';
          } elseif (is_page($item['slug']) || is_post_type_archive($item['slug']) || is_category($item['slug']) || is_tax($item['slug']) ) {
            $is_current_class = 'is-current';
          } else {
            $is_current_class = '';
          }
          ?>
          <li class="p-drawer__nav-item <?php echo isset($item['modifier']) ? 'p-drawer__nav-item--' . $item['modifier'] : ''; ?> <?php echo $is_current_class ?>">
            <a class="p-drawer__nav-link" href="<?php echo $item['slug'] === 'top' ? page_path() : page_path($item['slug']); ?>"><?php echo $item['text'] ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </nav>