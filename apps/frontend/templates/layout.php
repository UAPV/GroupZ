<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div class="uapv_wrapper">
      <div class="uapv_header">
        <div id="groupz_title">
          Group<span class="_z_">z</span>
          <span class="tagline">Listes de diffusion et partage de fichiers pour vos groupes de travail</span>
        </div>
        <div id="auth_box">
          <?php echo __('Connected as %name%', array ('%name%' => "<b>$sf_user</b>")) ?>
          <a href="<?php echo url_for('authentication/logout') ?>" id="logout""><?php echo __('Log out') ?></a>
        </div>
      </div>
      <div id="toolbar">
        <?php include_partial('global/breadcrumb', array ('path' => get_slot ('breadcrumb', array()))) ?>
        <div id="search_box">
          <form action="">
            <input type="text" placeholder="<?php echo __("Find a group") ?>" name="search" />
            <button type="submit" title="<?php echo __("Search") ?>">
              <span><?php echo __("Search") ?></span>
            </button>
           </form>
        </div>
        <div class="clearboth"></div>
      </div>
      <div class="uapv_content">
        <?php echo get_partial ('global/flash_messages') ?>

        <?php echo $sf_content ?>
      </div>
      <div class="uapv_footer">
      </div>
    </div>
    <div class="uapv_footnote">
      <p><a href="gpl.univ-avignon.fr">GroupZ - un logiciel libre de l'Université d'Avignon et des Pays de Vaucluse</a></p>
    </div>
  </body>
</html>
