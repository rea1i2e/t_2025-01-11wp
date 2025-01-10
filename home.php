<?php get_header(); ?>
<main>
  <?php get_template_part('parts/project/breadcrumb') ?>
  <div class="l-post-list p-post-list">
    <div class="p-post-list__inner l-inner">
      <div class="p-post-list__heading">
        <p class="c-section-heading1" data-english="news">
          お知らせ
        </p>
      </div>
      <?php if (have_posts()) : ?>
        <div class="p-post-list__container">
          <div class="p-post-list__container-inner">
            <ul class="p-post-list__items">
              <?php while (have_posts()) : the_post(); ?>
                <LI class="p-post-list__item">
                  <article class="p-post-list__post">
                    <a href="<?php the_permalink(); ?>" class="p-post-list__link">
                      <div class="p-post-list__meta">
                        <time class="p-post-list__date" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">
                          <?php echo get_the_date('Y.m.d'); ?>
                        </time>
                      </div>
                      <h1 class="p-post-list__title">
                        <?php the_title() ?>
                      </h1>
                    </a>
                  </article>
                </LI>
              <?php endwhile; ?>
            </ul>
          </div>
        </div>
        <div class="p-post-list__pagenavi p-pagenavi">
          <?php wp_pagenavi(); ?>
        </div>
      <?php else : ?>
        <p class="p-post-list__no-post c-no-post">
          新着情報はありません。
        </p>
      <?php endif; ?>
</main>
<?php get_footer(); ?>