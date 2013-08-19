<?php

/**
 * @file
 * Default theme implementation to display a "Structure AIO" node.
 */

  drupal_add_js('https://maps.googleapis.com/maps/api/js?sensor=false', 'external');

  $theme = base_path() . path_to_theme();
  $adresse = $content['field_adresse'][0]['#address'];
  $geo = $content['field_adresse_geo']['#items'][0];
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

  <div class="fiche-organisme">
    <div class="info">
      <?php if (!empty($content['field_adresse_geo'])): ?>
        <p class="adresse">
          <?php echo $variables['field_adresse'][0]['thoroughfare']; ?><br/>
          <?php echo $variables['field_adresse'][0]['postal_code']; ?> <?php echo $variables['field_adresse'][0]['locality']; ?>
        </p>
      <?php endif; ?>

      <?php if (!empty($content['field_telephone'])): ?>
        <p class="tel"><?php echo $content['field_telephone'][0]['#markup']; ?></p>
      <?php endif; ?>

      <?php if (!empty($content['field_fax_organisme'])): ?>
        <p class="fax"><?php echo $content['field_fax_organisme'][0]['#markup']; ?></p>
      <?php endif; ?>

      <?php if (!empty($content['field_mail_contact'])): ?>
        <p class="email"><?php echo $content['field_mail_contact'][0]['#markup']; ?></p>
      <?php endif; ?>

      <?php if (!empty($content['field_site_web'])): ?>
        <p class="website"><?php echo $content['field_site_web'][0]['#markup']; ?></p>
      <?php endif; ?>

      <?php if (!empty($content['field_autre_fonction_intitule'][0]['#markup']) || !empty($content['field_autre_fonction_identite'][0]['#markup'])): ?>
        <p class="personne">
          <?php if (!empty($content['field_autre_fonction_intitule'][0]['#markup'])): ?>
            <?php echo $content['field_autre_fonction_intitule'][0]['#markup']; ?>
          <?php endif; ?>
          <?php if (!empty($content['field_autre_fonction_identite'][0]['#markup'])): ?>
            - <?php echo $content['field_autre_fonction_identite'][0]['#markup']; ?>
          <?php endif; ?>
        </p>
        <hr/>
      <?php endif; ?>

      <?php if (!empty($content['field_reseau'])): ?>
        <?php echo $content['field_reseau'][0]['#markup']; ?> <hr/>
      <?php endif; ?>

      <div class="rte">
        <?php if (!empty($content['field_directeur_directrice'])): ?>
          <dl>
            <dt>Directeur/Directrice</dt>
            <dd><?php echo $content['field_directeur_directrice'][0]['#markup']; ?></dd>
          </dl>
          <hr/>
        <?php endif; ?>

        <dl>
          <?php if (!empty($content['field_acces_metro_rer_tramway'])): ?>
            <dt>Accès Métro, RER, tramway</dt>
            <dd><?php echo $content['field_acces_metro_rer_tramway'][0]['#markup']; ?></dd>
          <?php endif; ?>

          <?php if (!empty($content['field_acces_bus'])): ?>
            <dt>Accès Bus</dt>
            <dd><?php echo $content['field_acces_bus'][0]['#markup']; ?></dd>
          <?php endif; ?>

          <?php if (!empty($content['field_acces_autre'])): ?>
            <dt>Domaines de formation</dt>
            <dd><?php echo $content['field_acces_autre'][0]['#markup']; ?></dd>
          <?php endif; ?>
        </dl>

      </div>
    </div>

    <div class="map">
      <script type="text/javascript">
        function initialize() {
          var myLatLng = new google.maps.LatLng(<?php echo $content['field_adresse_geo']['#items'][0]['lat']; ?>, <?php echo $content['field_adresse_geo']['#items'][0]['lon']; ?>);
          var mapOptions = {
            center: myLatLng,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
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
    <!-- /.map -->

    <div class="clear"></div>
  </div>
  <!-- /.fiche-organisme -->

  <div class="details-evenement">
    <div class="formulaire form-simple">
      <h2>Itinéraire</h2>
      <?php
        $block = module_invoke('dm_evenement_transports', 'block', $adresse, 0);
        print render($block);
      ?>
    </div>
    <!-- /.formulaire -->
  </div>
  <!-- /.details-evenement -->

</article>