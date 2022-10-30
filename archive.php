<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bat-Max
 */

get_header();
$category = get_category( get_query_var( 'cat' ) );
$thumbnail = get_field( 'img', $category->taxonomy . '_' . $category->term_id );
$description = get_field( 'description', $category->taxonomy . '_' . $category->term_id );
?>
	<main id="primary" class="site-main archive-page">
		<div class='page-header'>
      <img src='<?php echo $thumbnail; ?>' alt='' class='page-header-bg' />
      <h1 class='main-heading page-heading'><span><?php single_term_title(); ?></span></h1>
    </div>
		<?php if ( $description) : ?>
			<section class='default-section narrower archive-page-description'>
				<?php echo $description ?>
			</section>
		<?php endif; ?>
		<section class='default-section narrower archive-page-list'>
			<?php if (have_posts()): ?>
				<ul>
				<?php while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
					endwhile; ?>
				</ul>
				<?php the_posts_navigation(); ?>
			<?php endif; ?>
			<?php if (!have_posts()) {
				get_template_part( 'template-parts/content', 'none' );
			} ?>
		</section>
	</main><!-- #main -->

<?php
get_footer();
