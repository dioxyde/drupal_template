<?php
/**
 * @file
 * Default simple view template to all the fields as a row.
 * @ingroup views_templates
 */

  $titre = $fields['title']->content ;
  $adresse_geo = $fields['field_adresse_geo']->content ;
  $cp = $fields['field_adresse_postal_code']->content ;
  $ville = $fields['field_adresse_locality']->content ;
  $rue = $fields['field_adresse_thoroughfare']->content ;

  $theme = base_path() . path_to_theme();
  $var = array ("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", );
?>

var titre_<?php echo $id; ?> = "<?php echo $titre; ?>";

var info_<?php echo $id; ?> = "<div class='adresse'><?php echo $rue; ?><br /><?php echo $cp; ?> <?php echo $ville; ?></div>";
info_<?php echo $id; ?> += "<p><a href='<?php echo $fields['url']->content; ?>' class='txt-lire'>Accéder à la fiche complète</a></p>";

var marker_<?php echo $id; ?> = new google.maps.Marker({
  position: new google.maps.LatLng(<?php echo $adresse_geo; ?>),
  map: map,
  icon: '<?php echo $theme; ?>/images/picto/marker_<?php switch ($id) { case $id: echo $var[$id-1]; break; } ?>.png'
});

bounds.extend(marker_<?php echo $id; ?>['position']);

map.fitBounds(bounds);

create_info_window(map, infowindow, titre_<?php echo $id; ?>, info_<?php echo $id; ?>, marker_<?php echo $id; ?>);
