<div id="links">
  <div class="ebene1"><a href="/company.htm">Компания</a></div>

  <?php wpeSideNav(); ?>

  <div class="csc cea7 boxleft">
    <div class="ce">
      <div class="ce0">
        <div class="csc-header">
          <h5><a href="/products.htm">Продукция</a></h5></div>
          <?php $categories = get_terms('c', 'hide_empty=1'); ?>
          <ul class="csc-menu csc-menu-3">
            <?php foreach( $categories as $category ) : ?>
              <li class="l1 no">
                <a href="<?php echo get_term_link( $category->slug, 'c' ); ?>">
                  <?php echo $category->name; ?>
                </a>
              </li>
            <?php endforeach ?>
          </ul>
      </div>
    </div>
  </div>




</div>
