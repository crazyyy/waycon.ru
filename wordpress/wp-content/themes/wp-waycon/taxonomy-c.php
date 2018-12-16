  <?php get_header(); ?>
    <div id="inhalt">
      <div id="oben">
        <div class="csc cea7 op1 wvp sptop0 spbottom0">
          <div class="ce">
            <div class="ce0">
              <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
              <?php $image = get_field('image', $term); if( $image ) { ?>
                <div class="csc-textpic-imagewrap" style="width:100%;" data-csc-images="1" data-csc-cols="1">
                  <div class="csc-textpic-imagerow">
                    <figure class="csc-textpic-image">
                      <img src="<?php echo $image['url']; ?>" alt="<?php echo $term->name; ?>" title="<?php echo $term->name; ?>">
                    </figure>
                  </div>
                </div>
              <?php } else { ?>
                <div class="csc-header csc-header-n1 csc-header--centered"><h1 class="csc-firstHeader"><?php echo $term->name; ?></h1></div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>

      <div id="spalten">
      <?php
        //* The Query
        $exec_query = new WP_Query( array (
          'post_type' => 'product',
          'c'  => $term->slug,
          'posts_per_page' => 50
        ) );

        //* The Loop
        if ( $exec_query->have_posts() ) { ?>


          <div id="normal">
            <?php $descr = term_description( $term_id, $taxonomy ); if ($descr) { ?>
              <div class="ce">
                <div class="ce0">
                  <div class="csc-header csc-header-n1">
                    <h1 class="csc-firstHeader"><?php echo $term->name; ?></h1>
                  </div>
                  <?php echo $descr; ?>
                </div>
              </div>
            <?php } ?>

            <?php while ( $exec_query->have_posts() ): $exec_query->the_post(); ?>
            <div id="post-<?php the_ID(); ?>" class="csc cea7 boxsingle style1 op1 spbottom0 saitobaza-box">
              <div class="ce">
                <div class="ce0">
                    <div class="csc-textpic-text" style="width:100%;">
                      <a rel="nofollow" class="feature-img" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php if ( has_post_thumbnail()) { ?>
                          <img src="<?php echo the_post_thumbnail_url('full'); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
                        <?php } ?>
                      </a><!-- /post thumbnail -->
                      <?php the_content(); ?>
                      <?php include(TEMPLATEPATH.'/include-table.php'); ?>

                      <?php edit_post_link(); ?>
                    </div>
                  </div>
                </div>
              </div>

              <?php endwhile; ?>
            </div>

          <?php wp_reset_postdata(); } ?>

          <?php get_sidebar('products'); ?>
        </div>
      </div><!-- spalten -->

      <div class="clear">&nbsp;</div>

  <?php include(TEMPLATEPATH.'/include-header.php'); ?>
<?php get_footer(); ?>
