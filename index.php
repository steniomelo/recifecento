<?php

// Template name: Página Principal


get_header(); 
?>

<div class="filtros">
    <div class="container">
    <div class="filters row">
        <div class="filter col-md-6 ">
            <input type="text" class="form-control filter-keyword" placeholder="Digite um termo para buscar">
        </div>

        <div class="filter col-md-2">
            
            <div class="select filter-subcategoria">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Subcategoria
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php

                        // var_dump($wp_query->query); die();
                            $query = $wp_query->query;

                            if($query['category_name']) {
                                $category = get_category_by_slug($query['category_name']);
                                $parent = $category->term_id;
                            } else {
                                $category = get_category_by_slug('comercio');
                                $parent = $category->term_id;
                            }


                            $args = array(
                                'child_of'      => $parent, 
                            ); 

                            $terms = get_terms('category', $args);

                            foreach($terms as $term) {
                                //var_dump($term->name);
                        ?>
                                <a class="dropdown-item" href="#" data-value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter col-md-4">
            <div class="select filter-produto">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filtrar por produto
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php 
                        $produtos = get_posts( array(
                            'post_type'      => 'produtos',
                            'post_status'    => 'publish'
                        ));
                        foreach($produtos as $produto) { ?>
                        <a class="dropdown-item" href="#" data-value="<?php echo $produto->ID; ?>"><?php echo $produto->post_title; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</div>
<div id="imoveis">
    <!-- loading -->
    <div data-loader>
        <span>Carreganndo</span>
    </div>
    <div class="list-horizontal list-noticias ">
			<div class="list-items noticias-items" data-list-horizontal>
				
                <div class="list-item noticia-card">
					<div class="noticia-card__container">
						<div class="noticia-card__content">
							<div class="noticia-card__img">
							</div>

							<div class="noticia-card__details">
                                <span>Comercio - Varejo</span>
                                <div>
                                    <h3>Title of post</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Augue scelerisque orci maecenas quis.</p>
                                </div>
                            </div>
						</div>
					</div>
				</div>
				

				<div class="space"></div>
			</div>
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
