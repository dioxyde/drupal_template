<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
?>

<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php if ($title_suffix): ?>
    <?php print render($title_suffix); ?>
  <?php endif;?>

  <div class="push-videosassociees content">
    <?php if ($block->subject): ?>
      <h2 class="titre-push"><span><?php print $block->subject ?></span></h2>
    <?php endif;?>
    <?php print $content ?>
  </div>

</div>
