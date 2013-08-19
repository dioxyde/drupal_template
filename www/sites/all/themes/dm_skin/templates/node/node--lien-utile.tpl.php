<?php

/**
 * @file
 * Default theme implementation to display a "Lien utile" node.
 */

  $url = $content['field_lien']['#items'][0];
?>

<article id="node-<?php print $node->nid; ?>" class="bloc-article <?php print $classes; ?>" <?php print $attributes; ?>>

  <div class="article">
    <div class="rte">
      <div class="content"<?php print $content_attributes; ?>>

        <?php if (!empty($url['title'])): ?>
          <p>
            <span class="label">Libellé du lien</span>
            : <?php echo $url['title'] ?>
          </p>
        <?php endif; ?>

        <?php if (!empty($content['field_lien'])): ?>
          <p>
            <span class="label">URL du lien</span> :
            <a href="<?php echo $url['url'] ?>" title="<?php echo $url['title'] ?> (nouvelle fenêtre)" target="_blank">
              <?php echo $url['url'] ?>
            </a>
          </p>
        <?php endif; ?>

        <?php if (!empty($content['field_tags'])): ?>
          <p>
            <span class="label">Tags</span> : <?php print render($content['field_tags']); ?>
          </p>
        <?php endif; ?>

      </div>
    </div>
  </div>
  <!-- /.article -->

</article>