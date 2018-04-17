<?php /* Template Name: Home Page */ get_header(); ?>
  <style type="text/css">
    body {
      background: url(<?php echo get_template_directory_uri(); ?>/img/hintbi.jpg) no-repeat center top / cover;
      background-attachment: fixed;
    }
  </style>
  <div id="inhalt">
    <div id="oben">

      <div class="csc cea7  style1 op1 wvp">
        <div class="ce">
          <div class="ce0">
            <?php $images = get_field('gallery'); if( $images ): ?>
              <div class="tx-imagecycle-pi3 slider-wrapper theme-default imagecycle-nivo_c897">
                <div class="tx-imagecycle-pi3-images nivoSlider" id="imagecycle-nivo_c897">
                <?php foreach( $images as $image ): ?>
                  <img src="<?php echo $image['url']; ?>" width="2500" height="800" alt="<?php echo $image['alt']; ?>">
                <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>
            <noscript>
              <div class="tx-imagecycle-pi3 slider-wrapper theme-default">
                <div class="tx-imagecycle-pi3-images nivoSlider imagecycle-nivo_c897">
                  <img src="<?php echo $image['url']; ?>" width="2500" height="800" alt="">
                </div>
              </div>
            </noscript>
          </div>
        </div>
      </div>

      <div class="csc cea7  style2 op1 headerbar">
        <div class="ce">
          <div class="ce0">
            <h1 class="color5 align-center">Точная технология датчика для измерения положения и расстояния</h1></div>
        </div>
      </div>
      <div id="c2292" class="csc cea7  style3 op1 threeboxes fxhoverzoomin">
        <div class="ce shortcut">
          <?php $i=0; if( have_rows('third_blocks') ): while ( have_rows('third_blocks') ) : the_row(); ?>
            <?php $class = '';
              if ($i == 0 ) {
                $class = 'posleft';
              } else if ($i == 1 ) {
                $class = 'poscenter';
              } else {
                $class = 'posright';
              }
            ?>
            <div class="csc cea7  w33 <?php echo $class; ?>">
              <div class="csc-textpic csc-textpic-center csc-textpic-above">
                <div class="csc-textpic-imagewrap" style="width:100%;" data-csc-images="1" data-csc-cols="1">
                  <div class="csc-textpic-imagerow">
                    <figure class="csc-textpic-image">
                      <?php $image = get_sub_field('image'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?>
                    </figure>
                  </div>
                </div>
                <div class="csc-textpic-text" style="width:100%;">
                  <h2 class="gross"><?php  the_sub_field('title'); ?></h2>
                  <?php the_sub_field('descr'); ?>
                  <p><?php $cats_id = get_sub_field('categories'); if( $cats_id ): ?>
                    <?php foreach( $cats_id as $cat_id): $term = get_term( $cat_id, $taxonomy ); ?>
                      <a href="/c/<?php echo $term->slug; ?>" target="_blank" class="symbol"><?php echo $term->name; ?></a><br>
                    <?php endforeach; ?>
                  <?php endif; ?>
                  </p>
                </div>
              </div>
            </div>
          <?php $i++; endwhile; endif; ?>
        </div>
      </div>


      <div class="csc cea7  style1 op1 gap50 fxhoverspotlight tabletnofloat">
        <div class="ce shortcut">
          <div id="c2910" class="csc cea7">
            <div class="ce">
              <div class="ce0">
                <div class="csc-header csc-header-n1">
                  <h2 class="csc-header-alignment-center csc-firstHeader">In-House manufacturing</h2></div>
              </div>
            </div>
          </div>

          <?php $i=0; if( have_rows('block_fourth') ): while ( have_rows('block_fourth') ) : the_row(); ?>
            <?php $class = '';
              if (($i == 0) || ($i == 2)) {
                $class = 'posleft';
              } else if (($i == 1) || ($i == 3)) {
                $class = 'posright';
              }
            ?>
            <div id="c552" class="csc cea7 w50 <?php echo $class; ?>">
              <div class="csc-textpic csc-textpic-intext-left-nowrap csc-textpic-intext-left-nowrap-935 csc-textpic-border">
                <div class="csc-textpic-imagewrap" style="width:50%;" data-csc-images="1" data-csc-cols="1">
                  <div class="csc-textpic-imagerow">
                    <figure class="csc-textpic-image"><?php $image = get_sub_field('image'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?></figure>
                  </div>
                </div>
                <div class="csc-textpic-text" style="width:50%;">
                  <div class="csc-textpicHeader csc-textpicHeader-26">
                    <h3><a href="<?php the_sub_field('links'); ?>"><?php the_sub_field('title'); ?></a></h3>
                  </div>
                  <p><?php the_sub_field('descr'); ?> <a href="<?php the_sub_field('links'); ?>" target="_blank">[больше]</a></p>
                </div>
              </div>
            </div>
          <?php $i++; endwhile; endif; ?>

        </div>
      </div>


      <div class="csc cea7  style2 op05">
        <div class="ce shortcut">
          <div id="c2912" class="csc cea7  w25 posleft">
            <div class="align-center">
              <p class="x40"><i class="fa fa-leaf editoricon rte"><br></i></p>
              <h4>Окружающая среда</h4>
              <p>Waycon придерживается своих принципов управления качеством в Кодексе поведения.</p>
            </div>
          </div>
          <div id="c2913" class="csc cea7  w25 poscenter">
            <div class="align-center">
              <p class="x40"><i class="fa fa-recycle editoricon rte"><br></i></p>
              <h4>Упаковка</h4>
              <p>WayCon обходится без использования экологически опасных упаковочных материалов.</p>
            </div>
          </div>
          <div id="c2914" class="csc cea7  w25 poscenter">
            <div class="align-center">
              <p class="x40"><i class="fa fa-child editoricon rte"><br></i></p>
              <h4>Права человека</h4>
              <p>В дополнение к уважению основных прав, WayCon придает большое значение отказу от детского труда.</p>
            </div>
          </div>
          <div id="c2915" class="csc cea7  w25 posright">
            <div class="align-center">
              <p class="x40"><i class="fa fa-male editoricon rte"><br></i></p>
              <h4>Наемный рабочий</h4>
              <p>Каждый сотрудник вносит свой вклад в соответствие политике соблюдения Waycon.</p>
            </div>
          </div>
        </div>
      </div>


      <div class="csc cea7  style1 op1">
        <div class="ce">
          <div class="ce0">
            <div class="csc-header csc-header-n6">
              <h1 class="csc-header-alignment-center">Новости</h1></div>
            <div class="ttnews">
              <div class="ttnews">
                <div class="news-latest-container">

                  <?php query_posts("showposts=4"); ?>
                  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                  <div class="news-latest-item">
                    <span class="news-latest-date"></span>
                    <div class="latestimg">
                      <a rel="nofollow" class="feature-img" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php if ( has_post_thumbnail()) { ?>
                          <img src="<?php echo the_post_thumbnail_url('medium'); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
                        <?php } else { ?>
                          <img src="<?php echo catchFirstImage(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
                        <?php } ?>
                      </a><!-- /post thumbnail -->
                    </div>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php wpeExcerpt('wpeExcerpt20'); ?>
                    <span class="news-latest-morelink"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">[больше]</a></span>
                    <hr class="clearer">
                  </div>
                  <?php endwhile; endif; ?>
                  <?php wp_reset_query(); ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="csc cea7  style3 op1">
        <div class="ce shortcut">
          <div id="c2916" class="csc cea7">
            <div class="ce">
              <div class="ce0">
                <div class="csc-header csc-header-n1">
                  <h2 class="csc-header-alignment-center csc-firstHeader">Видео</h2></div>
              </div>
            </div>
          </div>
          <?php $i=0; if( have_rows('video') ): while ( have_rows('video') ) : the_row(); ?>
            <?php $class = '';
              if ($i == 0 ) {
                $class = 'posleft';
              } else if ($i == 1 ) {
                $class = 'poscenter';
              } else {
                $class = 'posright';
              }
            ?>
            <div id="c2918" class="csc cea7  w33 <?php echo $class; ?>">
              <div class="video-container">
                <?php the_sub_field('videos'); ?>
              </div>
            </div>
          <?php $i++; endwhile; endif; ?>
        </div>
      </div>

      <div class="csc cea7  style1 op1">
        <div class="ce">
          <div class="ce0">
            <div class="csc-header csc-header-n8">
            <div class="csc-textpic csc-textpic-center csc-textpic-below">
              <div class="csc-textpic-text" style="width:100%;">
                <?php the_content(); ?>
              </div>
              <div class="csc-textpic-imagewrap" style="width:100%;" data-csc-images="4" data-csc-cols="4">
                <?php $location = get_field('location'); if( !empty($location) ): ?>
                <div class="acf-map">
                  <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="clear">&nbsp;</div>
  </div>

  <?php include(TEMPLATEPATH.'/include-header.php'); ?>

<?php get_footer(); ?>
