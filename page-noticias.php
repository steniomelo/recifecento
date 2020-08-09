<?php
/**
 * Template Name: Notícias

 */

get_header(); 

	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 5,
	);
	$noticias = new WP_Query( $args );

	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'offset'		=> 5
	);
	$noticias_semimagem = new WP_Query( $args );
?>

<?php if ( $noticias->have_posts() ) :  ?>

<section id="noticias" class="section list-noticias mobile ">

	<div class="section-content">
		<div >
			
			<div class="lists">
				<div class="list-items">
					<?php 
						while ( $noticias->have_posts() ) : $noticias->the_post(); 
					?>
						<?php 
							get_template_part( 'partials/noticia', 'card' );
						?>
					<?php endwhile; 
					wp_reset_postdata(); ?>

					
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
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<?php get_footer(); ?>