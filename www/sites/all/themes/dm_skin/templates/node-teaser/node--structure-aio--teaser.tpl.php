<?php

/**
 * @file
 * Default theme implementation to display a "Structure AIO - Teaser" node.
 */
?>

<div class="col-text">
  <h2><a href="<?php echo $variables['node_url']; ?>"><?php echo $title ?></a></h2>
  <div class="adresse">
    <p><?php echo $content['field_adresse']['#items'][0]['thoroughfare'] ?></p>
    <p>
      <?php echo $content['field_adresse']['#items'][0]['postal_code'] ?>
      <?php echo $content['field_adresse']['#items'][0]['locality'] ?>
    </p>
  </div>
  <div class="num-telephone"><?php echo $content['field_telephone'][0]['#markup']; ?></div>
  <div class="num-fax"><?php echo $content['field_fax_organisme'][0]['#markup']; ?></div>
</div>

<div class="col-pictos">
  <?php print render($content['field_logo']); ?>
</div>