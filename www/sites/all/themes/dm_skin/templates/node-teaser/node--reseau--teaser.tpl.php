<?php

/**
 * @file
 * Default theme implementation to display a "Réseau - Teaser" node.
 */
?>

<li class="<?php print $type; ?> item">
  <a href="<?php print $node_url; ?>">

    <div class="texte" style="width: 100%">
      <h2<?php print $title_attributes; ?>><?php echo $variables['title']; ?></h2>
      <div class="intro">
        <?php if (!empty($content['field_accroche'])): ?>
          <?php echo $field_accroche[0]['safe_value']; ?>
        <?php endif; ?>
      </div>
    </div>

  </a>
</li>
