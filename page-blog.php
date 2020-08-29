<?php
/**
 * The template for displaying all pages.
 *
 * @link https://livecomposerplugin.com/themes/
 *
 * @package LC Blank
 */
get_header();

$query->is_archive = 1;

$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	);
	$noticias = new WP_Query( $args );


?>

<?php if($noticias->have_posts()): ?>


<div id="imovel-detalhe" class="container">
    <div class="row">
        <div class="col-sm-9">
            <?php  while($noticias->have_posts()) : $noticias->the_post(); ?>

            <?php 
                get_template_part( 'partials/noticia', 'detail' );
            ?>

            <?php endwhile; ?>


        </div>
        <div class="col-sm-3">
            ads
        </div>
    </div>
</div>


	<?php endif; ?>

<?php
get_footer(); 
?>
