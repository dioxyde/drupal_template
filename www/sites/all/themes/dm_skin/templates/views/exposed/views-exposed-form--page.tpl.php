<?php

/**
 * @file
 * This template handles the layout of the views exposed filter form.
 *
 * Variables available:
 * - $widgets: An array of exposed form widgets. Each widget contains:
 * - $widget->label: The visible label to print. May be optional.
 * - $widget->operator: The operator for the widget. May be optional.
 * - $widget->widget: The widget itself.
 * - $sort_by: The select box to sort the view using an exposed form.
 * - $sort_order: The select box with the ASC, DESC options to define order. May be optional.
 * - $items_per_page: The select box with the available items per page. May be optional.
 * - $offset: A textfield to define the offset of the view. May be optional.
 * - $reset_button: A button to reset the exposed filter applied. May be optional.
 * - $button: The submit button for the form.
 *
 * @ingroup views_templates
 */

  if (!isset($GLOBALS['_GET']['sort_order'])|| $GLOBALS['_GET']['sort_order'] == 'DESC'){
    $asc = ' active' ;
    $desc = '' ;
  } else {
    $asc = '' ;
    $desc = 'active' ;
  }

 $path = base_path() . path_to_theme();
?>

<?php if (!empty($q)): ?>
  <?php
    // This ensures that, if clean URLs are off, the 'q' is added first so that
    // it shows up first in the URL.
    print $q;
  ?>
<?php endif; ?>

<div class="views-exposed-form">
  <div class="views-exposed-widgets clearfix">
    <?php foreach ($widgets as $id => $widget): ?>
      <div id="<?php print $widget->id; ?>-wrapper" class="views-exposed-widget views-widget-<?php print $id; ?>">
        <div class="views-widget">
          <?php print $widget->widget; ?>
        </div>
      </div>
    <?php endforeach; ?>

    <?php if (!empty($sort_by)): ?>
      <div class="sorter">
        <div class="label">Date</div>
        <?php 
          // On change la gestion du tri pour la date en affichant des images.
          print '<a class="sort-desc '. $desc . '" href="/' . $GLOBALS['_GET']['q'] . '?';

          if (isset($GLOBALS['_GET']['field_rubriques_rattachement_tid'])) {
            print 'field_rubriques_rattachement_tid=' . $GLOBALS['_GET']['field_rubriques_rattachement_tid'] . '&amp;' ;
          }

          print 'sort_order=ASC"><img src="' . $path . '/images/picto/bt_sort_desc.png"></a>';

          print '<a class="sort-asc '. $asc . '" href="/' . $GLOBALS['_GET']['q'] . '?';

          if (isset($GLOBALS['_GET']['field_rubriques_rattachement_tid'])) {
            print 'field_rubriques_rattachement_tid=' . $GLOBALS['_GET']['field_rubriques_rattachement_tid'] . '&amp;' ;
          }

          print 'sort_order=DESC"><img src="' . $path . '/images/picto/bt_sort_asc.png"></a>';

          if (isset($GLOBALS['_GET']['sort_order'])) {
            print '<input type="hidden" value="';
            print $GLOBALS['_GET']['sort_order'];
            print '" name="sort_order">';
          }
        ?>
      </div>
    <?php endif; ?>

    <div class="views-exposed-widget views-submit-button">
      <?php print $button; ?>
    </div>

  </div>
</div>