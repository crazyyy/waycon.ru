  <div id="fixo">
    <div id="fixo0">
      <div class="schildwrap">
        <a href="/" target="_top" class="schild"><img src="<?php echo get_template_directory_uri(); ?>/img/schild.png" alt=""></a>
      </div>
      <div id="abovemenu">
        <form action="<?php echo home_url(); ?>" class="noprint" method="get" id="suche">
          <input id="sword" type="text" name="s" value="">
          <button class="suche" title="Search">◀</button>
        </form>
      </div>
      <div id="menuequerwrap">
        <?php wpeHeadNav(); ?>
      </div>
      <a href="#menuequer" class="menuicon"><span class="cssicon"></span></a>
    </div>
  </div>
