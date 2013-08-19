<?php

require_once(drupal_get_path('theme', 'dm_skin') . '/includes/dm_skin.theme.inc');

function dm_skin_preprocess_html(&$variables){

  $meta_description = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#weight' => 2,
    '#attributes' => array(
      'name' => 'description',
      'content' => theme_get_setting('seo_description')
    )
  );

  $meta_keywords = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#weight' => 3,
    '#attributes' => array(
      'name' => 'keywords',
      'content' => theme_get_setting('seo_keywords')
    )
  );

  $viewport = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#weight' => 4,
    '#attributes' => array(
      'name' => 'viewport',
      'content' =>  'width=device-width, initial-scale=1',
    )
  );

  if (theme_get_setting('seo_description') != "") {
    drupal_add_html_head( $meta_description, 'meta_description' );
  }

 if (theme_get_setting('seo_keywords') != "") {
    drupal_add_html_head( $meta_keywords, 'meta_keywords' );
  }

  drupal_add_html_head( $viewport, 'meta_viewport' );

}


/**
 * Implements hook_preprocess_HOOK().
 * Preprocess theme variables for a specific theme hook.
 */
function dm_skin_preprocess_page(&$variables) {
  // Déclaration de la variable $search_block_form
  $t = drupal_get_form('search_block_form');
  $search_block_form = drupal_render($t);
  $variables['search_block_form'] = $search_block_form;

  if ((!empty($variables['node']) && $variables['node']->type == 'publication')||
      (!empty($variables['node']) && $variables['node']->type == 'rapport_d_etude')) {
    if (!empty($variables['node']->field_sous_titre['und'][0]['value'])) {
      $variables['title'] = $variables['node']->title . ' - ' . $variables['node']->field_sous_titre['und'][0]['value'];
    }
  }
}

/**
 * Implements hook_preprocess_HOOK().
 */
function dm_skin_preprocess_node(&$variables) {

  $node = $variables['node'];
  $type = $variables['type'];
  $user = $variables['user'];
  $lang = $variables['language'];

  if (!empty($variables['elements']['links']['print_html'])) {
    $variables['print_html_link'] = $variables['elements']['links']['print_html']['#links']['print_html']['href'] ;
    $variables['print_html_title'] = $variables['elements']['links']['print_html']['#links']['print_html']['title'] ;

  }

  if (!empty($variables['elements']['links']['print_mail'])) {
    $variables['print_mail_link'] = $variables['elements']['links']['print_mail']['#links']['print_mail']['href'] ;
    $variables['print_mail_title'] = $variables['elements']['links']['print_mail']['#links']['print_mail']['title'] ;

  }

  if (!empty($variables['elements']['links']['print_pdf'])) {
    $variables['print_pdf_link'] = $variables['elements']['links']['print_pdf']['#links']['print_pdf']['href'] ;
    $variables['print_pdf_title'] = $variables['elements']['links']['print_pdf']['#links']['print_pdf']['title'] ;
  }

// --- Ajout une nouvelle suggestion de type node--NODE_TYPE--VIEW_MODE.tpl.php __________
  $view_mode = isset($variables['view_mode']) ? $variables['view_mode'] : FALSE;

  if ($view_mode) {
    $suggestions = $variables['theme_hook_suggestions'];

    $variables['theme_hook_suggestions'] = array();
    unset($suggestions['0']);
    $new_suggestions = array(
      'node__' . $type,
      'node__' . $type . '__' . $view_mode,
    );

    $variables['theme_hook_suggestions'] = array_merge_recursive($new_suggestions, $suggestions);
    // krumo($variables['theme_hook_suggestions'] );
    $variables['attributes_array']['class'][] = $view_mode . '-theme-view';
  }

// --- Traitements des types de contenu __________________________________________________
  switch ($type) {

    case 'evenement':
      $date_debut = isset($variables['field_date_debut_fin'][0]['value']) ? $variables['field_date_debut_fin'][0]['value'] : FALSE;
      $date_fin = isset($variables['field_date_debut_fin'][0]['value2']) ? $variables['field_date_debut_fin'][0]['value2'] : FALSE;

      $variables['dates_evenements'] = array();

      if ($date_debut) {
        $variables['debut_jour'] = format_date($date_debut, 'custom', 'j');
        $variables['debut_mois'] = format_date($date_debut, 'custom', 'F Y');
      }

      if ($date_fin) {
        $variables['fin_jour'] = format_date($date_fin, 'custom', 'j');
        $variables['fin_mois'] = format_date($date_fin, 'custom', 'F Y');
      }

    break;
  }
}

/**
 * Implements hook_form_alter().
 * Perform alterations before a form is rendered.
 */
function dm_skin_form_alter(&$form, &$form_state, $form_id) {
  switch ($form_id) {
    case 'search_block_form':
      // Remplacement du bouton submit par une image.
      $form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images/picto/loupe.png');
      $form['search_block_form']['#attributes']['placeholder'] = t('Rechercher dans le site');
    break;

    case 'user_login_block':
      $form['name']['#attributes']['placeholder'] = $form['name']['#title'];
      $form['pass']['#attributes']['placeholder'] = $form['pass']['#title'];
    break;

    case 'publication_node_form':
      //dpm($form);
    break;

  }
}

/**
 * Returns HTML for primary and secondary local tasks.
 *
 * @ingroup themeable
 */
function dm_skin_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="nav nav-pills clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }

  return $output;
}

/**
 * Format the send by email link
 *
 * @return
 *   array of formatted attributes
 * @ingroup themeable
 */
function dm_skin_print_mail_format_link() {
  $print_mail_link_class  = variable_get('print_mail_link_class', PRINT_MAIL_LINK_CLASS_DEFAULT);
  $print_mail_show_link = variable_get('print_mail_show_link', PRINT_MAIL_SHOW_LINK_DEFAULT);
  $print_mail_link_text = filter_xss(variable_get('print_mail_link_text', t('Envoyer')));

  $img =  base_path() . path_to_theme() . '/images/picto/bt_email.png';
  $title = t('Envoyer');
  $class = strip_tags($print_mail_link_class);
  $new_window = FALSE;
  $format = _print_format_link_aux($print_mail_show_link, $print_mail_link_text, $img);

  return array('text' => $format['text'],
               'html' => $format['html'],
               'attributes' => print_fill_attributes($title, $class, $new_window),
              );
}

/**
 * Format the Printer-friendly link
 *
 * @return
 *   array of formatted attributes
 * @ingroup themeable
 */
function dm_skin_print_format_link() {
  $print_html_link_class = variable_get('print_html_link_class', PRINT_HTML_LINK_CLASS_DEFAULT);
  $print_html_new_window = variable_get('print_html_new_window', PRINT_HTML_NEW_WINDOW_DEFAULT);
  $print_html_show_link = variable_get('print_html_show_link', PRINT_HTML_SHOW_LINK_DEFAULT);
  $print_html_link_text = filter_xss(variable_get('print_html_link_text', t('Imprimer')));

  $img =  base_path() . path_to_theme() . '/images/picto/bt_imprimer.png';
  $title = t('Imprimer');
  $class = strip_tags($print_html_link_class);
  $new_window = $print_html_new_window;
  $format = _print_format_link_aux($print_html_show_link, $print_html_link_text, $img);

  return array('text' => $format['text'],
               'html' => $format['html'],
               'attributes' => print_fill_attributes($title, $class, $new_window),
              );
}

/**
 * Format the PDF version link
 *
 * @return
 *   array of formatted attributes
 * @ingroup themeable
 */
function dm_skin_print_pdf_format_link() {
  $print_pdf_link_class  = variable_get('print_pdf_link_class', PRINT_PDF_LINK_CLASS_DEFAULT);
  $print_pdf_content_disposition = variable_get('print_pdf_content_disposition', PRINT_PDF_CONTENT_DISPOSITION_DEFAULT);
  $print_pdf_show_link = variable_get('print_pdf_show_link', PRINT_PDF_SHOW_LINK_DEFAULT);
  $print_pdf_link_text = filter_xss(variable_get('print_pdf_link_text', t('PDF version')));

  $img =  base_path() . path_to_theme() . '/images/picto/bt_pdf.png';
  $title = t('Display a PDF version of this page.');
  $class = strip_tags($print_pdf_link_class);
  $new_window = ($print_pdf_content_disposition == 1);
  $format = _print_format_link_aux($print_pdf_show_link, $print_pdf_link_text, $img);

  return array('text' => $format['text'],
               'html' => $format['html'],
               'attributes' => print_fill_attributes($title, $class, $new_window),
              );
}

function dm_skin_field__field_savoir_plus($variables) {

  $nb_elements = count($variables['element']['#items']);

  if ($nb_elements == 1 && $variables['element']['#items'][0]['entity']->status == 0) {

    $output = ' ';
    return $output;

  } else {

    $output = '';
    $output .= '<h3>En savoir plus</h3>';
    $output .= '<ul class="field-items"' . $variables['content_attributes'] . '>';

    foreach ($variables['items'] as $i => $item) {
      if ($variables['element']['#items'][$i]['entity']->status == 1) {
        $output .= '<li>' . drupal_render($item) . '</li>';
      }
    }

    $output .= '</ul>';
    $output = '<div class="supplement"><div class="rte"><div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div></div></div>';
    return $output;
  }

}

/* Allow sub-menu items to be displayed */
function dm_skin_links($variables) {
  if (array_key_exists('id', $variables['attributes']) && $variables['attributes']['id'] == 'main-menu-links') {
    $pid = variable_get('menu_main_links_source', 'main-menu');
    $tree = menu_tree($pid);
    return drupal_render($tree);
  }
  return theme_links($variables);
}

/* Add a comma delimiter between field tags*/
function dm_skin_field($variables) {

  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {

  }

  // Render the items.

  if ($variables['element']['#field_name'] == 'field_tags') {
    // For tags, concatenate into a single, comma-delimitated string.
    foreach ($variables['items'] as $delta => $item) {
      $rendered_tags[] = drupal_render($item);
    }
    $output .= implode(' | ', $rendered_tags);
  }

  else {
    // Default rendering taken from theme_field().
    foreach ($variables['items'] as $delta => $item) {
      $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even');
      $output .= '<div class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
    }
  }

  // Render the top-level DIV.

  return $output;
}

/*
 * Création du breadcrumb (chemin de fer)
 * Le breadcrumb est généré à la volée suivant le chemin.
 *
 * Si on est à la racine du site, on n'affiche pas de breadcrumb.
 *
 * @return
 *   une chaine html comprenant tout le breadcrumb
 */
function dm_skin_breadcrumb($breadcrumb) {

  // On prend le chemin reel sans les arguments.
  preg_match_all('/(.*)\?/', request_uri(), $categorie);

  // Création d'un tableau sur le chemin de l'URL
  if (isset($categorie[1][0])) {
    $categorie[1][0] .= '/ ';
    $path = explode('/', $categorie[1][0]);
  } else {
    $path = explode('/', request_uri());
  }

  if ($path[1] == '' || $path[1] == 'home') { // Si on est à la racine, pas de breadcrumb
    return '';
  }

  // Tableau de correspondance entre l'arborescence et les noms longs
  $nomarbo = array(
    'orientation' => 'Orientation',
    'formations' => 'Formations',
    'formation' => 'Formations',
    'organisme' => 'Organismes',
    'programme' => 'Programmes',
    'metiers-secteurs' => 'Métiers et secteurs',
    'mediatheque' => 'Médiathèque',
    'defimetiers' => 'Défi Métiers',

    'breves' => 'Brèves',
    'evenements' => 'Evénements',
    'temoignages' => 'Témoignages',
    'dispositifs' => 'Dispositifs',
    'dossiers' => 'Dossiers',
    'etudes' => 'Études',
    'panoramas' => 'Panoramas',
    'publications' => 'Publications',
    'etiquettes' => 'Étiquettes',
    'chat' => 'Chats',
    'structure-aio' => 'Structure AIO',
    'video' => 'Vidéos',
    'reseau' => 'Réseaux',
    'podcast' => 'Podcasts',
    'lien-utile' => 'Liens utiles',
    // Contact utile
    // Communiqué de Presse
    // Rapport d'étude
    // Tableau de bord

    'result' => 'Résultats',
  );

  $nomexclu = array(
    'search',
    'site',
    'dm_search',
    'formations',
  );

  $breadcrumb="<h2 class=\"element-invisible\">Vous êtes ici</h2><div class=\"breadcrumb\"><a href=\"/\">Accueil</a>";

  // Récupération du titre Drupal
  $title = drupal_get_title();

  $realpath = '';
  $nbmax = count($path);
  $nbmax--; # Pour pouvoir faire le test sur le i = nbmax pour le dernier élément

  if ($path[1] == 'dm_search') { $nbmax--; }

  for ($i = 1; $i <= $nbmax; $i++) { // On parcours le chemin pour ajouter les éléments au breadcrumb
    $realpath .= '/' . $path[$i];
    if (in_array($path[$i], $nomexclu)) { // Si c'est un nom a ne pas afficher, on passe au suivant
      continue;
    }
    if ($i == $nbmax) { // Si c'est le dernier élément, on affiche le titre
      // Test pour differencier Orientations/Formations/... pour breves et cie.
      preg_match_all('/.*\?.*=(\d)/', $path[$nbmax], $categorie); // breves?field_rubriques_rattachement_tid=1
      if (isset($categorie[1][0])) {
        if ($categorie[1][0] == 1) {
          $breadcrumb .= '<a href="orientation">Orientation</a>';
        } else if ($categorie[1][0] == 2) {
          $breadcrumb .= '<a href="formation">Formations</a>';
        } else if ($categorie[1][0] == 3) {
          $breadcrumb .= '<a href="metiers-secteurs">Métiers et secteurs</a>';
        } else if ($categorie[1][0] == 4) {
          $breadcrumb .= '<a href="defi-metiers">Déf Métiers</a>';
        }
      }
      $breadcrumb .= '<span class="breadcrumb-final">';
      if ($title != '') {
        $breadcrumb .= $title;
      } else {
        if (array_key_exists($path[$i], $nomarbo)) {
          $breadcrumb .= $nomarbo[$path[$i]];
        } else {
          $breadcrumb .= $path[$i];
        }
      }
      $breadcrumb .= '</span>';
    } else { // Si on a une correspondance dans le tableau 'nomarbo', on affiche le nom complet sinon le chemin
      $breadcrumb .= '<a href="' . $realpath . '">';
      if (array_key_exists($path[$i], $nomarbo)) {
        $breadcrumb .= $nomarbo[$path[$i]];
      } else {
        $breadcrumb .= $path[$i];
      }
      $breadcrumb .= '</a>';
    }
  }

  $breadcrumb .= '</div>';

  return $breadcrumb;
}
