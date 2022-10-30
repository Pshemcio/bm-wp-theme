<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bat-Max
 */

$options = get_options_fields();
$fallback_img = isset($options['fallback_img']) ? $options['fallback_img']: null;
?>

<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>" class="no-line">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail(); ?>
		<?php else :?>
			<img src='<?php echo $fallback_img; ?>' class='fallback-img' />
		<?php endif; ?>
		<span><?php the_title_attribute(); ?></span>
	</a>
</li><!-- #post-<?php the_ID(); ?> -->
