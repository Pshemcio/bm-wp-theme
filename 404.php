<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Bat-Max
 */

get_header();
$options = get_options_fields();
?>

	<main id="primary" class="site-main error-page">

		<section class="default-section error-page-inner">
			<div class='error-page-content'>
				<h1>404</h1>
				<h2 class="page-title"><?php echo $options['error_page']['text']; ?></h2>
				<a href='<?php echo get_site_url() ?>' class='secondary-button'><?php echo $options['error_page']['button_text']; ?></a>
			</div>
			<div class="error-page-image">
				<img src='<?php echo $options['error_page']['img'] ?>' alt='' />
			</div>
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
