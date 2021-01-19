<?php
/**
 * The template for displaying the footer.
 *
 * @link https://livecomposerplugin.com/themes/
 *
 * @package LC Blank
 */

?>
<div id="contato"></div>
<div id="footer">

	<div class="footer-newsletter">
		<div class="container">
			<div class="newsletter__container">
				<h4 class="newsletter__container-title">Receba novidades no seu e-mail</h4>
				<?php echo do_shortcode('[ninja_form id=3]'); ?>
				<div>
					<span>E-mail seguro!</span><br>
					<small>Não enviamos spams!</small>
				</div>
			</div>
		</div>
	</div>

	<div class="container">

	<div id="footer-info" class="row">
		<nav class="info-nav col-sm-3">
			<h4 class="mb-4">MENU</h4>
			<?php wp_nav_menu( array( 'theme_location' => 'menu-rodape', 'container' => ' ' ) );?>



		</nav>
		<div class=" col-sm-4 ">
			<div class="mb-5">
						<h4 class="mb-4">REDES SOCIAIS</h4>
						<div class="social">
							<a rel="noreferrer noopener" href="https://www.facebook.com/recifecentro/" target="_blank" class="mr-4">
							<img src="<?php echo ASSETS;?>/img/icons/facebook.svg" alt="Facebook">
						</a>

						<a rel="noreferrer noopener" href="https://www.instagram.com/recifecentro/" target="_blank">
						<img src="<?php echo ASSETS;?>/img/icons/instagram.svg" alt="Instagram">
					</a>
				</div>
			</div>
			<div class="">
				<p class="mb-0">Recife Centro ® 2020. Todos os Direitos Reservados.</p>
				<p>CNPJ: 37.601.761/0001-09</p>
			</div>




		</div>

		<div class="col-sm-4 offset-md-1">
			<h4 class="mb-4">CONTATO</h4>

			<?php echo do_shortcode('[ninja_form id=2]'); ?>
		</div>
	</div>


	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
