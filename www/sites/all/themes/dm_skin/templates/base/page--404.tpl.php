<?php
/**
 * @file
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

  <?php if ($site_slogan): ?>
  <div class="slogan"><?php print $site_slogan; ?></div>
  <?php endif; ?>

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


  <div id="content">
    <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
    <a id="main-content"></a>
    <?php print render($title_prefix); ?>
      <h1>Oupsss !</h1>
    <?php print render($title_suffix); ?>
    <?php if ($tabs['#primary'] != ''): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
    <?php print render($page['help']); ?>
    <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>

    <div class="article">
      <div class="rte">
        <div class="content">
          <?php if ($title): ?><h2 class="title" id="page-title"><?php print $title; ?></h2><?php endif; ?>
          <p class="chapeau">
            <?php print render($page['content']); ?>
          </p>
          <div class="formulaire form-simple">
            <?php print $search_block_form; ?>
          </div>
        </div>
      </div>
    </div>


  </div> <!-- /#content -->

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