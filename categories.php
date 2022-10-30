<?php
/**
 * The template for displaying categories page
 * 
 * Template Name: Kategorie
 *
 * @package Bat-Max
 */
$fields = get_fields();
$all_categories = get_categories();
$categories = [];
foreach ( $all_categories as $category ) {
  $thumbnail = get_field( 'thumb', $category->taxonomy . '_' . $category->term_id );
  array_push($categories, [
    'name'=>$category->name, 
    'url'=>get_category_link($category),
    'thumb'=>$thumbnail
  ]);
}
get_header();
?>

	<main id="primary" class="site-main categories-page">
    <div class='page-header'>
      <img src='<?php echo get_the_post_thumbnail_url(); ?>' alt='' class='page-header-bg' />
      <h1 class='main-heading page-heading'><span><?php the_title(); ?></span></h1>
    </div>
    <?php
    if (count($categories)): ?>
      <section class='default-section narrower'>
        <ul class='categories-page-list'>
          <?php foreach ( $categories as $category ): ?>
            <li>
              <a href='<?php echo $category['url']; ?>' class='no-line'>
                <img src='<?php echo $category['thumb']; ?>' />
                <span><?php echo $category['name']; ?></span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </section>
    <?php endif; ?>
	</main>
<?php
get_footer();
