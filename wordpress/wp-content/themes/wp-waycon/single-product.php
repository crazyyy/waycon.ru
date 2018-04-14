  <?php get_header(); ?>
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <div id="inhalt">
      <div id="oben">
        <div class="csc cea7 op1 wvp sptop0 spbottom0">
          <div class="ce">
            <div class="ce0">
              <div class="csc-header csc-header-n1 csc-header--centered"><h1 class="csc-firstHeader"><?php the_title(); ?></h1></div>
            </div>
          </div>
        </div>
      </div>

      <div id="spalten">
        <div id="normal">
          <div id="post-<?php the_ID(); ?>" class="csc cea7 boxsingle style1 op1 spbottom0 saitobaza-box">
            <div class="ce">
              <div class="ce0">
                  <div class="csc-textpic-text" style="width:100%;">
                    <a rel="nofollow" class="feature-img" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                      <?php if ( has_post_thumbnail()) { ?>
                        <img src="<?php echo the_post_thumbnail_url('medium'); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
                      <?php } ?>
                    </a><!-- /post thumbnail -->
                    <?php the_content(); ?>

                    <?php include(TEMPLATEPATH.'/include-table.php'); ?>

                    <?php edit_post_link(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php get_sidebar(); ?>
      </div><!-- spalten -->

      <div class="clear">&nbsp;</div>
    </div>
  <?php endwhile; endif; ?>

  <?php include(TEMPLATEPATH.'/include-header.php'); ?>

<?php get_footer(); ?>