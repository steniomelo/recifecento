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

    <div class="list-horizontal list-estabelecimentos ">
        <div class="list-items estabelecimentos-items" data-list-horizontal>

            <?php
                $estabelecimentos = get_field('estabelecimentos');

                $estabelecimentos_html = get_estabelecimentos_acf($estabelecimentos);

                foreach($estabelecimentos_html as $estabelecimento) :

                //foreach( $estabelecimentos as $post ):
                
                //setup_postdata($post); 

                echo $estabelecimento;
                endforeach; 


            ?>
            <div class="space"></div>
        </div>
    </div>

	<?php endwhile; ?>
	<?php endif; ?>

<?php
get_footer(); 
?>
