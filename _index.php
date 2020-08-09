<?php
/**
 * Template Name: Home

 */
get_header();
?>

<div id="destaques-slider">
	<div id="slides" data-destaque-slider>
		<?php 
			$slider = new WP_Query(
				array(
					'post_type' => 'properties',
					'post_status' => 'publish',
					'orderby' => 'menu_order', 
					'order' => 'ASC',
                    'meta_key' => 'properties_selected_banner',
                    'meta_value' => 1,
					'posts_per_page' => 4
				)
			);  

			if ($slider->have_posts()) : $slider->the_post();
				foreach($slider->posts as $imovel):
					$photo = get_field('properties_photo_cover', $imovel->ID);
					// banner
					$properties_photo_banner = get_field('properties_photo_banner', $imovel->ID)['url'];
					$properties_link_banner = get_field('properties_link_banner', $imovel->ID);
					$properties_selected_banner = get_field('properties_selected_banner', $imovel->ID);
					if ($properties_selected_banner == 1):
		?>
		<div class="slide">
			<div class="slide-text"><!-- Título e Subtítulo da Galeria --></div>

			<div class="slide-footer">
				<div class="container">
					<div class="slide-info">
						<div class="info info-tamanho"></div>
						<div class="info info-tamanho"></div>
						<div class="info info-tamanho"></div>
						<div class="info info-tamanho"></div>
						<div class="info info-tamanho"></div>
						
						<div class="info more-info">
							<a href="<?php echo $properties_link_banner; ?>" class="more-info-btn">
								<span class="d-none d-md-block">
									<?php echo $GLOBALS['campos']['home']['botao_do_slider'];?>
								</span>
								<span class="d-block d-md-none">
									<?php echo $GLOBALS['campos']['home']['botao_do_slider_-_mobile'];?>
								</span>
								<i class="arrow-hover"></i>								
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="slide-image">
				<img src="<?php echo $properties_photo_banner; ?>" />
			</div>
		</div>
		<?php else: ?>
		<div class="slide">
			<div class="slide-text">
				<h1>
					<?php 
						$explode_neighborhood = explode('-', get_field('properties_neighborhood', $imovel->ID));
						echo $explode_neighborhood[0]; 
					?>
				</h1>
				<h3><?php echo get_field('properties_name', $imovel->ID); ?></h3>
			</div>

			<div class="slide-footer">
				<div class="container">
					<div class="slide-info">
						<?php if (get_field('properties_size', $imovel->ID)): ?>
						<div class="info info-tamanho">
							<img src="<?php echo ASSETS;?>/img/icons/tamanho.svg" />
							<span><?php echo get_field('properties_size', $imovel->ID); ?></span>
						</div>
						<?php endif; ?>

						<?php if (get_field('properties_room', $imovel->ID)): ?>
						<div class="info info-quartos">
							<img src="<?php echo ASSETS;?>/img/icons/quarto.svg">
							<span><?php echo get_field('properties_room', $imovel->ID); ?></span>
						</div>
						<?php endif; ?>
						
						<?php if (get_field('properties_toilet', $imovel->ID)): ?>
						<div class="info info-banheiros">
							<img src="<?php echo ASSETS;?>/img/icons/banheiro.svg">
							<span><?php echo get_field('properties_toilet', $imovel->ID); ?></span>
						</div>
						<?php endif; ?>
						
						<?php if (get_field('properties_vacancy', $imovel->ID)): ?>
						<div class="info info-vagas">
							<img src="<?php echo ASSETS;?>/img/icons/vaga.svg">
							<span><?php echo get_field('properties_vacancy', $imovel->ID); ?></span>
						</div>
						<?php endif; ?>
						
						<?php if (get_field('properties_price', $imovel->ID)): ?>
						<div class="info info-valor">
							<img src="<?php echo ASSETS;?>/img/icons/valor.svg">
							<span>R$ <?php echo number_format(get_field('properties_price', $imovel->ID), 2, ',', '.'); ?></span>
						</div>
						<?php endif; ?>
						
						<div class="info more-info">
							<a href="<?php echo get_post_permalink($imovel->ID); ?>" class="more-info-btn">
								<span class="d-none d-md-block"><?php echo $GLOBALS['campos']['home']['botao_do_slider'];?></span>
								<span class="d-block d-md-none"><?php echo $GLOBALS['campos']['home']['botao_do_slider_-_mobile'];?></span>
								<i class="arrow-hover"></i>								
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="slide-image">
				<img src="<?php echo $photo; ?>" />
			</div>
		</div>
		<?php 
			endif;
			endforeach; 
		?>
	</div>

	<div id="slider-nav">
		<div class="container">
			<div class="nav-list" data-destaque-slider-nav>
				<?php 
					$i = 0;
					foreach($slider->posts as $imovel):
						$i++; 
						$properties_title_banner = get_field('properties_title_banner', $imovel->ID);
						$properties_subtitle_banner = get_field('properties_subtitle_banner', $imovel->ID);
						$properties_selected_banner = get_field('properties_selected_banner', $imovel->ID);
						$i == 1 ? $active = 'active' : $active = '';
						if ($properties_selected_banner == 1):
					?>
					<div class="list-item <?php echo $active; ?>">
						<strong><?php echo $properties_title_banner; ?></strong>
						<small><?php echo $properties_subtitle_banner; ?></small>
					</div>
				<?php else: ?>
				<div class="list-item <?php echo $active; ?>">
					<strong>
						<?php 
							$explode_neighborhood = explode('-', get_field('properties_neighborhood', $imovel->ID));
							echo $explode_neighborhood[0];
						?>
					</strong>
					<small><?php echo get_field('properties_name', $imovel->ID); ?></small>
				</div>
				<?php
					endif; 
					endforeach; 
				?>
				<div class="list-item"></div>
			</div>
		</div>
	</div>	
</div>
<?php
	endif;
	wp_reset_postdata();
?>

<?php 
	// Imóveis em Detaque
	$destaques = new WP_Query(
		array(
			'post_type' => 'properties',
			'post_status' => 'publish',
			'order' => 'DESC'
		)
	);

	if ($destaques->have_posts()) : $destaques->the_post();
?>
<section id="destaques" class="section">
	<header class="section-header">
		<h2 class="section-title">Imóveis em destaque</h2>
	</header>
	
	<div class="section-content">
		<div class="list-horizontal imoveis ">
			<div class="list-items list-imoveis " data-list-horizontal>
				<?php
					foreach($destaques->posts as $imovel):
						$photo = get_field('properties_photo_cover', $imovel->ID);
						$spotlight = get_field('properties_selected_spotlight', $imovel->ID);
						if ($spotlight == 1 && $photo):
				?>
				<div class="list-item imovel">
					<div class="imovel-container">
						<div class="imovel-content">
							<div class="imovel-img">
								<img src="<?php echo $photo; ?>" />
							</div>

							<div class="imovel-details">
								<header class="imovel-title">
									<h2 class="imovel-bairro">
										<?php 
											$explode_neighborhood = explode('-', get_field('properties_neighborhood', $imovel->ID));
											echo $explode_neighborhood[0];
										?>
									</h2>
									<h3 class="imovel-nome">
										<?php echo get_field('properties_name', $imovel->ID); ?>
									</h3>
								</header>
								<div class="imovel-info">
									<?php if (get_field('properties_size', $imovel->ID)): ?>
									<div class="info info-tamanho">
										<img src="<?php echo ASSETS;?>/img/icons/tamanho.svg">
										<small><?php echo get_field('properties_size', $imovel->ID); ?></small>
									</div>
									<?php endif; ?>

									<?php if (get_field('properties_room', $imovel->ID)): ?>
									<div class="info info-quartos">
										<img src="<?php echo ASSETS;?>/img/icons/quarto.svg">
										<small><?php echo get_field('properties_room', $imovel->ID); ?></small>
									</div>
									<?php endif; ?>
									
									<?php if (get_field('properties_toilet', $imovel->ID)): ?>
									<div class="info info-banheiros">
										<img src="<?php echo ASSETS;?>/img/icons/banheiro.svg">
										<small><?php echo get_field('properties_toilet', $imovel->ID); ?></small>
									</div>
									<?php endif; ?>
								</div>

								<div class="imovel-description">
									<?php echo $imovel->post_excerpt; ?>
								</div>

								<div class="imovel-price">
									<small><?php echo $GLOBALS['campos']['config']['geral']['a_partir_de']; ?></small>
									<strong class="price">
										<small class="price-cifrao">R$</small>
										<span class="price-valor"><?php echo number_format(get_field('properties_price', $imovel->ID), 2, ',', '.'); ?></span>
									</strong>
								</div>
							</div>
						</div>
					</div>
					<div class="imovel-footer">
						<a href="<?php echo get_post_permalink($imovel->ID); ?>" class="btn btn-block btn-primary"><?php echo $GLOBALS['campos']['home']['botao_dos_imoveis'];?></a>
					</div>
				</div>
				<?php 
					endif;
					endforeach;
				?>
				<div class="space"></div>
			</div>
		</div>
	</div>
</section>
<?php 
	endif; 
	wp_reset_postdata();
?>

<?php 
	// Imóveis novos
	$destaques = new WP_Query(
		array(
			'post_type' => 'properties',
			'post_status' => 'publish',
			'order' => 'DESC'
		)
	);

	if ($destaques->have_posts()) : $destaques->the_post();
?>
<section id="destaques" class="section">
	<header class="section-header">
		<h2 class="section-title">Imóveis novos</h2>
	</header>
	
	<div class="section-content">
		<div class="list-horizontal imoveis ">
			<div class="list-items list-imoveis " data-list-horizontal>
				<?php
					foreach($destaques->posts as $imovel):
						$photo = get_field('properties_photo_cover', $imovel->ID);
						$new = get_field('properties_selected_new', $imovel->ID);
						// $properties_selected_old = get_field('properties_selected_old', $imovel->ID);
						if ($new == 1 && $photo):
				?>
				<div class="list-item imovel">
					<div class="imovel-container">
						<div class="imovel-content">
							<div class="imovel-img">
								<img src="<?php echo $photo; ?>" />
							</div>

							<div class="imovel-details">
								<header class="imovel-title">
									<h2 class="imovel-bairro">
										<?php 
											$explode_neighborhood = explode('-', get_field('properties_neighborhood', $imovel->ID));
											echo $explode_neighborhood[0];
										?>
									</h2>
									<h3 class="imovel-nome">
										<?php echo get_field('properties_name', $imovel->ID); ?>
									</h3>
								</header>
								<div class="imovel-info">
									<?php if (get_field('properties_size', $imovel->ID)): ?>
									<div class="info info-tamanho">
										<img src="<?php echo ASSETS;?>/img/icons/tamanho.svg">
										<small><?php echo get_field('properties_size', $imovel->ID); ?></small>
									</div>
									<?php endif; ?>

									<?php if (get_field('properties_room', $imovel->ID)): ?>
									<div class="info info-quartos">
										<img src="<?php echo ASSETS;?>/img/icons/quarto.svg">
										<small><?php echo get_field('properties_room', $imovel->ID); ?></small>
									</div>
									<?php endif; ?>
									
									<?php if (get_field('properties_toilet', $imovel->ID)): ?>
									<div class="info info-banheiros">
										<img src="<?php echo ASSETS;?>/img/icons/banheiro.svg">
										<small><?php echo get_field('properties_toilet', $imovel->ID); ?></small>
									</div>
									<?php endif; ?>
								</div>

								<div class="imovel-description">
									<?php echo $imovel->post_excerpt; ?>
								</div>

								<div class="imovel-price">
									<small><?php echo $GLOBALS['campos']['config']['geral']['a_partir_de']; ?></small>
									<strong class="price">
										<small class="price-cifrao">R$</small>
										<span class="price-valor"><?php echo number_format(get_field('properties_price', $imovel->ID), 2, ',', '.'); ?></span>
									</strong>
								</div>
							</div>
						</div>
					</div>
					<div class="imovel-footer">
						<a href="<?php echo get_post_permalink($imovel->ID); ?>" class="btn btn-block btn-primary">Ver Detalhes</a>
					</div>
				</div>
				<?php 
					endif;
					endforeach;
				?>
				<div class="space"></div>
			</div>
		</div>
	</div>
</section>
<?php 
	endif; 
	wp_reset_postdata();
?>

<?php 
	// Imóveis usados
	$destaques = new WP_Query(
		array(
			'post_type' => 'properties',
			'post_status' => 'publish',
			'order' => 'DESC'
		)
	);

	if ($destaques->have_posts()) : $destaques->the_post();
?>
<section id="destaques" class="section">
	<header class="section-header">
		<h2 class="section-title">Imóveis usados</h2>
	</header>
	
	<div class="section-content">
		<div class="list-horizontal imoveis ">
			<div class="list-items list-imoveis " data-list-horizontal>
				<?php
					foreach($destaques->posts as $imovel):
						$photo = get_field('properties_photo_cover', $imovel->ID);
						$old = get_field('properties_selected_old', $imovel->ID);
						if ($old == 1 && $photo):
				?>
				<div class="list-item imovel">
					<div class="imovel-container">
						<div class="imovel-content">
							<div class="imovel-img">
								<img src="<?php echo $photo; ?>" />
							</div>

							<div class="imovel-details">
								<header class="imovel-title">
									<h2 class="imovel-bairro">
										<?php 
											$explode_neighborhood = explode('-', get_field('properties_neighborhood', $imovel->ID));
											echo $explode_neighborhood[0];
										?>
									</h2>
									<h3 class="imovel-nome">
										<?php echo get_field('properties_name', $imovel->ID); ?>
									</h3>
								</header>
								<div class="imovel-info">
									<?php if (get_field('properties_size', $imovel->ID)): ?>
									<div class="info info-tamanho">
										<img src="<?php echo ASSETS;?>/img/icons/tamanho.svg">
										<small><?php echo get_field('properties_size', $imovel->ID); ?></small>
									</div>
									<?php endif; ?>

									<?php if (get_field('properties_room', $imovel->ID)): ?>
									<div class="info info-quartos">
										<img src="<?php echo ASSETS;?>/img/icons/quarto.svg">
										<small><?php echo get_field('properties_room', $imovel->ID); ?></small>
									</div>
									<?php endif; ?>
									
									<?php if (get_field('properties_toilet', $imovel->ID)): ?>
									<div class="info info-banheiros">
										<img src="<?php echo ASSETS;?>/img/icons/banheiro.svg">
										<small><?php echo get_field('properties_toilet', $imovel->ID); ?></small>
									</div>
									<?php endif; ?>
								</div>

								<div class="imovel-description">
									<?php echo $imovel->post_excerpt; ?>
								</div>

								<div class="imovel-price">
									<small><?php echo $GLOBALS['campos']['config']['geral']['a_partir_de']; ?></small>
									<strong class="price">
										<small class="price-cifrao">R$</small>
										<span class="price-valor"><?php echo number_format(get_field('properties_price', $imovel->ID), 2, ',', '.'); ?></span>
									</strong>
								</div>
							</div>
						</div>
					</div>
					<div class="imovel-footer">
						<a href="<?php echo get_post_permalink($imovel->ID); ?>" class="btn btn-block btn-primary">Ver Detalhes</a>
					</div>
				</div>
				<?php 
					endif;
					endforeach;
				?>
				<div class="space"></div>
			</div>
		</div>
	</div>
</section>
<?php 
	endif; 
	wp_reset_postdata();
?>


<?php 
	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 5,
	);
	$noticias = new WP_Query( $args );

	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 6,
		'offset'		=> 5
	);
	$noticias_semimagem = new WP_Query( $args );
?>

<?php if ( $noticias->have_posts() ) :  ?>

<section id="noticias" class="section list-noticias d-none d-md-block">

	<div class="section-content">
		<div class="list-horizontal" >
			<header class="section-header">
				<h2 class="section-title">
					<?php echo $GLOBALS['campos']['config']['geral']['noticias']; ?>
				</h2>

				<nav class="section-nav">
					<span class="arrow arrow-prev">
						<img src="<?php echo ASSETS;?>/img/icons/arrow-right.svg">
					</span>
					<span class="arrow arrow-next">
						<img src="<?php echo ASSETS;?>/img/icons/arrow-right.svg">
					</span>
				</nav>
			</header>
			<div class="lists" data-list-horizontal-nobar>
				<div class="list-items">
					<?php 
						while ( $noticias->have_posts() ) : $noticias->the_post(); 
					?>
						<?php 
							get_template_part( 'partials/noticia', 'card' );
						?>
					<?php endwhile; 
					wp_reset_postdata(); ?>
					<div class="space"></div>

					
				</div>
				<div class="list-items sem-imagem">
					<?php 
						while ( $noticias_semimagem->have_posts() ) : $noticias_semimagem->the_post(); 
					?>
						<?php 
							get_template_part( 'partials/noticia', 'card' );
						?>
					<?php endwhile; 
					wp_reset_postdata(); ?>
					<div class="space"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
