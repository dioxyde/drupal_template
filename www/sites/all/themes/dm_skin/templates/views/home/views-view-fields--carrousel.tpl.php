<?php

/**
 * @file
 * Template par défaut du carrousel de la home page.
 *
 */

  $path = $fields['path']->content ;
  $visuel = $fields['field_visuel_accroche']->content ;
  $titre = $fields['title']->content ;
  $rubriques = $fields['field_rubriques_rattachement']->content ;
?>

<a href="<?php echo $path ?>">
  <span class="illus"><?php print render($visuel) ?></span>
  <div class="texte">
    <div class="categorie"><?php echo $rubriques ?></div>
    <h2><?php echo $titre ?></h2>
  </div>

  <div class="date">
    <?php if (!empty($fields['field_date_debut_fin']->content)): ?>
      <div class="jour"><?php print format_date($fields['field_date_debut_fin']->content , 'custom', 'j'); ?></div>
      <div class="mois"><?php print format_date($fields['field_date_debut_fin']->content , 'custom', 'M'); ?>.</div>
    <?php else : ?>
      <div class="jour"><?php print format_date($fields['created']->raw , 'custom', 'j'); ?></div>
      <div class="mois"><?php print format_date($fields['created']->raw , 'custom', 'M'); ?>.</div>
    <?php endif; ?>
  </div>
</a>
