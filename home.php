<?php
/**
 * The template for displaying home page
 * 
 * Template Name: Strona główna
 *
 * @package Bat-Max
 */
$fields = get_fields();

$section_subsoil = $fields['section_subsoil'];
$gallery = get_gallery_with_pagination(16);
// $options['gallery_heading']
$chunked_gallery = array_chunk($gallery['images_array'], 2);
$options = get_options_fields();
get_header();
?>

	<main id="primary" class="site-main site-main-home">
    <?php
    if (isset($fields['home_header'])): ?>
      <div id='home-header-slider' class="glide home-header-slider" data-header-autoplay='<?php echo $fields['header_autoplay'] ?>'>
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            <?php foreach ( $fields['home_header'] as $key=>$field ): ?>
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
          <?php foreach ( $fields['home_header'] as $key=>$field ): ?>
            <button class="glide__bullet" data-glide-dir="=<?php echo $key ?>"></button>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
    <?php
    if ($fields['split_section']): ?>
      <section class='default-section split-section'>
        <?php foreach ( $fields['split_section'] as $field ): ?>
          <article class='split-section-inner'>
            <div class='split-section-content'>
              <h2 class='main-heading'><span><?php echo $field['heading'] ?></span></h2>
              <div class='arrows-list'><?php echo $field['lead'] ?></div>
            </div>
            <img src='<?php echo $field['img']['url'] ?>' alt='<?php echo $field['img']['alt'] ?>' />
          </article>
        <?php endforeach; ?>
      </section>
    <?php endif; ?>
    <?php 
    if ($fields['bg_section']['list']): ?>
      <section class='default-section bg-section'>
        <div class='bg-section-content'>
          <h2 class='main-heading'><span><?php echo $fields['bg_section']['heading'] ?></span></h2>
          <ul>
            <?php foreach ( $fields['bg_section']['list'] as $field ): ?>
              <li>
                <img src='<?php echo $field['icon'] ?>' alt='' />
                <div class='bg-section-list-content'>
                  <h4><?php echo $field['heading'] ?></h4>
                  <p><?php echo $field['lead'] ?></p>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <img class='bg-section-image' src='<?php echo $fields['bg_section']['bg']['url'] ?>' alt='' />
      </section>
    <?php endif; ?>
    <?php
    if ($fields['circle_section']['list']): ?>
      <section class='default-section circle-section'>
        <h2 class='main-heading'><span><?php echo $fields['circle_section']['heading'] ?></span></h2>
        <?php if ($fields['circle_section']['lead']): ?>
          <p class='main-lead'><?php echo $fields['circle_section']['lead'] ?></p>
        <?php endif; ?>
        <ul>
          <?php foreach ( $fields['circle_section']['list'] as $field ): ?>
            <li><?php echo $field['lead'] ?></li>
          <?php endforeach; ?>
        </ul>
      </section>
    <?php endif; ?>
    <?php
    if ($section_subsoil['regular_list']['list']): ?>
      <section class='default-section subsoil-regular-section'>
        <h2 class='main-heading'><span><?php echo $section_subsoil['regular_list']['heading'] ?></span></h2>
        <?php if ($section_subsoil['regular_list']['lead']): ?>
          <p class='main-lead'><?php echo $section_subsoil['regular_list']['lead'] ?></p>
        <?php endif; ?>
        <ul class='arrows-list'>
          <?php foreach ( $section_subsoil['regular_list']['list'] as $field ): ?>
            <li><?php echo $field['item'] ?></li>
          <?php endforeach; ?>
        </ul>
      </section>
    <?php endif; ?>
    <?php
    if ($section_subsoil['images_list']['list']): ?>
      <section class='default-section subsoil-images-section'>
        <h2 class='main-heading'><span><?php echo $section_subsoil['images_list']['heading'] ?></span></h2>
        <?php if ($section_subsoil['images_list']['lead']): ?>
          <p class='main-lead'><?php echo $section_subsoil['images_list']['lead'] ?></p>
        <?php endif; ?>
        <ul>
          <?php foreach ( $section_subsoil['images_list']['list'] as $field ): ?>
            <li>
              <span>
                <?php echo $field['lead'] ?>
              </span>
              <img src='<?php echo $field['image']['url'] ?>' alt='<?php echo $field['image']['alt'] ?>' />
            </li>
          <?php endforeach; ?>
        </ul>
      </section>
    <?php endif; ?>
    <?php
    if ($chunked_gallery): ?>
      <section class='default-section home-gallery-section'>
        <h2 class='main-heading'><span><?php echo $options['gallery_heading'] ?></span></h2>
        <div id='home-gallery-slider' class="glide home-gallery-slider">
          <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
              <?php foreach ( $chunked_gallery as $key=>$chunk ): ?>
                <li class="glide__slide home-gallery-slide">
                  <?php foreach ( $chunk as $img ): ?>
                    <a data-fslightbox="gallery" href="<?php echo $img['url']; ?>">
                      <img src='<?php echo $img['url']; ?>' />
                    </a>
                  <?php endforeach; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="glide__bullets" data-glide-el="controls[nav]">
            <?php foreach ( $chunked_gallery as $key=>$field ): ?>
              <button class="glide__bullet" data-glide-dir="=<?php echo $key ?>"></button>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>
    <?php
    if ($fields['cta']): ?>
      <section class='default-section cta-section'>
        <ul>
          <?php foreach ( $fields['cta'] as $field ): ?>
            <li>
              <img src='<?php echo $field['icon']; ?>' />
              <span><?php echo $field['lead'] ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </section>
    <?php endif; ?>
	</main>
<?php
get_footer();
