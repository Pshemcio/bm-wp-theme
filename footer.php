<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bat-Max
 */

$options = get_options_fields();
$footer = $options['footer'];
?>

	<footer id="colophon" class="site-footer">
		<section class='default-section'>
			<article>
				<h1><?php echo get_bloginfo('name') ?></h1>
				<ul>
					<?php if ($footer['address']['value']): ?>
						<li>
							<a href='<?php echo $footer['address']['value']['url'] ?>' target='<?php echo $footer['address']['value']['target'] ?>'>
							<?php echo $footer['address']['title'] ?>: <?php echo $footer['address']['value']['title'] ?>
							</a>
						</li>
					<?php endif; ?>
					<?php if ($footer['email']['title']): ?>
						<li>
							<a href='mailto:<?php echo $footer['email']['value'] ?>'>
							<?php echo $footer['email']['title'] ?>: <?php echo $footer['email']['value'] ?>
							</a>
						</li>
					<?php endif; ?>
					<?php if ($footer['phone_numbers']): ?>
						<li>
							<?php foreach ( $footer['phone_numbers'] as $field ): ?>
								<li>
									<a href='tel:<?php echo $field['number'] ?>'>
										<?php echo $field['title'] ?>: <?php echo $field['number'] ?>
									</a>
								</li>
							<?php endforeach; ?>
						</li>
					<?php endif; ?>
					<?php if ($footer['add_info']): ?>
						<li>
							<?php foreach ( $footer['add_info'] as $field ): ?>
								<li>
									<?php echo $field['title'] ?>: <?php echo $field['value'] ?>
								</li>
							<?php endforeach; ?>
						</li>
					<?php endif; ?>
				</ul>
			</article>
			<article>
				<?php echo do_shortcode('[wpforms id="'.$footer['contact_form_id'].'" title="true" description="true"]');?>
			</article>
			<div class="author-info">
				©<?php echo date("Y") ?> Bat-Max. All rights reserved. | Designed and powered by 
				<a href="https://przemekmajka.pl/" target='_blank'  rel="noopener noreferrer">
					Pshemcio
				</a>
			</div>
    </section><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
