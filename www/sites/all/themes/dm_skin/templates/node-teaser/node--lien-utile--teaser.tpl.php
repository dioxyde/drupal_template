<?php

/**
 * @file
 * Default theme implementation to display a "Lien utile - Teaser" node.
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

    <div class="texte">
      <?php print render($title_prefix); ?>
      <h2<?php print $title_attributes; ?>><?php print $title; ?></h2>
      <?php print render($title_suffix); ?>

      <div class="intro">
        <?php if (!empty($content['field_accroche'])): ?>
          <?php echo $field_accroche[0]['safe_value']; ?>
        <?php endif; ?>
      </div>
    </div>

  </a>
</li>