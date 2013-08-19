<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */

  drupal_add_css(drupal_get_path('theme', 'dm_skin') .'/css/flexslider.css', 
    array('group' => CSS_THEME)
  );

  drupal_add_js(libraries_get_path('flexslider') .'/jquery.flexslider-min.js',
    array('type' => 'file', 'scope' => 'footer', 'weight' => 10)
  );
?>

<?php print $wrapper_prefix; ?>
  <?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
  <?php endif; ?>
  <div class="carousel-shp">
  <?php print $list_type_prefix; ?>
    <?php foreach ($rows as $id => $row): ?>
      <li class="slide-<?php echo $variables['view']->result[$id]->_field_data['nid']['entity']->type; ?>"><?php print $row; ?></li>
    <?php endforeach; ?>
  <?php print $list_type_suffix; ?>
  </div>
<?php print $wrapper_suffix; ?>