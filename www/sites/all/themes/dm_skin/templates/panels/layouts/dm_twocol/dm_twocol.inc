<?php

// Plugin definition
$plugin = array(
  'title' => t('DM - Two column'),
  'category' => t('Columns: 2'),
  'icon' => 'dm_twocol.png',
  'theme' => 'dm_twocol',
  'css' => 'dm_twocol.css',
  'regions' => array(
    'left_above' => t('Left above'),
    'right_above' => t('Right above'),
    'left_below' => t('Left below'),
    'right_below' => t('Right below'),
  ),
);

