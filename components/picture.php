<picture>
  <?php if ($args['sp']) : ?>
    <source srcset="<?php img_path($args['directory'] . $args['file'] . '_sp.webp'); ?>" media="(max-width: 767px)" type="image/webp" width="<?php echo $args['spWidth']!=''? $args['spWidth'] : $args['width']; ?>" height="<?php echo $args['spHeight']!=''? $args['spHeight'] :$args['height']; ?>">
    <source srcset="<?php img_path($args['directory'] . $args['file'] . '_sp.' . $args['type']); ?>" media="(max-width: 767px)" type="image/<?php echo $args['type'] ?>" width="<?php echo $args['spWidth']!=''? $args['spWidth'] : $args['width']; ?>" height="<?php echo $args['spHeight']!=''? $args['spHeight'] :$args['height']; ?>">
  <?php endif; ?>
  <source srcset="<?php img_path($args['directory'] . $args['file'] . '.webp'); ?>" type="image/webp" width="<?php echo $args['width']; ?>"  height="<?php echo $args['height']; ?>">
  <img src="<?php img_path($args['directory'] . $args['file'] . '.' . $args['type']); ?>" alt="<?php echo $args['alt']; ?>" width="<?php echo $args['width']; ?>"  height="<?php echo $args['height']; ?>" <?php echo $args['lazy']? 'loading="lazy"' : ''; ?>>
</picture>