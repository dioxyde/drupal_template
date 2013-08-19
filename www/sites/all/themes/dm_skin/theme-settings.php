<?php

/**
 * @file
 * Default theme settings
 */

drupal_add_js(drupal_get_path('theme', 'dm_skin') . '/js/theme-settings.js');

function dm_skin_form_system_theme_settings_alter(&$form, &$form_state) {

  $form['options'] = array(
    '#type' => 'vertical_tabs',
    '#default_tab' => 'defaults',
    '#weight' => '-10',
    '#attached' => array(
      'css' => array(drupal_get_path('theme', 'dm_skin') . '/css/theme-options.css'),
    ),
  );

  $form['options']['general'] = array(
    '#type' => 'fieldset',
    '#title' => 'Général',
  );

  // Slogan

  $form['options']['general']['slogan'] = array(
    '#type' => 'fieldset',
    '#title' => '<div class="plus"></div><h3 class="options_heading">Slogan</h3>',
  );

  $form['options']['general']['slogan']['slogan_text'] = array(
    '#type' => 'textarea',
    '#title' => 'Titre',
    '#description' => t('Veuillez entrer le slogan du site, les balises HTML sont acceptés.'),
    '#default_value' => theme_get_setting('slogan_text'),
  );

  // SEO
  $form['options']['general']['seo'] = array(
    '#type' => 'fieldset',
    '#title' => '<div class="plus"></div><h3 class="options_heading">SEO</h3>',
  );

  // SEO Description
  $form['options']['general']['seo']['seo_description'] = array(
    '#type' => 'textarea',
    '#title' => 'Déscription',
    '#default_value' => theme_get_setting('seo_description'),
  );

  // SEO Keywords
  $form['options']['general']['seo']['seo_keywords'] = array(
    '#type' => 'textarea',
    '#title' => 'Mots clés',
    '#default_value' => theme_get_setting('seo_keywords'),
  );


}