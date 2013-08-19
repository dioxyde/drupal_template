<?php

/**
 * @file
 * Default theme implementation to display a "Publication" node.
 */

  if (isset($content['field_visuel_accroche']) && !empty($content['field_visuel_accroche'][0]['#item']['filename'])) {
    $alt = $content['field_visuel_accroche'][0]['#item']['alt'];
    $title = $content['field_visuel_accroche'][0]['#item']['title'];
    $filename = $content['field_visuel_accroche'][0]['#item']['filename'];
    $uri = $content['field_visuel_accroche'][0]['#item']['uri'];
    $variables['visuel'] = theme('image_style', array(
      'style_name' => 'visuel_accroche',
      'path' => $uri,
      'alt' => $alt,
      'title' => $title
    ));
  }

  if (isset($content['field_couverture_publication']) && !empty($content['field_couverture_publication'][0]['#item']['filename'])) {
    $alt = $content['field_couverture_publication'][0]['#item']['alt'];
    $title = $content['field_couverture_publication'][0]['#item']['title'];
    $filename = $content['field_couverture_publication'][0]['#item']['filename'];
    $uri = $content['field_couverture_publication'][0]['#item']['uri'];
    $variables['couverture'] = theme('image_style', array(
      'style_name' => 'medium',
      'path' => $uri,
      'alt' => $alt,
      'title' => $title
    ));
  }
?>

<article id="node-<?php print $node->nid; ?>" class="bloc-article <?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>>
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a>
    </h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="submitted">
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($content['field_date_sortie_publication'])): ?>
    <div class="complement-titre">
      Par : <?php echo $content['field_auteurs'][0]['#markup'] ?> - <?php echo $content['field_date_sortie_publication'][0]['#markup'] ?>
    </div>
  <?php endif; ?>

  <?php if ($page): ?>
    <div class="dmtoolbar">
      <div class="social-buttons">
        <a href="https://twitter.com/share" class="twitter-share-button" data-lang="fr">Tweeter</a>
      </div>
      <?php if (!empty($content['links']['print_html']) || !empty($content['links']['print_mail']) || !empty($content['links']['print_pdf'])): ?>
        <div class="boutons boutons-droite">
          <?php if (!empty($content['links']['print_html'])): ?>
            <a class="print-html" rel="nofollow" title="Envoyer" href="/<?php echo $print_html_link; ?>">
              <?php echo $print_html_title; ?>
            </a>
          <?php endif; ?>
          <?php if (!empty($content['links']['print_mail'])): ?>
            <a class="print-mail" rel="nofollow" title="Envoyer" href="/<?php echo $print_mail_link; ?>">
              <?php echo $print_mail_title; ?>
            </a>
          <?php endif; ?>
          <?php if (!empty($content['links']['print_pdf'])): ?>
            <a class="print-pdf" rel="nofollow" title="Afficher la version PDF de cette page." href="/<?php echo $print_pdf_link; ?>">
              <?php echo $print_pdf_title; ?>
            </a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div> <!-- /.dmtoolbar -->
  <?php endif; ?>

  <div class="article">
    <div class="rte">
      <div class="content"<?php print $content_attributes; ?>>

        <p class="chapeau clearfix">
          <?php if (!empty($content['field_visuel_accroche'])): ?>
            <span class="illus-gauche">
              <?php echo $variables['visuel'] ?>
              <?php if (!empty($content['field_copyright'][0]['#markup'])): ?>
                <span class="credit"><?php echo $field_copyright[0]['safe_value']; ?></span>
              <?php endif; ?>
            </span>
            <?php if (!empty($content['field_accroche'])): ?>
              <?php echo $field_accroche[0]['safe_value']; ?>
            <?php endif; ?>
          <?php endif; ?>
        </p>

        <?php if (!empty($content['field_couverture_publication'])): ?>
          <span class="illus-droite">
            <?php echo $variables['couverture'] ?>
          </span>
        <?php endif; ?>

        <?php if (!empty($content['field_synthese'])): ?>
          <?php print $content['field_synthese'][0]['#markup'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_lien_telechargement'])): ?>
          <a href="<?php echo file_create_url($content['field_lien_telechargement'][0]['#file']->uri); ?>"
             title="<?php echo $content['field_titre_telechargement'][0]['#markup']; ?>">
            <?php echo $content['field_titre_telechargement'][0]['#markup']; ?>
          </a>
        <?php endif; ?>

        <?php if (!empty($content['field_tags'])): ?>
          <p>
            <span class="label">Tags</span> : <?php print render($content['field_tags']); ?>
          </p>
        <?php endif; ?>

      </div>
    </div>
  </div>
  <!-- /.article -->

</article>
