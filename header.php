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

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Recife Centro</title>

	<link rel="shortcut icon" type="image/png" href="<?php echo ASSETS;?>/img/layout/favicon.png"/>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>

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

			

			

			

		</div>

	</div>


	<div class="d-block d-lg-none header-mobile">

		<div class="header-container">

			<div class="header-logo mr-auto">
				<div class="logo">
					<a href="<?php echo BASE;?>">
						<img src="<?php echo ASSETS;?>/img/layout/logo-header-footer@2x.png" class="logo-branco" >
						<img src="<?php echo ASSETS;?>/img/layout/logo-header-footer@2x.png" class="logo-azul" >
					</a>
				</div>
			</div>

			<div class="header-search">
				<img src="<?php echo ASSETS;?>/img/icons/search.svg" class="icon-search">
				<img src="<?php echo ASSETS;?>/img/icons/x.svg" class="icon-close">
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

			<?php $args = array(
				'post_type'      => 'construtoras',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
			);
			$construtoras = new WP_Query( $args );

			if ( $construtoras->have_posts() ) :  
			?>
				<div class="col-sm-3 d-none d-sm-block header-search-construtoras">
					<nav>
						<ul>
							<li class="active ">
								<div class="construtora-img">
									<img src="<?php echo ASSETS;?>/img/icons/icon-consr.svg">
								</div>
								<div class="construtora-title">
									<?php echo $GLOBALS['campos']['config']['header_-_busca']['todas_as_construtoras']; ?>
								</div>
							</li>
							<li class="">
								<div class="construtora-img">
									<img src="<?php echo ASSETS;?>/img/icons/reseal.svg">
								</div>
								<div class="construtora-title">
									<?php echo $GLOBALS['campos']['config']['header_-_busca']['revenda']; ?>
								</div>
							</li>
							<?php while ( $construtoras->have_posts() ) : $construtoras->the_post(); ?>	

							<li class="construtora" data-value="<?php the_ID(); ?>">
							<!-- <li class="construtora" data-value="<?php the_field('codigo'); ?>"> -->

								<div class="construtora-img">
									<?php the_post_thumbnail('small'); ?>
								</div>
								<span class="construtora-title">
									<?php the_title(); ?>
								</span>
							</li>
							<?php endwhile; wp_reset_postdata(); ?>

						</ul>
					</nav>
				</div>
			<?php endif; ?>
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
				<?php wp_nav_menu( array( 'theme_location' => 'menu-secundário', 'container' => ' ', 'link_after' => '<i class="arrow-hover"></i>' ) );?>
				<!-- <a href="<?php echo ROTA_IMOVEIS;?>/lancamentos">
					<span>Lançamento</span>
					<i class="arrow-hover"></i>	
				</a>
				<a href="<?php echo ROTA_IMOVEIS;?>/em-construcao">
					<span>Em construção</span>
					<i class="arrow-hover"></i>	

				</a>
				<a href="<?php echo ROTA_IMOVEIS;?>/pronto">
					<span>Pronto para morar</span>
					<i class="arrow-hover"></i>	

				</a>
				<a href="<?php echo ROTA_IMOVEIS;?>/litoral">
					<span>Litoral</span>
					<i class="arrow-hover"></i>	

				</a>
				<a href="<?php echo ROTA_IMOVEIS;?>/empresarial">
					<span>Empresarial</span>
					<i class="arrow-hover"></i>	

				</a>
				<a href="<?php echo ROTA_IMOVEIS;?>/minha-casa-minha-vida">
					<span>Minha Casa Minha Vida</span>
					<i class="arrow-hover"></i>	

				</a> -->
			</nav>

			<nav id="header-nav-secondary">
				<?php if(is_page('home')) { ?>
					<?php wp_nav_menu( array( 'theme_location' => 'menu-institucional', 'container' => ' ' ) );?>
				<?php } else { ?>
					<?php wp_nav_menu( array( 'menu' => 'menu institucional 2', 'container' => ' ' ) );?>
				<?php } ?>



				<!-- <a href="<?php echo BASE;?>/sobre">
					<span>Quem somos</span>
				</a>
				<?php if(is_home()) { ?>
					<a href="#noticias" class="smoothScroll">
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

			<div id="nav-footer">
				<small><?php echo $GLOBALS['campos']['config']['header_-_menu']['copyright']; ?></small>
			</div>
		</div>
	</div>
</div>