<?php get_header(); ?>
<main>
  <div class="l-single p-single">
    <div class="p-single__inner l-inner">
      <div class="p-single__heading">
        <p class="c-section-heading1" data-english="news">
          お知らせ
        </p>
      </div>
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <div class="p-single__container">
            <div class="p-single__container-inner">
              <div class="p-single__head">
                <div class="p-single__meta">
                  <time class="p-single__date" datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>">
                    <?php echo get_the_date('Y.m.d'); ?>
                  </time>
                </div>
                <h1 class="p-single__title">
                  <?php the_title() ?>
                </h1>
              </div>
              <div class="p-single__content p-content">
                <?php the_content() ?>
              </div>

              <!-- 仮 -->
              <div><?php previous_post_link('%link', '&laquo; %title'); ?></div>
              <div><?php next_post_link('%link', '%title &raquo;'); ?></div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
</main>
<?php get_footer(); ?>