<?php

/**
 * @file
 * Default theme implementation to display a "Réseau" node.
 */

  $date_maj = format_date($changed, 'custom', 'd F Y');
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

        <?php if (!empty($content['field_accroche'])): ?>
          <p class="chapeau">
            <?php echo $field_accroche[0]['safe_value']; ?>
          </p>
        <?php endif; ?>

        <?php if (!empty($content['field_missions'])): ?>
          <h2><?php echo $content['field_missions']['#title'] ?></h2>
          <?php echo $content['field_missions'][0]['#markup'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_beneficiaires'])): ?>
          <h2><?php echo $content['field_beneficiaires']['#title'] ?></h2>
          <?php echo $content['field_beneficiaires'][0]['#markup'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_modalites_inscription'])): ?>
          <h2><?php echo $content['field_modalites_inscription']['#title'] ?></h2>
          <?php echo $content['field_modalites_inscription'][0]['#markup'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_contenu_dispositif'])): ?>
          <h2><?php echo $content['field_contenu_dispositif']['#title'] ?></h2>
          <?php echo $content['field_contenu_dispositif'][0]['#markup'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_methodes_prestations'])): ?>
          <h2><?php echo $content['field_methodes_prestations']['#title'] ?></h2>
          <?php echo $content['field_methodes_prestations'][0]['#markup'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_modalites_accueil'])): ?>
          <h2><?php echo $content['field_modalites_accueil']['#title'] ?></h2>
          <?php echo $content['field_modalites_accueil'][0]['#markup'] ?>
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
