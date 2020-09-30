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
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Single Post -->
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-4672816343502215"
                    data-ad-slot="8531038660"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
        </div>
    </div>
</div>


	<?php endif; ?>

<?php
get_footer(); 
?>
