<?php
/**
 * @file
 * 
 */
?>

<div class="bloc-shp shp-web-tv">
  <?php if ($header): ?>
    <?php print $header; ?>
  <?php endif; ?>

  <?php if ($rows): ?>
    <div class="carousel-videos">
      <?php print $rows; ?>
    </div>
  <?php elseif ($empty): ?>
    <div class="view-empty">
      <?php print $empty; ?>
    </div>
  <?php endif; ?>

</div><?php /* class view */ ?>