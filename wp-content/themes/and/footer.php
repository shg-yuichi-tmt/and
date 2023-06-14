<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package and
 */

?>
<div class="footer_links fadein">
	<div class="container">
		<div class="line_banner">
			<div class="h">
				<h3>公式LINE</h3>
			</div>
			<a href="https://lin.ee/2QF0FPR" target="_blank" rel="noopener noreferrer"><img src="/assets/img/line_banner.png" alt="LINEお友達登録のバナー"></a>
		</div>
		<div class="twitter">
			<div class="h">
				<h3>Twitter</h3>
			</div>
			<div class="feed">
				<a class="twitter-timeline" href="https://twitter.com/and_0316?ref_src=twsrc%5Etfw"></a>
				<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
		</div>
	</div>
</div>
<footer id="colophon" class="site-footer">
	<div class="footer_nav">
		<div class="container">
			<div class="footer_logo">
				<img src="/assets/img/footer_logo.png" alt="& -アンド-">
			</div>
			<div class="nav">
				<?php
				wp_nav_menu(
					array(
						'menu' => 'footer',
						'menu_id' => 'footer-nav',
					)
				);
				?>
			</div>
		</div>
	</div>
	<?php if (wp_is_mobile()) : ?>
		<div class="footer_cta">
			<a href="https://lin.ee/2QF0FPR" class="line"><img src="/assets/img/line_icon.png" alt="LINEのアイコン">LINEで予約</a>
			<a href="#" class="tel"><img src="/assets/img/phone_icon.png" alt="LINEのアイコン">電話で予約</a>
		</div>
	<?php endif; ?>
	<div class="site-info">
		Copyright ©️ 2023 Relaxation Salon & ALL Rights Reserved
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>