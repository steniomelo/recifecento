<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://livecomposerplugin.com/themes/
 *
 * @package LC Blank
 */

get_header(); ?>

    <?php 
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 

        $fields = get_fields();
    
    ?>

	<div id="sobre">
		<div class="container">
            <header class="sobre-header">
                <div class="row">
                    <div class="col-sm-7 mx-auto">
                        <h1 class="header-title"><?php echo $fields['titulo']; ?></h1>
                        <p class="header-description"><?php echo $fields['descricao']; ?></p>
                    </div>
                </div>
            </header>

            <section class="sobre-nossa-historia sobre-section">
                <div class="row">
                    <div class="col-sm-3">

                    </div>
                    <div class="col-sm-3 mr-auto">
                        <h2 class="section-title">
                            <?php echo $fields['conheca_nossa_historia']; ?>
                        </h2>
                        <div class="section-description">
                        <?php echo $fields['conheca_nossa_historia_-_descricao']; ?>
                        </div>
                    </div>
                    <div class="section-image col-sm-5 col-sm-offset-1">
                        <img src="<?php echo $fields['conheca_nossa_historia_-_imagem']; ?>" class="img-fluid">
                    </div>
                </div>
            </section>
            <section class="sobre-nossa-historia sobre-section">
                <div class="row">
                    <div class="section-image col-sm-5 mr-auto ">
                        <img src="<?php echo $fields['missao_visao_&_valores_-_imagem']; ?>" class="img-fluid">
                    </div>
                    <div class="col-sm-3 col-sm-offset-1 ">
                        <h2 class="section-title">
                            <?php echo $fields['missao_visao_&_valores']; ?>
                        </h2>
                        <div class="section-description">
                            <?php echo $fields['missao_visao_&_valores_-_descricao']; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">

                    </div>
                </div>
            </section>
		</div>

<?php 
$args = array(
    'post_type'      => 'equipe',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
);
$equipe = new WP_Query( $args );

?>

<?php if ( $equipe->have_posts() ) :  

?>

	<section id="equipe" class="section">
		<header class="section-header">
			<h2 class="section-title"><?php echo $fields['nossos_integrantes']; ?></h2>
		</header>

		<div class="section-content">
			<div class="list-horizontal equipe " >
				<div class="list-items list-integrantes " data-list-horizontal>
                    <?php 
                    
                    while ( $equipe->have_posts() ) : $equipe->the_post(); 
					
					?>
					<div class="list-item integrante">
						<div class="integrante-container">
							<div class="integrante-content">
								<div class="integrante-img">
									<?php the_post_thumbnail(); ?>
								</div>

								
							</div>


						</div>
						<div class="integrante-footer">
                            <h2><?php the_title(); ?></h2>
                            <span><?php the_field('cargo'); ?></span>
						</div>
					</div>
                    <?php endwhile; ?> 
					<div class="space"></div>
				</div>
			</div>
		</div>
	</section>

<?php wp_reset_postdata();
endif; ?>
		

	</div>


	<?php endwhile; ?>
	<?php endif; ?>

<?php get_footer(); ?>
