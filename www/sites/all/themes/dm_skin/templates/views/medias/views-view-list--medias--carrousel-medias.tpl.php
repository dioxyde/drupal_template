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

<?php print $list_type_prefix; ?>
  <?php foreach ($rows as $id => $row): ?>
    <li class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
  <?php endforeach; ?>
<?php print $list_type_suffix; ?>