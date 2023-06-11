<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package and
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="thumbnail">
			<?php if (wp_is_mobile()) : ?>
				<?php the_post_thumbnail('mobile_thumbnail'); ?>
			<?php else : ?>
				<?php the_post_thumbnail('desktop_thumbnail'); ?>
			<?php endif; ?>
			<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
		</div>
		<?php if (!wp_is_mobile()) : ?>
			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'and'); ?></button>
				<?php
				wp_nav_menu(
					array(
						'menu' => 'Primary',
						'theme_location' => 'primary',
						'menu_id'        => 'header-nav',
					)
				);
				?>
			</nav><!-- #site-navigation -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
		<?php if (function_exists('bcn_display')) {
			bcn_display();
		} ?>
	</div>

	<div class="entry-content">
		<div class="container">
			<?php the_content(); ?>
		</div>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->