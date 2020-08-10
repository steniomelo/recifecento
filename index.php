<?php
// if(isset($_GET['json'])) :

//     header('Content-type: application/json');

// endif;

// $apitoken = APITOKEN;
// $qtdImoveis = 6;

switch (get_query_var('imoveis_cat')) {
    case 'lancamentos':
        $title = 'Lançamentos';
        break;
    case 'em-construcao':
        $title = "Em Construção";
        break;
    case 'pronto':
        $title = "Pronto para morar";
        break;
    case 'litoral':
        $title = "Litoral";
        break;
    case 'empresarial':
        $title = "Empresarial";
        break;
    case 'minha-casa-minha-vida':
        $title = "Minha Casa Minha Vida";
        break;
    case 'busca':
        $title = "Resultado da busca";
        break;
    default: 
        $title = "Resultado da busca";
        break;
}

// if(isset($_GET['json'])) :

//     $imoveis = listarImoveis($filtro);
//     echo json_encode($imoveis);

// endif;

// if(!isset($_GET['json'])) :

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

        <?php
            //$imoveisTotal = 0;
            // $imoveis = listarImoveis($filtro);
            //$imoveisTotal = totalImoveis($filtro);
        ?>

        <div class="d-flex imoveis-list">
            <div class="col-lg-7 col-left">


                <div class="imoveis">
                    <div class="imoveis-container">
                        <div class="row imoveis-row">
                            <?php
                            //foreach($imoveis as $imovel) {  ?>
                                <!-- <div class="col-sm-6">
                                    <?php 
                                        // set_query_var( 'imovel', $imovel );
                                        // get_template_part( 'partials/imovel', 'card' );
                                    ?>
                                </div> -->
                            <?php //} ?>
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
            <div class="col-lg-5 col-right">
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
