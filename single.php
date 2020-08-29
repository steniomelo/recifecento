<?php
/**
 * The template for displaying all pages.
 *
 * @link https://livecomposerplugin.com/themes/
 *
 * @package LC Blank
 */
get_header();
?>

<?php if(have_posts()): while(have_posts()) : the_post(); ?>

<div id="imovel-detalhe" class="container">
    <div class="row">
        <div class="col-sm-9">
            <?php 
                get_template_part( 'partials/noticia', 'detail' );
            ?>
        </div>
        <div class="col-sm-3">
            ads
        </div>
    </div>
</div>


	<?php endwhile; ?>
	<?php endif; ?>

<?php
get_footer(); 
?>
