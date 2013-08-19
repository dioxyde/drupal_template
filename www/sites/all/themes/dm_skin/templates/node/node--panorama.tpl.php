<?php

/**
 * @file
 * Default theme implementation to display a "Panorama" node.
 */

  $date_maj = format_date($changed, 'custom', 'd F Y');

  if (isset($content['field_reperes_franciliens'])) {
    $nb_repere = count($content['field_reperes_franciliens']['#items']);
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
          <?php if (!empty($field_visuel_accroche)): ?>
            <span class="illus-gauche">
              <?php echo $variables['visuel'] ?>
              <?php if (!empty($content['field_copyright'])): ?>
                <span class="credit"><?php echo $field_copyright[0]['safe_value']; ?></span>
              <?php endif; ?>
            </span>
            <?php if (!empty($field_accroche)): ?>
              <?php echo $field_accroche[0]['safe_value'] ?>
            <?php endif; ?>
          <?php endif; ?>
        </p>

        <?php if (!empty($field_titre_1_intro)): ?>
          <h2><?php echo $field_titre_1_intro[0]['safe_value'] ?></h2>
        <?php endif; ?>
        <?php if (!empty($field_texte_intro)): ?>
          <?php echo $field_texte_intro[0]['safe_value'] ?>
        <?php endif; ?>

        <?php if (!empty($field_titre_2_angle_francilien)): ?>
          <h2><?php echo $field_titre_2_angle_francilien[0]['safe_value'] ?></h2>
        <?php endif; ?>
        <?php if (!empty($field_texte_2_francilien)): ?>
          <?php echo $field_texte_2_francilien[0]['safe_value'] ?>
        <?php endif; ?>

        <?php if (!empty($field_titre_3_activites_conc)): ?>
          <h2><?php echo $field_titre_3_activites_conc[0]['safe_value'] ?></h2>
        <?php endif; ?>
        <?php if (!empty($field_texte_3_activites)): ?>
          <?php echo $field_texte_3_activites[0]['safe_value'] ?>
        <?php endif; ?>

        <?php if (!empty($field_titre_4_opportunites)): ?>
          <h2><?php echo $field_titre_4_opportunites[0]['safe_value'] ?></h2>
        <?php endif; ?>
        <?php if (!empty($field_texte_4_opportunites)): ?>
          <?php echo $field_texte_4_opportunites[0]['safe_value'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_reperes_franciliens'])): ?>
          <h2>Quelques repères chiffrés</h2>
          <?php
          for ($i = 0; $i < $nb_repere; $i++) {
            $key = $content['field_reperes_franciliens']['#items']['' . $i . '']['value'];
            $repere = $content['field_reperes_franciliens']['' . $i . '']['entity']['field_collection_item'];
            ?>

            <p class="reperes">
                Infographie <?php print $i + 1 ?> :
                <?php print $content['field_reperes_franciliens']['' . $i . '']['entity']['field_collection_item']['' . $key . '']['field_titre'][0]['#markup'] ?>
            </p>

            <figure>
              <?php print render($repere['' . $key . '']['field_image']) ?>
              <figcaption>
                <?php if (!empty($repere['' . $key . '']['field_source'])): ?>
                  <?php echo $repere['' . $key . '']['field_source'][0]['#markup'] ?>
                <?php endif; ?>
                <?php if (!empty($repere['' . $key . '']['field_note_lecture'])): ?>
                  <?php echo $repere['' . $key . '']['field_note_lecture'][0]['#markup'] ?>
                <?php endif; ?>
              </figcaption>
            </figure>
          <?php
          }
          ?>
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
