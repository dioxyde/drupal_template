<?php

/**
 * @file
 * Default theme implementation to display a "Brève" node.
 */
dpm($content);

  if (isset($content['field_logo']) && !empty($content['field_logo'][0]['#item']['filename'])) {
    $alt = $content['field_logo'][0]['#item']['alt'];
    $title = $content['field_logo'][0]['#item']['title'];
    $filename = $content['field_logo'][0]['#item']['filename'];
    $uri = $content['field_logo'][0]['#item']['uri'];
    $variables['visuel'] = theme('image_style', array(
      'style_name' => 'visuel_logo',
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
      <a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="submitted">
      <?php print $submitted; ?>
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


        <?php if (!empty($content['field_logo'])): ?>
          <?php print render($content['field_logo']); ?>
        <?php endif; ?>

        <?php if (!empty($content['body'])): ?>
          <?php print render($content['body']); ?>
        <?php endif; ?>

        <?php if (!empty($content['field_adresse'])): ?>
          <?php print render($content['field_adresse']); ?>
        <?php endif; ?>

        <?php if (!empty($content['field_telephone'])): ?>
          <?php print render($content['field_telephone']); ?>
        <?php endif; ?>

        <?php if (!empty($content['field_fax_organisme'])): ?>
          <?php print render($content['field_fax_organisme']); ?>
        <?php endif; ?>

        <?php if (!empty($content['field_mail_contact'])): ?>
          <?php print render($content['field_mail_contact']); ?>
        <?php endif; ?>

        <?php if (!empty($content['field_site_web'])): ?>
          <?php print render($content['field_site_web']); ?>
        <?php endif; ?>


      </div>
    </div>
  </div>
  <!-- /.article -->
</article>
