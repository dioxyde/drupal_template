<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 */

  drupal_add_css(drupal_get_path('theme', 'dm_skin') .'/css/flexslider.css', 
    array('group' => CSS_THEME)
  );

  drupal_add_js(libraries_get_path('flexslider') .'/jquery.flexslider-min.js',
    array('type' => 'file', 'scope' => 'footer', 'weight' => 10)
  );
?>

<div class="carousel-hp">
  <ul class="slides">
    <?php foreach ($rows as $id => $row): ?>
      <?php 
        $type = $variables['view']->result[$id]->_field_data['nid']['entity']->type; 
      ?>
      <li class="slide-<?php echo $type; ?> <?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
    <?php endforeach; ?>
  </ul>
</div>