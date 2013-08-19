<?php
/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
 $alphab = array ("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", ) ;
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
      <div class="rte col-marker">
        <div class="marker">
          <?php 
            switch ($id) {
              case $id:
                echo $alphab[$id];
              break;
            }
          ?>
        </div>
      </div>
      <?php print $row; ?>
    </li>

  <?php endforeach; ?>
</ul>