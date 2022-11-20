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
		<div class='post-image-wrapper'>
			<?php if($first_gallery_img) :?>
				<img src='<?php echo $first_gallery_img['url']; ?>' />
			<?php else :?>
				<div class='fallback-img'>
					<img src='<?php echo $fallback_img; ?>' />
				</div>
			<?php endif; ?>
		</div>
		<span><?php the_title_attribute(); ?></span>
	</a>
</li><!-- #post-<?php the_ID(); ?> -->
