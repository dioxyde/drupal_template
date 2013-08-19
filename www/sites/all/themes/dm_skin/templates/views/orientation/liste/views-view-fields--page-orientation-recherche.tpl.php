<?php
/**
 * @file
 * Default simple view template to all the fields as a row.
 * @ingroup views_templates
 */
  $theme = base_path() . path_to_theme();
  $alphab = array ("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", );
?>
    <div class="rte col-marker">
      <div class="marker">
        <?php 
          switch ($id) {
            case $id:
              echo $alphab[$id-1];
            break;
          }
        ?>
      </div>
    </div>

    <div class="col-text">
      <h2><?php echo $fields['title']->content ; ?></h2>

      <div class="adresse">
        <?php echo $fields['field_adresse']->content ; ?>
      </div>

      <div class="num-telephone">
        <?php echo $fields['field_telephone']->content ; ?>
      </div>

      <div class="num-fax">
        <?php echo $fields['field_fax_organisme']->content ; ?>
      </div>

      <a href="" class="site-web">
        <?php echo $fields['field_site_web']->content ; ?>
      </a>

      <a href="" class="adresse-email">
        <?php echo $fields['field_mail_contact']->content ; ?>
      </a>
    </div>

    <div class="col-pictos">
      <?php echo $fields['field_logo']->content ; ?>
    </div>

    <div class="col-map">
      <div class="static-map" 
          data-lat="<?php print $fields['field_adresse_geo_1']->content ; ?>" 
          data-lng="<?php print $fields['field_adresse_geo']->content ; ?>">
      </div>
      <a href="#_" class="lien-direction">Se rendre à la structure (*)</a>
    </div>