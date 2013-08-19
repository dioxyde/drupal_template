  <?php

// Plugin definition
$plugin = array(
  'title' => t('Une colonne et deux lignes'),
  'category' => t('Columns: 1'),
  'icon' => 'dm_onecol_tworow.png',
  'theme' => 'dm_onecol_tworow',
  'css' => 'dm_onecol_tworow.css',
  'regions' => array(
    'top' => t('ligne du haut'),
    'bottom' => t('ligne du bas')
  ),
);
