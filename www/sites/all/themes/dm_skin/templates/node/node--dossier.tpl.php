<?php

/**
 * @file
 * Default theme implementation to display a "Dossier" node.
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

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

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

  <div class="bloc-article">

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
                <?php if (!empty($field_copyright)): ?>
                  <span class="credit">&copy;
                    &nbsp;<?php echo $field_copyright[0]['safe_value']; ?></span>
                <?php endif; ?>
              </span>
              <?php if (!empty($field_accroche)): ?>
                <?php echo $field_accroche[0]['safe_value']; ?>
              <?php endif; ?>
            <?php endif; ?>
          </p>

        </div>
      </div>
    </div>
  </div>
  <!-- /.bloc-article -->

  <ul class="accordeon">
    <?php
    for ($i = 1; $i < 8; $i++) {
      ?>
      <?php if (!empty($content['field_titre' . $i . '_dossier'])): ?>
        <li>
          <h2><?php echo $content['field_titre' . $i . '_dossier'][0]['#markup']; ?></h2>

          <div class="content">
            <div class="rte">
              <?php echo $content['field_texte' . $i . '_dossier'][0]['#markup']; ?>
            </div>
          </div>
        </li>
      <?php endif; ?>
    <?php
    }
    ?>
    <?php if (!empty($field_reperes_franciliens)): ?>
      <li>
        <h2>Quelques repères franciliens</h2>

        <div class="content">
          <div class="rte">
            <?php
            for ($i = 0; $i < $nb_repere; $i++) {
              $key = $content['field_reperes_franciliens']['#items']['' . $i . '']['value']
              ?>
              <p class="reperes">
                Infographie <?php print $i + 1 ?> :
                <?php print $content['field_reperes_franciliens']['' . $i . '']['entity']['field_collection_item']['' . $key . '']['field_titre'][0]['#markup'] ?>
              </p>
              <?php print render($content['field_reperes_franciliens']['' . $i . '']['entity']['field_collection_item']['' . $key . '']['field_image']) ?>
              <div class="legende">
                <?php if (!empty($content['field_reperes_franciliens']['' . $i . '']['entity']['field_collection_item']['' . $key . '']['field_source'])): ?>
                  <?php print render($content['field_reperes_franciliens']['' . $i . '']['entity']['field_collection_item']['' . $key . '']['field_source']) ?>
                <?php endif; ?>
                <?php if (!empty($content['field_reperes_franciliens']['' . $i . '']['entity']['field_collection_item']['' . $key . '']['field_note_lecture'])): ?>
                  <?php print render($content['field_reperes_franciliens']['' . $i . '']['entity']['field_collection_item']['' . $key . '']['field_note_lecture']) ?>
                <?php endif; ?>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </li>
    <?php endif; ?>
    <?php if (!empty($content['field_tags'])): ?>
      <li>
        <h2>Tags</h2>

        <div class="content">
          <div class="rte">
            <?php if (!empty($content['field_tags'])): ?>
              <p>
                <span class="label">Tags</span> : <?php print render($content['field_tags']); ?>
              </p>
            <?php endif; ?>
          </div>
        </div>
      </li>
    <?php endif; ?>
  </ul>

  <div class="bouton-wrapper">
    <a class="bouton ouvre-accordeons" href="javascript:void(0)">
      Lire tout le dossier
    </a>
  </div>

</article>
