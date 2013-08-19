<?php
/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
  $theme = base_path() . path_to_theme();
?>

<div class="<?php print $classes; ?>">

  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($header): ?>
    <div class="view-header">
      <?php print $header; ?>
    </div>
  <?php endif; ?>

  <div class="dmtoolbar">
    <?php
      $mon_url = $GLOBALS['_GET']['q'] . '?'; 
      if (isset($GLOBALS['_GET']['f'])) { // S'il y a des arguments pour les facettes
        $nbarg=0;
        foreach ($GLOBALS['_GET']['f'] as $argument) {
          if ($nbarg > 0) {
            $mon_url .= '&';
          }
          $mon_url .= 'f[' . $nbarg . ']=' . urlencode($argument);
          $nbarg++;
        }
      }
    ?>
    <div class="boutons">
      <a class="print-html" rel="nofollow" title="Envoyer" href="/print/<?php echo $mon_url ; ?>">
        <img title="Version imprimable" alt="Version imprimable" src="<?php echo $theme ; ?>/images/picto/bt_imprimer.png" typeof="foaf:Image" class="print-icon"></a>
      </a>
      <a class="print-mail" rel="nofollow" title="Envoyer cette page par courriel" href="/printmail/<?php echo $mon_url ; ?>">
        <img title="Version imprimable" alt="Envoyer par courriel" src="<?php echo $theme ; ?>/images/picto/bt_email.png" typeof="foaf:Image" class="print-icon"></a>
      </a>
      <a title="Affichage Carte" href="/orientation/recherchemap">
        <img alt="Affichage Carte" src="<?php echo $theme ; ?>/images/picto/bt_marker.png">
      </a>
    </div>
    <?php if ($pager): ?>
        <?php print $pager; ?>
    <?php endif; ?>

    <?php if ($exposed): ?>
      <div class="view-filters">
        <?php print $exposed; ?>
      </div>
    <?php endif; ?>
  </div>

  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>

  <div class="serp-structure">
    <?php if ($rows): ?>
      <div class="view-content">
        <?php print $rows; ?>
      </div>
    <?php elseif ($empty): ?>
      <div class="view-empty">
        <?php print $empty; ?>
      </div>
    <?php endif; ?>

    <?php if ($attachment_after): ?>
      <div class="attachment attachment-after">
        <?php print $attachment_after; ?>
      </div>
    <?php endif; ?>
  </div>

  <?php if ($more): ?>
    <?php print $more; ?>
  <?php endif; ?>

  <?php if ($footer): ?>
    <div class="view-footer">
      <?php print $footer; ?>
    </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
    <div class="feed-icon">
      <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>

</div><?php /* class view */ ?>