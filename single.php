<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Bat-Max
 */

$fields = get_fields();
// var_dump($fields['description']);
$options = get_options_fields();
$current_category_text = isset($options['current_category']) ? $options['current_category']: null;
$current_category = get_the_category(get_the_ID());
get_header();
$fallback_img = isset($options['fallback_img']) ? $options['fallback_img']: null;

$recent_posts_by_cat = wp_get_recent_posts(array(
	'category' => $current_category[0]->term_id,
	'numberposts' => 3,
	'post_status' => 'publish',
	'post__not_in' => array( $post->ID )
));

$recent_posts=[];
$title = get_the_title( get_the_ID() );

foreach ( $recent_posts_by_cat as $post ) {
	$gallery_field = get_field( "gallery", $post['ID'] );
	$price_field = get_field( "price", $post['ID'] );
	$first_gallery_img = $gallery_field ? $gallery_field[0] : false;

  array_push($recent_posts, [
    'ID'=>$post['ID'], 
    'url'=>get_permalink($post['ID']),
		'price'=>$price_field,
    'img'=>$first_gallery_img,
		'title'=>$post['post_title']
  ]);
}
?>

<main id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
	<section class='default-section single-post-content'>
	<?php
		if (isset($fields['gallery']) && $fields['gallery']): ?>
      <div id='single-post-slider' class="glide single-post-slider">
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            <?php foreach ( $fields['gallery'] as $key=>$field ): ?>
              <li class="glide__slide single-post-slide">
								<img src='<?php echo $field['url']; ?>' class='single-post-slide-bg' />
              </li>
            <?php endforeach; ?>
          </ul>
					<?php if( count($fields['gallery']) > 1 ): ?>
						<div class="glide__arrows" data-glide-el="controls">
							<button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
							<button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
						</div>
					<?php endif; ?>
        </div>
				<?php if( count($fields['gallery']) > 1 ): ?>
					<div class="glide__bullets single-post-slide-bullets" data-glide-el="controls[nav]">
						<?php foreach ( $fields['gallery'] as $key=>$field ): ?>
							<button class="glide__bullet single-post-slide-bullet" data-glide-dir="=<?php echo $key ?>">
								<img src='<?php echo $field['url']; ?>' />
							</button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
      </div>
    <?php else: ?>
			<div class='single-post-fallback-img'>
				<img src='<?php echo $fallback_img; ?>' />
			</div>
    <?php endif; ?>
		<div>
			<h1><?php echo $title; ?></h1>
			<?php if(isset($fields['price']) && $fields['price']): ?>
				<h3>Cena: od <?php echo $fields['price']; ?>zł</h3>
    	<?php endif; ?>
			<p>
				<?php echo $current_category_text; ?>
				<a href='<?php echo get_category_link($current_category[0]->term_id) ?>'>
					<?php echo $current_category[0]->name ?>
				</a>
			</p>
			<?php if (isset($fields['description']) && $fields['description']): ?>
				<div class='accordion accordion-opened' data-accordion>
					<button class='accordion-header' data-accordion-trigger>Opis</button>
					<div class='accordion-content'>
						<?php echo $fields['description'] ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if (isset($fields['add_info']) && $fields['add_info']): ?>
				<div class='accordion' data-accordion>
					<button class='accordion-header' data-accordion-trigger>Dodatkowe informacje</button>
					<div class='accordion-content'>
						<?php echo $fields['add_info'] ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<div class='archive-page'>
		<section class='default-section narrower archive-page-list'>
			<?php if(isset($options['related_offers']) && $options['related_offers']): ?>
				<h1 class='main-heading'><span><?php echo $options['related_offers'] ?></span></h1>
			<?php endif ?>
			<?php if ($recent_posts): ?>
				<ul>
				<?php foreach ( $recent_posts as $post ): ?>
					<li id="post-<?php $post['ID'] ?>" <?php post_class(); ?>>
						<a href="<?php echo $post['url'] ?>" class="no-line">
							<?php if ( $post['price'] ) : ?>
								<small class='post-price'>Od <?php echo $post['price']; ?>zł</small>
							<?php endif; ?>
							<div class='post-image-wrapper'>
								<?php if($post['img']) :?>
									<img src='<?php echo $post['img']['url']; ?>' />
								<?php else :?>
									<div class='fallback-img'>
										<img src='<?php echo $fallback_img; ?>' />
									</div>
								<?php endif; ?>
							</div>
							<span><?php echo $post['title']; ?></span>
						</a>
					</li>
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</section>
	<div>
</main><!-- #post-<?php the_ID(); ?> -->

<?php
get_footer();
