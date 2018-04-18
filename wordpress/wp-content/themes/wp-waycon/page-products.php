<?php /* Template Name: Products Page */ get_header(); ?>
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>
  <div id="inhalt">
    <div id="oben">
      <a id="c2649"></a>
      <div id="c2235" class="csc cea7  style2 op1 headerbar">
        <div class="ce">
          <div class="ce0">
            <div class="csc-header csc-header-n1">
              <h1 class="csc-firstHeader">Наша продукция</h1></div>
          </div>
        </div>
      </div>
    </div>

    <div id="spalten">
      <div id="normal">
        <?php $categories = get_terms('c', 'hide_empty=1'); ?>
        <?php $i=1; foreach( $categories as $category ) : ?>

          <?php $class = '';
            if (($i == 1) || ($i == 4) || ($i == 7) || ($i == 10) || ($i == 13) || ($i == 16)) {
              $class = 'posleft';
            } else if (($i == 2) || ($i == 5) || ($i == 8) || ($i == 11) || ($i == 14) || ($i == 17)) {
              $class = 'poscenter';
            } else if (($i == 3) || ($i == 6) || ($i == 9) || ($i == 12) || ($i == 15) || ($i == 18)) {
              $class = 'posright';
            }
          ?>

          <?php
            if (($i == 1)) {
              echo '<div class="csc cea7  style1 op0 spbottom0 fxhoverzoomin threeboxes"><div class="ce shortcut">';
            } else if (($i == 4) || ($i == 7) || ($i == 10) || ($i == 13) || ($i == 16)) {
              echo '<div class="csc cea7  style1 op0 sptop0 spbottom0 threeboxes fxhoverzoomin"><div class="ce shortcut">';
            }
          ?>

            <div class="csc cea7  spbottom05 w33 <?php echo $class; ?>">
              <div class="csc-textpic csc-textpic-center csc-textpic-above">
                <div class="csc-textpic-imagewrap" style="width:100%;" data-csc-images="1" data-csc-cols="1">
                  <div class="csc-textpic-imagerow">
                    <?php $image = get_field('products_page_image', $category); if( $image ) { ?>
                      <figure class="csc-textpic-image">
                        <a href="<?php echo get_term_link( $category->slug, 'c' ); ?>" title="<?php echo $category->name; ?>">
                          <img src="<?php echo $image['url']; ?>" alt="<?php echo $category->name; ?>" title="<?php echo $category->name; ?>">
                        </a>
                      </figure>
                    <?php } ?>
                  </div>
                </div>
                <div class="csc-textpic-text" style="width:100%;">
                  <h2 class="riesig"><a href="<?php echo get_term_link( $category->slug, 'c' ); ?>"><?php echo $category->name; ?></a></h2>
                  <?php if( have_rows('benefits', $category) ): echo '<ul>'; while ( have_rows('benefits', $category) ) : the_row(); ?>
                    <li><?php the_sub_field('item'); ?></li>
                  <?php endwhile; echo '</ul>'; endif; ?>
                </div>
              </div>
            </div>

          <?php
            if (($i == 3) || ($i == 6) || ($i == 9) || ($i == 12) || ($i == 15) || ($i == 18)) {
              echo '</div></div>';
            }
          ?>

        <?php $i++; endforeach ?>

          </div>
        </div>

      </div>
    </div>
    <!--TYPO3SEARCH_end-->
    <div class="clear">&nbsp;</div>
  </div>

  <?php endwhile; endif; ?>

  <?php include(TEMPLATEPATH.'/include-header.php'); ?>

<?php get_footer(); ?>
