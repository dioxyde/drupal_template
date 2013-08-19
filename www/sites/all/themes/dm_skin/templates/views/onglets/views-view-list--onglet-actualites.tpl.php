<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */

  switch ($variables['view']->name) {
    case 'orientation':
      $rub = '?field_rubriques_rattachement_tid=1';
      break;
    case 'formations':
      $rub = '?field_rubriques_rattachement_tid=2';
      break;
    case 'metiers_secteurs':
      $rub = '?field_rubriques_rattachement_tid=3';
      break;
    case 'defi_metiers':
      $rub = '?field_rubriques_rattachement_tid=4';
      break;
    default:
      $rub = '?field_rubriques_rattachement_tid=All';
  }
?>

<?php print $wrapper_prefix; ?>
  <?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
  <?php endif; ?>
  <?php print $list_type_prefix; ?>
    <?php foreach ($rows as $id => $row): ?>
      <li class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
    <?php endforeach; ?>
  <?php print $list_type_suffix; ?>
<?php print $wrapper_suffix; ?>
<div class="voir-tout-wrapper">
  <a class="voir-tout" href="/actualites<?php echo $rub ?>">Toutes les actualites</a>
</div>