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
			<div class="item">
				<a href="https://lin.ee/2QF0FPR" target="_blank" rel="noopener noreferrer"><img src="/assets/img/line_banner.png" alt="LINEお友達登録のバナー"></a>
			</div>
			<div class="h">
				<h3>LINKS</h3>
			</div>
			<div class="banners">
				<div class="item">
					<a href="https://www.esthe-ranking.jp/esthe-ranking/7d3df127-9fc2-4b38-af01-266f150f94e0/" rel="noopener noreferrer nofollow" target="_blank"><img src="https://www.esthe-ranking.jp/assets/img/banner/in/area95.gif" alt="群馬・高崎エリア メンズエステランキング"></a>
				</div>
				<div class="item">
					<a href="https://menesth.jp/14/area88/" target="_blank"><img src="https://menesth.jp/assets/img/user/link/img-bnr468.jpg" width="468" height="60" border="0" alt="太田のおすすめメンズエステ情報｜メンズリラク"></a>
				</div>
				<div class="item">
					<a href="https://menesth-job.jp/14/area88/" target="_blank"><img alt="メンズエステ求人を太田でお探しなら「リラクジョブ」" width="640" height="80" border="0" src="https://dv6drgre1bci1.cloudfront.net/systemfiles.ranking-deli-kyujin.jp/menesth-job/assets/img/user/link/64080_rj.jpg" /></a>
				</div>
				<div class="item">
					<a href="https://eslove.jp/kanto/gunma/shoplist" rel="noopener noreferrer nofollow" target="_blank"><img src="https://eslove.jp/eslove_front_theme/banner/banner_468x60.jpg" alt="群馬のメンズエステ情報ならエステラブ" /></a>
				</div>
				<div class="item">
					<a rel="noopener noreferrer nofollow" href="https://qzin.jp" target="_blank"><img src="https://ad.qzin.jp/img/bnr_sp_sample_vanilla.jpg" width="640" height="80"></a>
				</div>
				<div class="item">
					<a href="https://estama.jp/" target="_blank" rel="noopener noreferrer nofollow"><img src="https://static-v2.estama.jp/assets/default/pc/img/page/link/estama_468_60.png"></a>
				</div>
				<div class="item">
					<a href="https://www.es-maniax.com/" target="_blank" rel="noopener noreferrer nofollow"><img loading="lazy" src="https://s3-ap-northeast-1.amazonaws.com/temani/20210813173709_c502012_b38zsxhflj4joub0_w680.jpg"></a>
				</div>
				<div class="item">
					<a href="https://job.eslove.jp/kanto/gunma/search" target="_blank"><img src="https://job.eslove.jp/eslove_job_front_theme/img/banner/banner_468x60.jpg" alt="群馬のメンズエステ求人情報ならエステラブワーク" /></a>
				</div>
			</div>
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
				<img src="/assets/img/logo01_w.png" alt="& -アンド-">
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
			<a href="tel:0276578093" class="tel"><img src="/assets/img/phone_icon.png" alt="LINEのアイコン">電話で予約</a>
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