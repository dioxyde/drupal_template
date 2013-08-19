<?php
/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
  drupal_add_js('https://maps.googleapis.com/maps/api/js?sensor=false', 'external');
?>

<ul>
  <?php foreach ($rows as $id => $row): ?>

    <?php 
      $oddeven = $id;
      if ($oddeven % 2) {
        $oddeven = 'even';
      } else {
        $oddeven = 'odd';
      } 
    ?>

    <li class="<?php print $oddeven; ?>">
      <?php print $row; ?>
    </li>

  <?php endforeach; ?>
</ul>