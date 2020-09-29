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
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    style="float: right; padding-right: 13em;">
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
                    <button style="float: right;padding-right: 24em;" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filtrar por produto
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php 
                        $produtos = get_posts( array(
                            'post_type'      => 'produtos',
                            'post_status'    => 'publish',
                            'posts_per_page' => -1
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
        <span>...</span>
    </div>
    <div class="list-horizontal list-noticias ">
			<div class="list-items noticias-items" data-list-horizontal>

                <?php 

                $query = get_queried_object();

                function getCategory($query) {
                    if($query) {
                        return $query->slug;
                    } else {
                        return 'varejo';
                    }
                }

                $posts = new WP_Query(array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 6,
                    'category_name' => getCategory($query),
                ));
                foreach($posts->posts as $post) { 
                
                setup_postdata($post);
                
                ?>
				
                <?php 
                    get_template_part( 'partials/noticia', 'card' );
                ?>

                <?php } ?>
                
                <?php wp_reset_postdata(); ?>
                
				<div class="space"></div>
			</div>
		</div>

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

                    </div>
                </div>
                
                <div class="p-5 col-sm-5 mx-auto ">
                    <a href="#" class="btn btn-block btn-danger d-none" data-loadmorebtn>Carregar mais</a>
                </div>

            </div>
            
            <div class="col-xl-6 col-right">
                <div id="map"></div>
            </div>
        </div>

</div>           
<?php
wp_enqueue_script('imoveis');
wp_enqueue_script('markerclusterer');
wp_enqueue_script('google-maps');

get_footer(); 

//endif;
?>
