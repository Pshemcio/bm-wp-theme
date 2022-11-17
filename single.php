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
					<div class="glide__arrows" data-glide-el="controls">
						<button class="glide__arrow glide__arrow--left" data-glide-dir="<">prev</button>
						<button class="glide__arrow glide__arrow--right" data-glide-dir=">">next</button>
					</div>
        </div>
        <div class="glide__bullets single-post-slide-bullets" data-glide-el="controls[nav]">
          <?php foreach ( $fields['gallery'] as $key=>$field ): ?>
            <button class="glide__bullet single-post-slide-bullet" data-glide-dir="=<?php echo $key ?>">
							<img src='<?php echo $field['url']; ?>' />
						</button>
          <?php endforeach; ?>
        </div>
      </div>
    <?php else: ?>
			<div class='single-post-fallback-img'>
				<img src='<?php echo $fallback_img; ?>' />
			</div>
    <?php endif; ?>
		<div>
			<h1><?php the_title_attribute(); ?></h1>
			<?php if($fields['price']): ?>
				<h3>Cena: od <?php echo $fields['price']; ?>zł</h3>
    	<?php endif; ?>
			<p>
				<?php echo $current_category_text; ?>
				<a href='<?php echo get_category_link($current_category[0]->term_id) ?>'>
					<?php echo $current_category[0]->name ?>
				</a>
			</p>
			<?php if (isset($fields['description']) && $fields['description']): ?>
				<div>
					<h2>Opis</h2>
					<div>
						<?php echo $fields['description'] ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if (isset($fields['add_info']) && $fields['add_info']): ?>
				<div>
					<h2>Dodatkowe informacje</h2>
					<div>
						<?php echo $fields['add_info'] ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main><!-- #post-<?php the_ID(); ?> -->

<?php
get_footer();
