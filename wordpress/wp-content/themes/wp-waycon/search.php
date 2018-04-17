  <?php get_header(); ?>
    <div id="inhalt">
      <div id="oben">
        <div class="csc cea7 op1 wvp sptop0 spbottom0">
          <div class="ce">
            <div class="ce0">
              <div class="csc-header csc-header-n1 csc-header--centered"><h1 class="csc-firstHeader">Результатов "<?php echo get_search_query(); ?>": <?php echo $wp_query->found_posts; ?></h1></div>
            </div>
          </div>
        </div>
      </div>

      <div id="spalten">
        <div id="normal">
          <div id="c534" class="csc cea7">
            <div class="ce">
              <div class="ce0">
                <div class="tx-indexedsearch">


                  <div class="tx-indexedsearch-searchbox">
                    <form action="<?php echo home_url(); ?>" method="get" id="tx_indexedsearch" class="">
                      <div class="searchform">
                        <div class="field sword text">
                          <label for="tx_indexedsearch_sword" class="">Поиск:</label>
                          <input type="text" name="s" value="<?php echo get_search_query(); ?>" class="tx-indexedsearch-searchbox-sword sword">
                        </div>
                        <div class="submit">
                          <input type="submit" value="Search" class="tx-indexedsearch-searchbox-button submit">
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="tx-indexedsearch-browsebox">
                    <?php get_template_part('pagination'); ?>
                  </div>

                  <div class="tx-indexedsearch-res">
                    <?php if (have_posts()): while (have_posts()) : the_post(); ?>
                      <div class="tx-indexedsearch-res">
                        <table cellpadding="0" cellspacing="0" border="0" summary="Result row" class="">
                          <tbody class="">
                            <tr class="">
                              <td class="tx-indexedsearch-icon icon" nowrap="nowrap"><img src="<?php echo get_template_directory_uri(); ?>/img/pages.gif" width="18" height="16" title="" alt="" class=""></td>
                              <td class="tx-indexedsearch-result-number result-number fadetoview fadefromleft" nowrap="nowrap" style="">&nbsp;</td>
                              <td class="tx-indexedsearch-title title" width="100%"><a href="<?php the_title(); ?>" class=""><?php the_title(); ?></a></td>
                              <td class="tx-indexedsearch-percent percent" nowrap="nowrap"> </td>
                            </tr>
                            <tr class="">
                              <td class="">&nbsp;</td>
                              <td class="tx-indexedsearch-descr descr" width="100%" colspan="3"><?php wpeExcerpt('wpeExcerpt40'); ?></td>
                            </tr>
                          </tbody>
                        </table>
                        <br class="">
                      </div>
                    <?php endwhile; endif; ?>
                  </div>

                  <div class="tx-indexedsearch-browsebox fadetoview outofview fadefromright">
                    <?php get_template_part('pagination'); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <?php get_sidebar(); ?>
      </div><!-- spalten -->

      <div class="clear">&nbsp;</div>
    </div>

  <?php include(TEMPLATEPATH.'/include-header.php'); ?>

<?php get_footer(); ?>
