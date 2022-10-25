<?php
/**
 * The template for displaying all pages
 * 
 * Template Name: Home Page
 *
 * @package Bat-Max
 */
$fields = get_fields();
$home_header = $fields['home_header'];
get_header();
?>

	<main id="primary" class="site-main site-main-home">
    <?php
    if (isset($home_header)): ?>
      <div id='home-header-slider' class="glide" data-header-autoplay='<?php echo $fields['header_autoplay'] ?>'>
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            <?php foreach ( $home_header as $key=>$field ): ?>
              <li class="glide__slide home-header-slide">
                <img src='<?php echo $field['img']; ?>' class='home-header-slide-bg' />
                <div class='home-header-slide-inner'>
                  <div class='home-header-slide-content'>
                    <h2>
                      <?php echo $field['heading']; ?>
                    </h2>
                    <?php if ($field['lead']): ?>
                      <p>
                        <?php echo $field['lead']; ?>
                      </p>
                    <?php endif; ?>
                    <?php 
                      $link_1 = $field['primary_button'];
                      $link_2 = $field['secondary_button'];
                      if (is_array($link_2) || is_array($link_1)): 
                    ?>
                      <div class='home-header-slide-buttons'>
                        <?php if (is_array($link_1)): ?>
                          <a href='<?php echo $link_1['url'] ?>' class='primary-button' target='<?php echo $link_1['target'] ?>'><?php echo $link_1['title'] ?: $link_1['url'] ?></a>
                        <?php endif; ?>
                        <?php if (is_array($link_2)): ?>
                          <a href='<?php echo $link_2['url'] ?>' class='secondary-button' target='<?php echo $link_2['target'] ?>'><?php echo $link_2['title'] ?: $link_2['url'] ?></a>
                        <?php endif; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="glide__bullets" data-glide-el="controls[nav]">
          <?php foreach ( $home_header as $key=>$field ): ?>
            <button class="glide__bullet" data-glide-dir="=<?php echo $key ?>"></button>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
	</main>

<?php
get_footer();
