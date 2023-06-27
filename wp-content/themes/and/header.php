<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package and
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-8WVLXYXK8J"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'G-8WVLXYXK8J');
	</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'and'); ?></a>

		<?php if (is_front_page()) : ?>
			<div id="loading-wrapper">
				<div id="loading__content">
					<div class="logo">
						<img src="/assets/img/logo03.png" alt="&. -アンド- RELAXATION SALON">
					</div>
				</div>
			</div>
			<script src="<?php echo get_template_directory_uri(); ?>/js/loading.js"></script>
		<?php endif; ?>

		<header id="masthead" class="site-header">
			<div class="container">
				<div class="site-branding">
					<?php the_custom_logo(); ?>
				</div><!-- .site-branding -->
				<div id="menu_btn">
					<div class="menu-trigger">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
				<?php if (!wp_is_mobile()) : ?>
					<div class="contact">
						<div class="tel">
							<a href="tel:0276578093">0276-57-8093</a>
							<div class="hour">
								<p>受付時間：午前9:30-深夜0:00<br>営業時間：午前10:00-深夜2:00</p>
							</div>
						</div>
						<div class="line">
							<a href="https://lin.ee/2QF0FPR" target="_blank" rel="noopener noreferrer">LINEで予約</a>
						</div>
					</div>
				<?php else : ?>
					<div class="contact">
						<div class="tel">
							<div class="hour">
								<p>受付時間：午前9:30-深夜0:00<br>営業時間：午前10:00-深夜2:00</p>
							</div>
						</div>
					</div>
					<nav id="site-navigation" class="main-navigation">
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
			</div>
		</header><!-- #masthead -->