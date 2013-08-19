<?php

/**
 * @file
 * Default theme implementation to display a "Témoignage" node.
 */

  $date_pub = format_date($created, 'custom', 'd F Y');

  if (isset($content['field_visuel_identite']) && !empty($content['field_visuel_identite'][0]['#item']['filename'])) {
    $alt = $content['field_visuel_identite'][0]['#item']['alt'];
    $title = $content['field_visuel_identite'][0]['#item']['title'];
    $filename = $content['field_visuel_identite'][0]['#item']['filename'];
    $uri = $content['field_visuel_identite'][0]['#item']['uri'];
    $variables['photo_temoin'] = theme('image_style', array(
      'style_name' => 'push_temoignage',
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

  <div class="complement-titre"><?php echo $date_pub ?></div>

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

        <h2><?php echo $field_identite[0]['safe_value'] ?>
          - <?php echo $field_fonction[0]['safe_value'] ?></h2>

        <p class="chapeau clearfix">
          <?php if (!empty($content['field_visuel_identite'])): ?>
            <span class="illus-gauche"><?php echo $variables['photo_temoin'] ?></span>
          <?php endif; ?>

          <?php if (!empty($content['field_accroche'])): ?>
            <?php echo $field_accroche[0]['safe_value'] ?>
          <?php endif; ?>
        </p>

        <blockquote>
          <?php if (!empty($content['field_citation'])): ?>
            &laquo; <?php echo $field_citation[0]['safe_value'] ?> &raquo;
          <?php endif; ?>
        </blockquote>

        <?php if (!empty($content['field_questions_reponses'])): ?>
          <?php echo $field_questions_reponses[0]['safe_value'] ?>
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
