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

                <header class="imoveis-list-header">
                    <h1 class="list-title">
                        <?php echo $title; ?>
                    </h1>

                    <div class="list-filters">
                        <small class="filters-title">
                            <?php echo $GLOBALS['campos']['config']['geral']['busca_rapida']; ?>
                        </small>
                        <hr>
                        <div class="filters mr-auto">
                            <div class="filter filter-valor">
                                <button>
                                    <img src="<?php echo ASSETS;?>/img/icons/valor.svg">
                                    <span class="label"><?php echo $GLOBALS['campos']['config']['geral']['valor']; ?></span>
                                    <span class="value"></span>
                                </button>

                                <div class="filter-box range">
                                    <header class="box-header">
                                        <?php echo $GLOBALS['campos']['config']['geral']['texto_filtro_valor']; ?>
                                    </header>
                                    <div class="range-header">
                                        <div class="range-min">
                                            R$&nbsp;<span>70.000</span>
                                        </div>
                                        <hr>
                                        <div class="range-max">
                                            R$&nbsp;<span>3.000.000</span>
                                        </div>
                                    </div>

                                    <div class="box-content">
                                        <input type="hidden" class="range-value" value="70000,3000000" />
                                    </div>
                                    <footer class="box-footer">
                                        <span class="btn-limpar mr-auto"><?php echo $GLOBALS['campos']['config']['geral']['limpar']; ?></span>
                                        <span class="btn-aplicar"><?php echo $GLOBALS['campos']['config']['geral']['aplicar']; ?></span>
                                    </footer>

                                </div>
                            </div>
                            <div class="filter filter-tamanho">
                                <button>
                                    <img src="<?php echo ASSETS;?>/img/icons/tamanho.svg">
                                    <span class="label"><?php echo $GLOBALS['campos']['config']['geral']['tamanho']; ?></span>
                                    <span class="value"></span>
                                </button>
                                <div class="filter-box range">
                                    <header class="box-header">
                                        <?php echo $GLOBALS['campos']['config']['geral']['texto_filtro_tamanho']; ?>
                                    </header>
                                    <div class="range-header">
                                        <div class="range-min">
                                            <span>20</span>m<small>2</small>
                                        </div>
                                        <hr>
                                        <div class="range-max">
                                            <span>300</span>m<small>2</small>
                                        </div>
                                    </div>

                                    <div class="box-content">
                                        <input type="hidden" class="range-size" value="20,300" />
                                    </div>
                                    <footer class="box-footer">
                                        <span class="btn-limpar mr-auto"><?php echo $GLOBALS['campos']['config']['geral']['limpar']; ?></span>
                                        <span class="btn-aplicar"><?php echo $GLOBALS['campos']['config']['geral']['aplicar']; ?></span>
                                    </footer>

                                </div>
                            </div>
                            <div class="filter filter-quartos">
                                <button>
                                    <img src="<?php echo ASSETS;?>/img/icons/quarto.svg">
                                    <span class="label"><?php echo $GLOBALS['campos']['config']['geral']['quartos']; ?></span>
                                    <span class="value"></span>

                                </button>
                                <div class="filter-box">
                                    <header class="box-header">
                                        <?php echo $GLOBALS['campos']['config']['geral']['texto_filtro_quartos']; ?>
                                    </header>
                                    <div class="box-content radios">
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="quartos" id="quartos1" value="1">
                                            <span class="form-check-label" >1</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="quartos" id="quartos2" value="2">
                                            <span class="form-check-label" for="quartos2">2</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="quartos" id="quartos3" value="3">
                                            <span class="form-check-label" for="quartos3">3</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="quartos" id="quartos4" value="4">
                                            <span class="form-check-label" for="quartos4">4+</span>
                                        </label>
                                    </div>
                                    <footer class="box-footer">
                                        <span class="btn-limpar mr-auto"><?php echo $GLOBALS['campos']['config']['geral']['limpar']; ?></span>
                                        <span class="btn-aplicar"><?php echo $GLOBALS['campos']['config']['geral']['aplicar']; ?></span>
                                    </footer>

                                </div>
                            </div>
                            <div class="filter filter-vagas">
                                <button>
                                    <img src="<?php echo ASSETS;?>/img/icons/vaga.svg">
                                    <span class="label"><?php echo $GLOBALS['campos']['config']['geral']['vagas']; ?></span>
                                    <span class="value"></span>

                                </button>
                                <div class="filter-box">
                                    <header class="box-header">
                                        <?php echo $GLOBALS['campos']['config']['geral']['texto_filtro_vagas']; ?>
                                    </header>
                                    <div class="box-content radios">
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="vagas" id="vagas1" value="0">
                                            <span class="form-check-label" for="vagas1">Sem vagas</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="vagas" id="vagas2" value="1">
                                            <span class="form-check-label" for="vagas2">1</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="vagas" id="vagas3" value="2">
                                            <span class="form-check-label" for="vagas3">2</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="vagas" id="vagas4" value="3">
                                            <span class="form-check-label" for="vagas4">3+</span>
                                        </label>
                                    </div>
                                    <footer class="box-footer">
                                        <span class="btn-limpar mr-auto"><?php echo $GLOBALS['campos']['config']['geral']['limpar']; ?></span>
                                        <span class="btn-aplicar"><?php echo $GLOBALS['campos']['config']['geral']['aplicar']; ?></span>
                                    </footer>

                                </div>
                            </div>
                        </div>
                        <small class="limpar-filtros" data-filtered>
                            <?php echo $GLOBALS['campos']['config']['geral']['limpar_filtros']; ?>
                        </small>

                    </div>

                    <div class="list-subheader">
                        <div class="mr-auto listItemTotal">
                            <span data-total>Achamos <strong class="totalImoveis">0</strong> <?php echo $GLOBALS['campos']['config']['geral']['imoveis_com_essas_caracteristicas']; ?></span>
                            <span data-error></span>
                        </div>
                        
                        <div class="list-order">
                            <label for=""><?php echo $GLOBALS['campos']['config']['geral']['ordernar_por']; ?></label>
                            <div class="select filter-ordenacao">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo $GLOBALS['campos']['config']['geral']['selecione']; ?>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" data-value="PMAX"><?php echo $GLOBALS['campos']['config']['geral']['mario_preco']; ?></a>
                                        <a class="dropdown-item" href="#" data-value="PMIN"><?php echo $GLOBALS['campos']['config']['geral']['menor_preco']; ?></a>
                                    </div>
                                </div>
                                <!-- <select name="" id="">
                                    <option value="">Mais acessados</option>
                                </select> -->
                            </div>
                        </div>
                    </div>
                </header>

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
