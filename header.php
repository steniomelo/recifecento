<?php
/**
 * This is the template that displays all of the <head> section.
 *
 * @link https://livecomposerplugin.com/themes/
 *
 * @package LC Blank
 */
header('Access-Control-Allow-Origin: *');

global $post;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-179193063-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-179193063-1');
	</script>
	<meta name="google-site-verification" content="6T395Qf5FK3DPOshL7qzK-j2uWjUlhGgLlweMT79wy0" />
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Recife Centro - É fácil e tá na mão </title>

	<link rel="shortcut icon" type="image/png" href="<?php echo ASSETS;?>/img/layout/favicon.png"/>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>

	<script data-ad-client="ca-pub-4672816343502215" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</head>
<body <?php body_class(); ?>>

<?php

if ( function_exists( 'dslc_hf_get_header' ) ) {
	echo dslc_hf_get_header();
}

?>

<header id="header">
	
	<div class="d-none d-lg-block header-desktop">

		<div class="header-container container">

			<div class="header-logo">
				<div class="logo">
					<a href="<?php echo BASE;?>">
						<img src="<?php echo ASSETS;?>/img/layout/logo.png" class="header-logo__img">
					</a>
				</div>
				<button class="hamburger d-block d-sm-none" type="button">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>

			<nav class="header-nav">
				<?php 
				
					wp_nav_menu( array( 'theme_location' => 'menu-principal', 'container' => ' ' ) );
				 ?>
				
			</nav>
			<nav class="header-nav header-nav--secondary ml-auto">
				<?php 
				
					wp_nav_menu( array( 'theme_location' => 'menu-secundário', 'container' => ' ' ) );
				 ?>
				
			</nav>

			<div class="header-nav">
					
						<a href="https://www.facebook.com/recifecentro/" target="_blank" >
						<i class="fab fa-facebook-f"></i>
					
					
					<a href="https://www.instagram.com/recifecentro/" target="_blank">
						<i class="fab fa-instagram"></i>
					</a>
				</div>
			</div>

		</div>

	</div>


	<div class="d-block d-lg-none header-mobile">

		<div class="header-container">

			<div class="header-logo mr-auto">
				<div class="logo">
					<a href="<?php echo BASE;?>">
						<img src="<?php echo ASSETS;?>/img/layout/logo.png" class="header-logo__img">
					</a>
				</div>
			</div>

			

			<div class="header-hamburger">
				<button class="hamburger" type="button">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>


		</div>

	</div>



</header>

<div id="header-search">
	<div id="header-search-container" class="container">
		<div class="row">

			
			<div class="col-sm-9 col-12 header-search-content">
				<header class="header-search-title">
					<h2><?php echo $GLOBALS['campos']['config']['header_-_busca']['titulo']; ?></h2>
				</header>

				<form action="<?php echo ROTA_IMOVEIS;?>/busca" method="post">
					<div class="filters filters-search">
						<div class="filter">
							<div class="filter-container">
								<header class="filter-header">
									<img src="<?php echo ASSETS;?>/img/icons/andares.svg" alt="">
									<span class="filter-title"><?php echo $GLOBALS['campos']['config']['header_-_busca']['tipo_do_imovel']; ?></span>
								</header>
								<div class="filter-content radios white">
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="tipo" id="tipo1" value="todos">
										<label class="form-check-label" for="tipo1"><?php echo $GLOBALS['campos']['config']['header_-_busca']['todos']; ?></label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="tipo" id="tipo2" value="apartamentos">
										<label class="form-check-label" for="tipo2"><?php echo $GLOBALS['campos']['config']['header_-_busca']['apartamentos']; ?></label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="tipo" id="tipo3" value="litoral">
										<label class="form-check-label" for="tipo3"><?php echo $GLOBALS['campos']['config']['header_-_busca']['litoral']; ?></label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="tipo" id="tipo4" value="flat">
										<label class="form-check-label" for="tipo4"><?php echo $GLOBALS['campos']['config']['header_-_busca']['flat__studios']; ?></label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="tipo" id="tipo5" value="comerciais">
										<label class="form-check-label" for="tipo5"><?php echo $GLOBALS['campos']['config']['header_-_busca']['salas_comerciais']; ?></label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="tipo" id="tipo6" value="casas">
										<label class="form-check-label" for="tipo6">Casas</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="tipo" id="tipo7" value="terrenos">
										<label class="form-check-label" for="tipo7">Terrenos</label>
									</div>
								</div>
							</div>
						</div>

						<div class="filter filter-valor">
							<div class="filter-container">
								<header class="filter-header">
									<img src="<?php echo ASSETS;?>/img/icons/valor.svg" alt="">
									<span class="filter-title"><?php echo $GLOBALS['campos']['config']['header_-_busca']['valor']; ?></span>
								</header>
								<div class="filter-content">
									<div class="range">
										<div class="range-header">
											<div class="range-min">
												R$ <span>70.000</span>
											</div>
											<hr>
											<div class="range-max">
												R$ <span>3.000.000</span>
											</div>
										</div>
										<input type="text" name="valor" class="range-value" value="70000,3000000" />
									</div>
								</div>
							</div>
						</div>

						<div class="filter">
							<div class="filter-container">
								<header class="filter-header">
									<img src="<?php echo ASSETS;?>/img/icons/quarto.svg" alt="">
									<span class="filter-title"><?php echo $GLOBALS['campos']['config']['header_-_busca']['quartos']; ?></span>
								</header>
								<div class="filter-content radios white">
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="quartos" id="quartos1" value="1">
										<label class="form-check-label" for="quartos1">1</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="quartos" id="quartos2" value="2">
										<label class="form-check-label" for="quartos2">2</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="quartos" id="quartos3" value="3">
										<label class="form-check-label" for="quartos3">3</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="quartos" id="quartos4" value="4">
										<label class="form-check-label" for="quartos4">4+</label>
									</div>
								</div>
							</div>
						</div>

						<div class="filter">
							<div class="filter-container">
								<header class="filter-header">
									<img src="<?php echo ASSETS;?>/img/icons/vaga.svg" alt="">
									<span class="filter-title"><?php echo $GLOBALS['campos']['config']['header_-_busca']['vagas']; ?></span>
								</header>
								<div class="filter-content radios white">
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="vagas" id="vagas1" value="1">
										<label class="form-check-label" for="vagas1">1</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="vagas" id="vagas2" value="2">
										<label class="form-check-label" for="vagas2">2</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="vagas" id="vagas3" value="3">
										<label class="form-check-label" for="vagas3">3</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="vagas" id="vagas4" value="4">
										<label class="form-check-label" for="vagas4">4+</label>
									</div>
								</div>
							</div>
						</div>
					</div>

					<input type="hidden" id="construtora" name="construtora">

					<footer class="header-search-footer col-sm-3 mx-auto">
						<button class="btn btn-secondary btn-rounded btn-large btn-block"><?php echo $GLOBALS['campos']['config']['header_-_busca']['botao_aplicar']; ?></button>
					</footer>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="header-nav">
	<div id="header-nav-container" class="col-lg-5">
		<div id="header-nav-content">
			<div id="header-nav-title">
				<h1><?php echo $GLOBALS['campos']['config']['header_-_menu']['titulo_do_menu']; ?></h1>
			</div>
			<nav id="header-nav-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'menu-principal', 'container' => ' ', 'link_after' => '<i class="arrow-hover"></i>' ) );?>
				
			</nav>

			<nav id="header-nav-secondary">
				<?php wp_nav_menu( array( 'theme_location' => 'menu-secundário', 'container' => ' ' ) );?>
			</nav>

			<div id="nav-footer">
				<small><?php echo $GLOBALS['campos']['config']['header_-_menu']['copyright']; ?></small>
			</div>
		</div>
	</div>
</div>