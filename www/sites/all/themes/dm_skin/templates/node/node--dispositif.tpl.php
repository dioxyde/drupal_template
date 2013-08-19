<?php

/**
 * @file
 * Default theme implementation to display a "Dispositif" node.
 */

  $date_maj = format_date($changed, 'custom', 'd F Y');

  if (isset($content['field_rubrique_libre'])) {
    $nb_rubrique = count($content['field_rubrique_libre']['#items']);
  }

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

  <?php if ($changed): ?>
    <div class="complement-titre">
      Mis à jour le <?php echo $date_maj ?>
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
                <span class="credit">&copy;
                  &nbsp;<?php echo $content['field_copyright'][0]['#markup'] ?></span>
              <?php endif; ?>
            </span>
            <?php if (!empty($content['field_accroche'])): ?>
              <?php echo $field_accroche[0]['safe_value']; ?>
            <?php endif; ?>
          <?php endif; ?>
        </p>

        <?php if (!empty($content['field_objectifs'])): ?>
          <h2><?php echo $content['field_objectifs']['#title'] ?></h2>
          <?php echo $field_objectifs[0]['safe_value'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_beneficiaires'])): ?>
          <h2><?php echo $content['field_beneficiaires']['#title'] ?></h2>
          <?php echo $field_beneficiaires[0]['safe_value'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_modalites_inscription'])): ?>
          <h2><?php echo $content['field_modalites_inscription']['#title'] ?></h2>
          <?php echo $field_modalites_inscription[0]['safe_value'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_contenu_dispositif'])): ?>
          <h2><?php echo $content['field_contenu_dispositif']['#title'] ?></h2>
          <?php echo $field_contenu_dispositif[0]['safe_value'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_duree_dispositif'])): ?>
          <h2><?php echo $content['field_duree_dispositif']['#title'] ?></h2>
          <?php echo $field_duree_dispositif[0]['safe_value'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_cout_remuneration'])): ?>
          <h2><?php echo $content['field_cout_remuneration']['#title'] ?></h2>
          <?php echo $field_cout_remuneration[0]['safe_value'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_financement'])): ?>
          <h2><?php echo $content['field_financement']['#title'] ?></h2>
          <?php echo $field_financement[0]['safe_value'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_rubrique_libre'])): ?>
          <?php for ($i = 0; $i < $nb_rubrique; $i++) {
            $key = $content['field_rubrique_libre']['#items']['' . $i . '']['value'] ?>
            <h2><?php echo $content['field_rubrique_libre']['' . $i . '']['entity']['field_collection_item']['' . $key . '']['field_titre_rubrique_libre'][0]['#markup'] ?></h2>
            <?php print render($content['field_rubrique_libre']['' . $i . '']['entity']['field_collection_item']['' . $key . '']['field_texte_rubrique_libre']) ?>
          <?php } ?>
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

  <?php if (!empty($content['field_savoir_plus'])): ?>
    <?php print render($content['field_savoir_plus']); ?>
  <?php endif; ?>

</article>
