<?php
/**
 * The template for displaying all pages
 * 
 * Template Name: Home Page
 *
 * @package Bat-Max
 */

get_header();
?>

	<main id="primary" class="site-main site-main-home">
    <h1><?php single_post_title(); ?></h1>
    <ul>
      <?php
        $fields = CFS()->get( 'header' );
        if (isset($fields)): ?>
        <?php foreach ( $fields as $field ): ?>
          <li>
            <?php echo $field['heading']; ?>
            <?php echo $field['lead']; ?>
            <img src='<?php echo $field['img']; ?>' />
            <?php 
              $link = $field['primary_button'];
              if (is_array($link)): 
            ?>
              <a href='<?php echo $link['url'] ?>' target='<?php echo $link['target'] ?>'><?php echo $link['text'] ?: $link['url'] ?></a>
            <?php endif ?>
            <?php 
              $link = $field['secondary_button'];
              if (is_array($link)): 
            ?>
              <a href='<?php echo $link['url'] ?>' target='<?php echo $link['target'] ?>'><?php echo $link['text'] ?: $link['url'] ?></a>
            <?php endif ?>
          </li>
      <?php endforeach; ?>
      <?php endif; ?>
    </ul>
	</main>

<?php
get_footer();
