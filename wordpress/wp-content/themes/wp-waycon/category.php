  <?php get_header(); ?>
    <div id="inhalt">
      <div id="oben">
        <div class="csc cea7 op1 wvp sptop0 spbottom0">
          <div class="ce">
            <div class="ce0">
              <?php $image = get_field('image'); if( $image ) { ?>
              <div class="csc-textpic-imagewrap" style="width:100%;" data-csc-images="1" data-csc-cols="1">
                <div class="csc-textpic-imagerow">
                  <figure class="csc-textpic-image">
                    <img src="<?php echo $image['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
                  </figure>
                </div>
              </div>
              <?php } else { ?>
                <div class="csc-header csc-header-n1 csc-header--centered"><h1 class="csc-firstHeader"><?php the_category(', '); ?></h1></div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>

      <div id="spalten">
        <div id="normal">
          <div id="post-<?php the_ID(); ?>" class="csc cea7">
            <div class="ce">
              <div class="ce0">

              <div class="ttnews">
                <div class="ttnews">
                  <div class="news-list-container">

                    <?php get_template_part('loop'); ?>

                    <div class="news-list-browse">
                      <div class="news-list-browse">
                        <?php get_template_part('pagination'); ?>
                      </div>
                    </div>
                  </div>
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
