<?php
/**
 * @file
 *
 * Regions disponibles :
 * - $page['help']
 * - $page['highlighted']
 * - $page['content']
 * - $page['sidebar_first']
 * - $page['sidebar_second']
 * - $page['header']
 * - $page['footer_social']
 * - $page['footer_firstcolumn']
 * - $page['footer_secondcolumn']
 * - $page['footer_thirdcolumn']
 * - $page['footer_fourthcolumn']
 * - $page['footer']
 *
 */


?>
<!-- ______________________________ USER BAR _______________________________ -->
<?php if ($page['user_bar']): ?>
<div id="user-bar">
  <?php print render($page['user_bar']); ?>
</div>
<?php endif; ?>

<!-- _______________________________ HEADER ________________________________ -->
<header id="header" role="banner">
  <?php if ($logo): ?>
  <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
    <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
  </a>
  <?php endif; ?>

  <?php print theme_get_setting('slogan_text'); ?>

  <div id="toogle-connexion">
    <a href="javascript:void(0)" class="lien-espace-pro">
      <?php if(!$logged_in): ?>Connexion<?php else: ?>Mon espace pro<?php endif; ?>
    </a>
  </div>

  <?php if ($page['header']): ?>
  <div id="header-region">
    <?php print render($page['header']); ?>
  </div>
  <?php endif; ?>

  <div class="block-search">
  <?php print $search_block_form; ?>
  </div>

  <?php if ($main_menu): ?>
  <nav  class="main-menu <?php !empty($main_menu) ? print "with-primary" : ''; ?>" role="navigation">
    <?php print theme('links', array('links' => $main_menu, 'attributes' => array('class' => 'level-0'))); ?>
  <div class="mega-menu"></div>
  </nav>
  <?php endif; ?>
</header><!-- /#header -->

<!-- _______________________________  MAIN  ________________________________ -->
<section id="main" role="main">
  <?php if ($breadcrumb): ?>
  <div id="breadcrumb"><?php print $breadcrumb; ?></div>
  <?php endif; ?>

  <?php print $messages; ?>

  <?php if ($page['sidebar_first']): ?>
  <aside id="sidebar-first" role="complementary">
    <?php print render($page['sidebar_first']); ?>
  </aside><!-- /.sidebar-first -->
  <?php endif; ?>

  <div id="content">
    <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
    <a id="main-content"></a>
    <?php print render($title_prefix); ?>
    <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if ($tabs['#primary'] != ''): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
    <?php print render($page['help']); ?>
    <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
    <?php print render($page['content']); ?>
    <?php print $feed_icons; ?>
  </div> <!-- /#content -->

  <?php if ($page['sidebar_second']): ?>
  <aside id="sidebar-second" role="complementary">
    <?php print render($page['sidebar_second']); ?>
  </aside><!-- /.sidebar-second -->
  <?php endif; ?>
</section><!-- /#main -->

<!-- _______________________________ FOOTER ________________________________ -->
<footer id="footer" role="contentinfo">
  <div class="footer-decoration">
    <div class="footer-inner">
      <div class="liens-sociaux">
        <?php print render($page['footer_social']); ?>
      </div>
      <div class="cols">
        <div class="col">
          <?php print render($page['footer_firstcolumn']); ?>
        </div>
        <div class="col">
          <?php print render($page['footer_secondcolumn']); ?>
        </div>
        <div class="col">
          <?php print render($page['footer_thirdcolumn']); ?>
        </div>
        <div class="col">
          <?php print render($page['footer_fourthcolumn']); ?>
        </div>
      </div> <!-- /.cols -->
      <div class="liens-footer">
        <?php print render($page['footer']); ?>
      </div>
    </div> <!-- /.footer-inner -->
  </div> <!-- /.footer-decoration -->
</footer> <!-- /#footer -->