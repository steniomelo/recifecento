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
