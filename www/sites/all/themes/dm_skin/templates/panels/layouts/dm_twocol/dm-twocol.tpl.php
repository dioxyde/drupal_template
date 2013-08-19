<?php
/**
 * @file
 * Template for a 2 column panel layout.
 *
 * This template provides a two column panel display layout, with
 * each column roughly equal in width.
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['left']: Content in the left column.
 *   - $content['right']: Content in the right column.
 */
?>

<div class="panel-display panel-2col-bricks clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>

  <div class="cols-shp center-wrapper">
    <div class="col-left-shp panel-panel panel-col-first">
      <div class="bloc-shp shp-podcasts"><?php print $content['left_above']; ?></div>
      <div class="voir-tout-wrapper">
        <!--a class="voir-tout" href="#_">Tous nos podcasts</a-->
      </div>
    </div>

    <div class="col-right-shp panel-panel panel-col-last">
      <div class="bloc-shp shp-chats"><?php print $content['right_above']; ?></div>
      <div class="voir-tout-wrapper">
        <!--a class="voir-tout" href="#_">Tous nos chats</a-->
      </div>
    </div>
  </div>

  <div class="cols-shp center-wrapper">
    <div class="col-left-shp panel-panel panel-col-first">
      <div class="bloc-shp shp-lettres-info"><?php print $content['left_below']; ?></div>
      <div class="voir-tout-wrapper">
        <!--a class="voir-tout" href="#_">Toutes nos lettres d'information</a-->
      </div>
    </div>

    <div class="col-right-shp panel-panel panel-col-last">
      <div class="bloc-shp shp-rss"><?php print $content['right_below']; ?></div>
    </div>
  </div>

</div>
