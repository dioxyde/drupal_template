<?php
/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */

  $theme = base_path() . path_to_theme();
  drupal_add_js('https://maps.googleapis.com/maps/api/js?sensor=false', 'external');
?>

<script type="text/javascript">
  function initialize() {

    var bounds = new google.maps.LatLngBounds();

    var mapOptions = {
      center: new google.maps.LatLng(48.86898, 2.310127),
      zoom: 10,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    var infowindow = new google.maps.InfoWindow();

    <?php foreach ($rows as $id => $row): ?>
        <?php print $row; ?>
    <?php endforeach; ?>
  }

  google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div id="map-canvas"></div>