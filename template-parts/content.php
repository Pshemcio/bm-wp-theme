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
$gallery_field = get_field( "gallery", get_the_ID() );
$price_field = get_field( "price", get_the_ID() );
$first_gallery_img = $gallery_field ? $gallery_field[0] : false;
?>

<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>" class="no-line">
		<?php if ( $price_field ) : ?>
			<small class='post-price'>Od <?php echo $price_field; ?>zł</small>
		<?php endif; ?>
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail(); ?>
		<?php elseif($first_gallery_img) :?>
			<img src='<?php echo $first_gallery_img['url']; ?>' />
		<?php else :?>
			<img src='<?php echo $fallback_img; ?>' class='fallback-img' />
		<?php endif; ?>
		<span><?php the_title_attribute(); ?></span>
	</a>
</li><!-- #post-<?php the_ID(); ?> -->
