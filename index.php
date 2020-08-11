<?php

// Template name: Página Principal


get_header(); 
?>

<div id="imoveis">
    <!-- loading -->
    <div data-loader>
        <span><?php echo $GLOBALS['campos']['config']['geral']['carregando']; ?></span>
    </div>
    <!-- list -->
	<?php 
        if (have_posts()) : while (have_posts()) : the_post(); 
    ?>


        <div class="d-flex imoveis-list">
            <div class="col-xl-6 col-left">

                <div class="imoveis">
                    <div class="imoveis-container">
                        <div class="row imoveis-row">
                            
                        </div>

                        <div class="imoveis-blank">
                            <img src="<?php echo ASSETS;?>/img/layout/blank-state-imoveis@3x.png">
                            <strong>Não encontrou o que procurava?</strong>
                            <p>Altere as características de busca e tente novamente</p>
                        </div>

                        <div class="p-5">
                            <a href="#" class="btn btn-block btn-primary d-none d-md-none" data-loadmorebtn>Carregar mais</a>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-xl-6 col-right">
                <div id="map"></div>
            </div>
        </div>

	<?php endwhile; ?>
	<?php endif; ?>

</div>           

<?php

wp_enqueue_script('imoveis');
wp_enqueue_script('markerclusterer');
wp_enqueue_script('google-maps');

get_footer(); 

//endif;

?>
