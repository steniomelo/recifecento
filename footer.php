<?php
/**
 * The template for displaying the footer.
 *
 * @link https://livecomposerplugin.com/themes/
 *
 * @package LC Blank
 */

?>

<div id="footer">
	<?php if(is_page('home')) : ?>
	<div id="footer-contact" class="d-none d-md-flex">
		<div class="h-space d-none d-lg-flex"></div>
		<div class="contact-title">
			<h2><?php echo get_the_title($GLOBALS['contato']->ID); ?></h2>
		</div>
		<div class="contact-phone">
			<img src="<?php echo ASSETS;?>/img/icons/phone.svg" alt="">
			<span><?php echo $GLOBALS['campos']['contato']['telefone']; ?></span>
			<img src="<?php echo ASSETS;?>/img/icons/whatsapp.svg" alt="">
		</div>
		<!-- <div class="contact-whatsapp">
			<span><?php echo $GLOBALS['campos']['contato']['whatsapp']; ?></span>
		</div> -->
		<div class="h-space d-none d-lg-flex"></div>
	</div>
	<?php endif; ?>
	<nav class="footer-nav d-none d-md-flex">
		<?php wp_nav_menu( array( 'theme_location' => 'menu-secundário', 'container' => ' ' ) );?>

		<!-- <a href="<?php echo ROTA_IMOVEIS;?>/lancamentos">
			<span>Lançamento</span>
		</a>
		<a href="<?php echo ROTA_IMOVEIS;?>/em-construcao">
			<span>Em construção</span>
		</a>
		<a href="<?php echo ROTA_IMOVEIS;?>/pronto">
			<span>Pronto para morar</span>
		</a>
		<a href="<?php echo ROTA_IMOVEIS;?>/litoral">
			<span>Litoral</span>
		</a>
		<a href="<?php echo ROTA_IMOVEIS;?>/minha-casa-minha-vida">
			<span>Minha Casa Minha Vida</span>
		</a> -->
	</nav>

	<div id="footer-info">
		<div class="info-logo d-none d-md-block">
			<img src="<?php echo ASSETS;?>/img/layout/logo-completo@3x.png">
		</div>
		<nav class="info-nav d-none d-md-block">
			<?php wp_nav_menu( array( 'theme_location' => 'menu-institucional', 'container' => ' ' ) );?>
				<!-- <a href="<?php echo BASE;?>/sobre">
					<span>Quem somos</span>
				</a>
				<?php if(is_home()) { ?>
					<a href="#noticias">
						<span>Notícias</span>
					</a>
				<?php } else { ?>
					<a href="<?php echo BASE;?>/#noticias">
						<span>Notícias</span>
					</a>
				<?php } ?>
				<a href="<?php echo BASE;?>/contato">
					<span>Contato</span>
				</a>
				<a href="<?php echo BASE;?>/contato/trabalheconosco">
					<span>Trabalhe conosco</span>
				</a> -->
		</nav>
		<div class="info-address d-none d-md-block">
			<small><?php echo $GLOBALS['campos']['config']['footer']['endereco_-_titulo']; ?></small>
			<address><?php echo $GLOBALS['campos']['config']['footer']['endereco']; ?></address>
			<a href="phone:+558130193333"><?php echo $GLOBALS['campos']['config']['footer']['telefone']; ?></a>

		</div>
		<div class="info-newsletter">
			<strong><?php echo $GLOBALS['campos']['config']['footer']['newsletter']; ?></strong>
			<?php echo do_shortcode('[ninja_form id=2]'); ?>

		</div>
	</div>

	<div id="footer-copyright">
		<div class="container">
			<div class="row">
				<div class="col-sm-7 mr-auto ml-auto">
					<?php echo $GLOBALS['campos']['config']['footer']['copyright']; ?>
				</div>
				<div class="col-sm-3 social mr-auto ml-auto">
					<a href="https://www.facebook.com/nogueiracorretores/" target="_blank">
						<img src="<?php echo ASSETS;?>/img/icons/facebook.svg" alt="Facebook">
					</a>
					<a href="https://www.linkedin.com/company/armando-nogueira-imobiliaria" target="_blank">
						<img src="<?php echo ASSETS;?>/img/icons/linkedin-logo.svg" width="15" height="15" alt="Linkedin">
					</a>
					<a href="https://www.youtube.com/channel/UCFLu0wdbyhiyHLSfPCgNPtQ" target="_blank">
						<img src="<?php echo ASSETS;?>/img/icons/youtube.svg" alt="Youtube">
					</a>
					<a href="https://www.instagram.com/nogueiracorretores/" target="_blank">
						<img src="<?php echo ASSETS;?>/img/icons/instagram.svg" alt="Instagram">
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
