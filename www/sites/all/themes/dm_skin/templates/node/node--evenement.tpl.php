<?php

/**
 * @file
 * Default theme implementation to display a "Evénement" node.
 */

  drupal_add_js('https://maps.googleapis.com/maps/api/js?sensor=false', 'external');

  $theme = base_path() . path_to_theme();

  $adresse = $content['field_adresse'][0]['#address'];
  $link = $content['field_site_web'][0]['#element'];
  $geo = $content['field_adresse_geo']['#items'][0];

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

        <?php if (!empty($content['field_visuel_accroche'])): ?>
          <div class="illus-droite">
            <?php echo $variables['visuel'] ?>
            <?php if (!empty($content['field_copyright'][0]['#markup'])): ?>
              <span class="credit">
                &copy; &nbsp;<?php echo $content['field_copyright'][0]['#markup'] ?>
              </span>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <p>
          <span class="label">Date : </span>
          <?php if ($debut_jour != $fin_jour && $debut_mois == $fin_mois): ?>
            Du <?php print $debut_jour ?>
            au <?php print $fin_jour ?> <?php print $fin_mois ?>
          <?php elseif ($debut_jour == $fin_jour && $debut_mois == $fin_mois): ?>
            Le <?php print $debut_jour ?> <?php print $debut_mois ?>
          <?php
          else: ?>
            Du <?php print $debut_jour ?> <?php print $debut_mois ?>
            au <?php print $fin_jour ?> <?php print $fin_mois ?>
          <?php endif; ?>
          <?php if (!empty($content['field_horaire'])): ?>
            <?php echo $content['field_horaire'][0]['#markup'] ?>
          <?php endif; ?>
        </p>

        <?php if (!empty($content['field_lieu_evenement'])): ?>
          <p>
            <span class="label">Lieu : </span>
            <?php echo $content['field_lieu_evenement'][0]['#markup'] ?>
          </p>
        <?php endif; ?>

        <?php if (!empty($content['field_accroche'])): ?>
          <p class="chapeau">
            <?php echo $field_accroche[0]['safe_value']; ?>
          </p>
        <?php endif; ?>

        <?php if (!empty($content['field_presentation'])): ?>
          <?php echo $content['field_presentation'][0]['#markup'] ?>
        <?php endif; ?>

        <?php if (!empty($content['field_modalite_participation'])): ?>
          <p>
            <span class="label"><?php echo $content['field_modalite_participation']['#title']; ?></span><br/>
            <?php echo $content['field_modalite_participation'][0]['#markup'] ?>
          </p>
        <?php endif; ?>

        <p>
          <span class="label"><?php echo $content['field_organisateur_principal']['#title']; ?></span>

          <?php if (!empty($content['field_organisateur_principal'])): ?>
            <br/><?php echo $content['field_organisateur_principal'][0]['#markup'] ?>
          <?php endif; ?>

          <?php if (!empty($content['field_mail_contact'])): ?>
            <br/><span class="icon info-mel">&nbsp;</span>
            <?php echo $content['field_mail_contact'][0]['#markup'] ?>
          <?php endif; ?>

          <?php if (!empty($content['field_telephone'])): ?>
            <br/><span class="icon info-tel">&nbsp;</span>
            <?php echo $content['field_telephone'][0]['#markup'] ?>
          <?php endif; ?>

          <?php if (!empty($content['field_site_web'])): ?>
            <br/><span class="icon info-web">&nbsp;</span>
            <a href="<?php echo $link['url']; ?>" title="<?php echo $link['title']; ?>"><?php echo $link['title']; ?></a>
          <?php endif; ?>
        </p>

      </div>
    </div>
  </div>
  <!-- /.article -->

  <div class="details-evenement">

    <h2>Se rendre à l’événement</h2>

    <div class="col-infos">
      <div class="rte">
        <p>
          <span class="label">Adresse :</span>

          <?php if (!empty($adresse['thoroughfare'])): ?>
            <br/><?php echo $adresse['thoroughfare']; ?>
          <?php endif; ?>

          <?php if (!empty($adresse['premise'])): ?>
            <br/><?php echo $adresse['premise']; ?>
          <?php endif; ?>

          <?php if (!empty($adresse['postal_code'])): ?>
            <br/><?php echo $adresse['postal_code']; ?> <?php echo $adresse['locality']; ?>
          <?php endif; ?>
        </p>

        <?php if (!empty($content['field_acces_metro_rer_tramway']) ||
                  !empty($content['field_acces_bus']) ||
                  !empty($content['field_acces_autre'])): ?>
          <p>
            <span class="label">Transports :</span>
  
            <?php if (!empty($content['field_acces_metro_rer_tramway'])): ?>
              <br/><?php echo $content['field_acces_metro_rer_tramway'][0]['#markup'] ?>
            <?php endif; ?>

            <?php if (!empty($content['field_acces_bus'])): ?>
              <br/><?php echo $content['field_acces_bus'][0]['#markup'] ?>
            <?php endif; ?>

            <?php if (!empty($content['field_acces_autre'])): ?>
              <br/><?php echo $content['field_acces_autre'][0]['#markup'] ?>
            <?php endif; ?>
          </p>
        <?php endif; ?>

      </div>
    </div>

    <?php if ($content['field_adresse_geo']): ?>
      <div class="col-map">
        <script type="text/javascript">
          function initialize() {
            var myLatLng = new google.maps.LatLng(<?php print $geo['lat']; ?>, <?php print $geo['lon']; ?>);
            var mapOptions = {
              center: myLatLng,
              zoom: 15,
              mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map-canvas"),
              mapOptions);
            var myMarker = new google.maps.Marker({
              position: myLatLng,
              map: map,
              icon: '<?php echo $theme; ?>/images/picto/marker_gmap.png'
            });
          }
          google.maps.event.addDomListener(window, 'load', initialize);
        </script>
        <div id="map-canvas"></div>
      </div>
    <?php endif; ?>

  </div>
  <!-- /.details-evenement -->

  <div class="formulaire form-simple">
    <h2>Itinéraire</h2>
    <?php
      $block = module_invoke('dm_evenement_transports', 'block', $adresse, 0);
      print render($block);
    ?>
  </div>
  <!-- /.formulaire -->

</article>
