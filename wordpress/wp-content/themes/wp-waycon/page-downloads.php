<?php /* Template Name: Downlad Page */ get_header(); ?>
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>

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
              <div class="csc-header csc-header-n1 csc-header--centered"><h1 class="csc-firstHeader"><?php the_title(); ?></h1></div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>

    <div id="spalten">
      <div id="normal">

        <div class="csc cea7 spbottom0">
          <div class="ce">
            <div class="ce0">
              <?php the_content(); ?>
            </div>
          </div>
        </div>

        <div class="csc cea7  figcaptionbold nophone">
          <div class="ce">
            <div class="ce0">
              <div class="csc-header csc-header-n2">
                <h2 class="">Каталог продукции</h2>
              </div>
              <div class="csc-textpic csc-textpic-center csc-textpic-above csc-textpic-border">
                <div class="csc-textpic-imagewrap" style="width:100%;" data-csc-images="7" data-csc-cols="4">

                  <?php if( have_rows('catalogs') ): ?>
                    <div class="csc-textpic-imagerow csc-textpic-imagerow-mb">
                      <?php while ( have_rows('catalogs') ) : the_row(); ?>

                      <?php
                        $attachment_id = get_sub_field('file');
                        $url = wp_get_attachment_url( $attachment_id );
                        $image = get_sub_field('caprion');
                      ?>

                        <figure class="csc-textpic-image">
                          <a href="<?php echo $url; ?>" target="_blank" title="<?php the_sub_field('title') ?>" class="">
                            <img src="<?php echo $image['url']; ?>" alt="<?php the_sub_field('title') ?>" class="">
                          </a>
                          <figcaption class="csc-textpic-caption"><?php the_sub_field('title') ?></figcaption>
                        </figure>

                      <?php endwhile;?>
                    </div>
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="csc cea7 figcaptionbold noprint nostandard notablet">
          <div class="ce fadetoview fadefromleft">
            <div class="ce0 fadetoview fadefromleft">
              <div class="csc-header csc-header-n3 fadetoview fadefromleft">
                <h2 class="fadetoview fadefromleft">Product catalogs</h2>
              </div>

              <div class="csc-textpic csc-textpic-center csc-textpic-above csc-textpic-border fadetoview fadefromleft">
                <div class="csc-textpic-imagewrap fadetoview fadefromleft" style="width:100%;" data-csc-images="7" data-csc-cols="2">

                  <?php if( have_rows('catalogs') ): ?>
                    <div class="csc-textpic-imagerow csc-textpic-imagerow-mb">
                      <?php while ( have_rows('catalogs') ) : the_row(); ?>

                      <?php
                        $attachment_id = get_sub_field('file');
                        $url = wp_get_attachment_url( $attachment_id );
                        $image = get_sub_field('caprion');
                      ?>

                        <figure class="csc-textpic-image">
                          <a href="<?php echo $url; ?>" target="_blank" title="<?php the_sub_field('title') ?>" class="">
                            <img src="<?php echo $image['url']; ?>" alt="<?php the_sub_field('title') ?>" class="">
                          </a>
                          <figcaption class="csc-textpic-caption"><?php the_sub_field('title') ?></figcaption>
                        </figure>

                      <?php endwhile;?>
                    </div>
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>
        </div>

      <?php $categories = get_terms('c', 'hide_empty=1'); ?>
        <?php foreach( $categories as $category ) : ?>

          <div class="csc cea7  style1 op0 sptop05 waycontables">
            <div class="ce">
              <div class="ce0">
                <div class="csc-header csc-header-n4">
                  <h2 class=""><a href="<?php echo get_term_link( $category->slug, 'c' ); ?>" target="_blank" class=""><?php echo $category->name; ?></a></h2></div>
                <table class="matrix zeilen">
                  <tbody class="">

                    <tr class="">
                      <td class="">Название</td>
                      <td class="">Скачать</td>
                    </tr>

                    <?php
                    //* The Query
                    $exec_query = new WP_Query( array (
                      'post_type' => 'product',
                      'c'  => $category->slug,
                      'posts_per_page' => 50
                    ) );

                    //* The Loop
                    if ( $exec_query->have_posts() ) { ?>
                    <?php while ( $exec_query->have_posts() ): $exec_query->the_post(); ?>

                        <tr class="">
                          <td class=""><a href="<?php the_permalink(); ?>" target="_blank" class=""><?php the_title(); ?></a></td>
                          <td class="">
                            <?php $i = 0; if( have_rows('download') ): while ( have_rows('download') ) : the_row(); ?>
                              <?php
                                $attachment_id = get_sub_field('file');
                                $url = wp_get_attachment_url( $attachment_id );
                                if ($i==0) { $delim = ''; } else { $delim = '| ';}
                              ?>
                              <?php echo $delim; ?><a href="<?php echo $url; ?>" title="<?php echo $title; ?>" target="_blank"><?php the_sub_field('title') ?></a>
                            <?php $i++; endwhile; endif; ?>

                          </td>
                        </tr>

                      <?php endwhile; ?>
                    <?php wp_reset_postdata(); } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>

         <?php endforeach ?>

      <br><br>

      </div>
    </div>
    <div class="clear">&nbsp;</div>
  </div>

  <?php endwhile; endif; ?>

  <?php include(TEMPLATEPATH.'/include-header.php'); ?>

<?php get_footer(); ?>
