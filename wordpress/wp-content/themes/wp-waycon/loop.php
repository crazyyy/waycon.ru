<?php if (have_posts()): while (have_posts()) : the_post(); ?>
  <div class="news-list-item">
    <div class="news-list-img">
      <a rel="nofollow" class="feature-img" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php if ( has_post_thumbnail()) { ?>
          <img src="<?php echo the_post_thumbnail_url('medium'); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" width="260" height="260" />
        <?php } else { ?>
          <img src="<?php echo catchFirstImage(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" width="260" height="260" />
        <?php } ?>
      </a><!-- /post thumbnail -->
    </div>
    <div class="news-list-block">
      <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
      <p><span class="news-list-date"></span> - </p>
      <p><?php wpeExcerpt('wpeExcerpt20'); ?><span class="news-list-morelink"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">more</a></span></p>
      <p></p>
      <span class="news-list-morelink"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">[more]</a></span>
    </div>
    <hr class="clearer">
  </div>

<?php endwhile; endif; ?>
