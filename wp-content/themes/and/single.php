<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package and
 */

get_header();
?>

<main id="primary" class="site-main type-page">
	<header class="entry-header">
		<div class="thumbnail">
			<?php if (wp_is_mobile()) : ?>
				<img width="585" height="345" src="/wp-content/uploads/2023/06/5066731_m-585x345.jpg" class="attachment-mobile_thumbnail size-mobile_thumbnail wp-post-image" alt="" decoding="async">
			<?php else : ?>
				<img width="1536" height="321" src="/wp-content/uploads/2023/06/5066731_m-1536x321.jpg" class="attachment-desktop_thumbnail size-desktop_thumbnail wp-post-image" alt="" decoding="async">
			<?php endif; ?>
			<h1 class="entry-title">お知らせ <span>-NEWS-</span></h1>
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

	<?php
	while (have_posts()) :
		the_post(); ?>

		<div class="entry-content">
			<div class="container">
				<section class="article">
					<div class="header">
						<?php the_title('<h2 class="title">', '</h2>'); ?>
						<div class="date"><?php the_date('Y年m月d日 H:i'); ?></div>
					</div>
					<div class="content">
						<?php the_content(); ?>
					</div>
				</section>
				<?php
				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle"></span> <span class="nav-title">< %title</span>',
						'next_text' => '<span class="nav-subtitle"></span> <span class="nav-title">%title ></span>',
					)
				);
				?>
			</div>
		</div>

	<?php endwhile; // End of the loop 
	?>

</main><!-- #main -->

<?php
get_footer();
