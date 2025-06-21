<?php get_header(); ?>
<main>
  <div class="p-archive l-archive">
    <div class="p-archive__inner l-inner">
      <h1 class="p-works__page-title c-page-title">
        <?php single_cat_title(); ?>
      </h1>
      <?php if (have_posts()) : ?>
        <div class="p-archive__items">
          <?php while (have_posts()) : the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="p-archive__link" data-fadein>
              <figure class="p-archive__thumbnail">
                <?php
                if (has_post_thumbnail()) {
                  // デバッグ用
                  error_log('Post ID: ' . get_the_ID());
                  error_log('Has thumbnail: true');

                  // アイキャッチ画像のURLを取得
                  $thumbnail_url = get_the_post_thumbnail_url(null, 'full');
                  error_log('Thumbnail URL: ' . $thumbnail_url);

                  if ($thumbnail_url) {
                    the_post_thumbnail('full');
                  } else {
                    echo '<img class="u-no-image" src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/logo.svg" alt="no image" width="371" height="239">';
                  }
                } else {
                  error_log('Post ID: ' . get_the_ID());
                  error_log('Has thumbnail: false');
                  echo '<img class="u-no-image" src="' . esc_url(get_template_directory_uri()) . '/assets/images/common/logo.svg" alt="no image" width="371" height="239">';
                }
                ?>
              </figure>
              <h2 class="p-archive__title">
                <span class="u-underline js-hover"><?php the_title() ?></span>
              </h2>
              <p class="p-archive__date">
                <time datetime="<?php echo get_the_date('Y-m-d'); ?>">
                  <?php echo get_the_date('Y / m / d'); ?>
                </time>
              </p>
            </a>
          <?php endwhile; ?>
        </div>
        <div class="p-archive__pagenavi">
          <?php get_template_part('parts/project/p-pagenavi'); ?>
        </div>
      <?php else : ?>
        <p class="p-archive__no-post c-no-post">
          新着情報はありません。
        </p>
      <?php endif; ?>
    </div>
  </div>
</main>
<?php get_footer(); ?>