<?php
/**
 * The template for displaying colors page
 * 
 * Template Name: Kolory blach
 *
 * @package Bat-Max
 */
$fields = get_fields();
get_header();
?>

	<main id="primary" class="site-main colors-page">
    <div class='page-header'>
      <img src='<?php echo get_the_post_thumbnail_url(); ?>' alt='' class='page-header-bg' />
      <h1 class='main-heading page-heading'><span><?php the_title(); ?></span></h1>
    </div>
    <?php
    if ($fields['colors']): ?>
      <article>
        <?php foreach ( $fields['colors'] as $field ): ?>
          <h2 class='colors-page-heading'>
            <?php echo $field['title'] ?>
          </h2>
          <section class='default-section'>
            <ul class='colors-page-list'>
              <?php foreach ( $field['list'] as $item ): ?>
                <li>
                  <img src='<?php echo $item['img']; ?>' class='home-header-slide-bg' />
                  <h3><?php echo $item['title']; ?></h3>
                  <h4><?php echo $item['description']; ?></h4>
                </li>
              <?php endforeach; ?>
            </ul>
          </section>
        <?php endforeach; ?>
      </article>
    <?php endif; ?>
    <?php
    if ($fields['info']): ?>
      <section class='default-section colors-page-info'>
        <h3>
          <img src='<?php echo $fields['info']['icon']; ?>' alt='' class='home-header-slide-bg' />
          <span><?php echo $fields['info']['text']; ?></span>
        </h3>
      </section>
    <?php endif; ?>
	</main>
<?php
get_footer();
