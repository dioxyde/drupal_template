<?php

/**
 * @file
 * Default theme implementation to display a "Rapport d'étude - Teaser" node.
 */

  if (isset($content['field_visuel_accroche']) && !empty($content['field_visuel_accroche'][0]['#item']['filename'])) {
    $alt = $content['field_visuel_accroche'][0]['#item']['alt'];
    $title = $content['field_visuel_accroche'][0]['#item']['title'];
    $filename = $content['field_visuel_accroche'][0]['#item']['filename'];
    $uri = $content['field_visuel_accroche'][0]['#item']['uri'];
    $variables['visuel'] = theme('image_style', array(
      'style_name' => 'remontees_liste',
      'path' => $uri,
      'alt' => $alt,
      'title' => $title
    ));
  }
?>

<li class="<?php print $type; ?> item">
  <a href="<?php print $node_url; ?>">

    <?php if (!empty($content['field_visuel_accroche'])): ?>
      <span class="illus">
        <?php echo $variables['visuel'] ?>
        <?php if (!empty($content['field_copyright'][0]['#markup'])): ?>
          <span class="credit">
            <?php echo $field_copyright[0]['safe_value']; ?>
          </span>
        <?php endif; ?>
      </span>
    <?php endif; ?>

    <div class="texte">
      <h2<?php print $title_attributes; ?>><?php echo $variables['title']; ?></h2>
      <div class="intro">
        <?php if (!empty($content['field_accroche'])): ?>
          <?php echo $field_accroche[0]['safe_value']; ?>
        <?php endif; ?>
      </div>
    </div>

  </a>
</li>
