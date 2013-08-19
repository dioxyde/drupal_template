<?php

/**
 * @file
 * Default theme implementation to display a block.
 *
 */
?>

<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if ($block->subject): ?>
  <h2<?php print $title_attributes; ?> class="titre-breves"><?php print $block->subject ?></h2>
  <?php endif;?>
  <?php print render($title_suffix); ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php print $content ?>
    <div class="voir-tout-wrapper">
      <a class="voir-tout" href="/breves?field_rubriques_rattachement_tid=All">Toutes les brèves</a>
    </div>
  </div>

</div>