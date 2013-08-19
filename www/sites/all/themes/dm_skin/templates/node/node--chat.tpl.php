<?php

/**
 * @file
 * Default theme implementation to display a "Chat" node.
 */

  dpm($content);

  if (isset($content['field_photo_invite']) && !empty($content['field_photo_invite'][0]['#item']['filename'])) {
    $alt = $content['field_photo_invite'][0]['#item']['alt'];
    $title = $content['field_photo_invite'][0]['#item']['title'];
    $filename = $content['field_photo_invite'][0]['#item']['filename'];
    $uri = $content['field_photo_invite'][0]['#item']['uri'];
    $variables['photo_temoin'] = theme('image_style', array(
      'style_name' => 'push_temoignage',
      'path' => $uri,
      'alt' => $alt,
      'title' => $title
    ));
  }
?>

<article id="node-<?php print $node->nid; ?>" class="bloc-article <?php print $classes; ?>" <?php print $attributes; ?>>

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

  <?php if (!empty($content['field_date_chat'])): ?>
    <div class="complement-titre">
      Le <?php echo format_date($content['field_date_chat']['#items'][0]['value'], 'custom', 'd F Y'); ?>
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
          <?php if (!empty($content['field_accroche'])): ?>
            <?php echo $field_accroche[0]['safe_value'] ?>
          <?php endif; ?>
        </p>

        <h2>L invité</h2>

        <div class="invites_chat">
          <div class="invite_chat invite_chat_gauche">
            <span class="avatar"><?php echo $variables['photo_temoin'] ?></span>
            <div class="texte">
              <div class="auteur">
                <?php if (!empty($content['field_notre_invite'])): ?>
                  <?php echo $content['field_notre_invite'][0]['#markup'] ?>
                <?php endif; ?>
              </div>
              <?php if (!empty($content['field_fonction'])): ?>
                <?php echo $content['field_fonction'][0]['#markup'] ?>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!--blockquote>
          <?php if (!empty($content['field_citation'])): ?>
            &laquo; <?php echo $content['field_citation'][0]['#markup'] ?> &raquo;
          <?php endif; ?>
        </blockquote-->

      </div>
    </div>
  </div>
  <!-- /.article -->

  <div class="chat">
    <?php if (!empty($content['field_questions_reponses'])): ?>
      <?php echo $content['field_questions_reponses'][0]['#markup'] ?>
    <?php endif; ?>

    <!--div>
    <?php if (!empty($content['field_tags'])): ?>
      <p><span class="label">Tags</span> : <?php print render($content['field_tags']); ?></p>
    <?php endif; ?>
    </div-->
  </div>

  <?php if (!empty($content['field_savoir_plus'])): ?>
    <div class="supplement">
      <?php print render($content['field_savoir_plus']); ?>
    </div>
  <?php endif; ?>

</article>
