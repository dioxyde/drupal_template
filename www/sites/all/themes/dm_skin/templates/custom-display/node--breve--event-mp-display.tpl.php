<?php

/**
 * @file
 * Default theme implementation to display a "Evénement - Teaser" node.
 */

if (isset($content['field_visuel_accroche']) && !empty($content['field_visuel_accroche'][0]['#item']['filename'])) {
  $alt = $content['field_visuel_accroche'][0]['#item']['alt'];
  $title = $content['field_visuel_accroche'][0]['#item']['title'];
  $filename = $content['field_visuel_accroche'][0]['#item']['filename'];
  $uri = $content['field_visuel_accroche'][0]['#item']['uri'];
  $variables['visuel'] = theme('image_style', array(
    'style_name' => 'remontees_masterpages',
    'path' => $uri,
    'alt' => $alt,
    'title' => $title
  ));
}
$date_pub = format_date($created, 'custom', 'd F');
?>

  <a href="<?php print $node_url; ?>">
    <?php if (!empty($content['field_visuel_accroche'])): ?>
    <span class="illus">
      <?php echo $variables['visuel'] ?>
    </span>
    <?php endif; ?>

    <div class="texte" style="text-align: left;">
      <div class="intro">
        <h2><span class="date"><?php echo $date_pub ?></span> - <?php echo $variables['title']; ?></h2>

        <?php if (!empty($content['field_accroche'])): ?> <?php echo $field_accroche[0]['safe_value']; ?> <?php endif; ?>
      </div>
    </div>
  </a>
