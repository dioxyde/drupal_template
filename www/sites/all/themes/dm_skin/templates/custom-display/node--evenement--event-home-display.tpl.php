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
    'style_name' => 'remontees_liste',
    'path' => $uri,
    'alt' => $alt,
    'title' => $title
  ));
}
?>

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

    <div class="texte" style="text-align: left;">
      <div class="intro">
        <h2><?php echo $variables['title']; ?></h2>

        <span class="date">
          <?php if ($debut_jour != $fin_jour && $debut_mois == $fin_mois): ?>
            Du <?php print $debut_jour ?>
            au <?php print $fin_jour ?> <?php print $fin_mois ?>.
          <?php elseif ($debut_jour == $fin_jour && $debut_mois == $fin_mois): ?>
            Le <?php print $debut_jour ?> <?php print $debut_mois ?>.
          <?php
          else: ?>
            Du <?php print $debut_jour ?><?php print $debut_mois ?>
            au <?php print $fin_jour ?><?php print $fin_mois ?>.
          <?php endif; ?>
        </span> <?php if (!empty($content['field_accroche'])): ?> <?php echo $field_accroche[0]['safe_value']; ?> <?php endif; ?>
      </div>
    </div>
  </a>
