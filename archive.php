<?php

// Template name: Página Principal

get_header();
?>


<div class="filtros">
    <div class="container">
    <div class="filters row">
        <div class="filter col-md-6 filter-keyword " style="position:relative">
            <input type="text" class="form-control filter-keyword" placeholder="Digite um termo para buscar">
            <button class="filter-btn" style="position:absolute; right: 15px; top:0px; border: 0; padding: 10px; background: none; width: auto; min-width: auto; color: #e3072a" ><i class="fas fa-search " ></i></button>
        </div>

        <div class="filter col-md-2">

            <div class="select filter-subcategoria">
                <div class="dropdown">
                    <?php

                        $query = $wp_query->query;

                        if($query['category_name']) {
                            $category = get_category_by_slug($query['category_name']);
                            $parent = $category->term_id;
                        } else {
                            $category = get_category_by_slug('varejo');
                            $parent = $category->term_id;
                        }

                        $args = array(
                            'child_of'      => $parent,
                        );

                        $terms = get_terms('category', $args);

                        if(!empty($terms)) :
                    ?>
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    >
                        Subcategoria
                    </button>
                    <?php else : ?>
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled="disabled"
                    >
                        Subcategoria
                    </button>
                    <?php endif; ?>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-autocomplete">
                            <input type="text" placeholder="Filtrar" class="filter-autocomplete">
                        </div>

                        <div class="dropdown-list">
                        <?php

                        // var_dump($wp_query->query); die();


                            foreach($terms as $term) {
                                //var_dump($term->name);
                        ?>
                                <a class="dropdown-item" href="#" data-value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter col-md-4">
            <div class="select filter-produto">
                <div class="dropdown">
                    <?php if(!is_category("turismo") && !is_category("gastronomia") && !is_category("mobilidade")) : ?>
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                            Filtrar por produto
                        </button>
                    <?php else : ?>
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled="disabled" >
                            Filtrar por produto
                        </button>
                    <?php endif; ?>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-autocomplete">
                            <input type="text" placeholder="Filtrar" class="filter-autocomplete">
                        </div>

                        <div class="dropdown-list">
                            <?php
                            $produtos = get_posts( array(
                                'post_type'      => 'produtos',
                                'post_status'    => 'publish',
                                'posts_per_page' => -1,
                                'orderby' => 'title',
                                'order' => 'ASC'
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
</div>

<a href="http://bit.ly/ZAPSITE" target="_blank">
<?php echo do_shortcode("[wp1s id='10569']"); ?>
</a>


<div id="destaques" data-destaque-slider>
 <?php
    $destaques = get_posts( array(
        'post_type'      => 'destaques',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    ));
    foreach($destaques as $destaque) { ?>

            <div class="destaque">
                <?php
                $image = get_field('imagem_desktop', $destaque->ID);
                $image_mobile = get_field('imagem_mobile', $destaque->ID);

                if( !empty( $image ) ): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-100 d-none d-sm-block" />
                <?php endif;
                if( !empty( $image_mobile ) ): ?>
                    <img src="<?php echo esc_url($image_mobile['url']); ?>" alt="<?php echo esc_attr($image_mobile['alt']); ?>" class="w-100 d-block d-sm-none" />
                <?php else: ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="w-100 d-block d-sm-none" />

                <?php endif; ?>
            </div>

    <?php } ?>
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
                            <p>No centro tem. Refaça a sua pesquisa!</p>
                        </div>

                    </div>
                </div>

                <div class="p-5 col-sm-5 mx-auto ">
                    <a href="#" class="btn btn-block btn-danger d-none" data-loadmorebtn>Carregar mais</a>
                </div>

            </div>

            <div class="col-xl-6 col-right">
                <div class="col-right-apoio"></div>

                <div class="col-right-content">
                    <div id="map"></div>
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- Mapa -->
                    <ins class="adsbygoogle"
                        style="display:block"
                        data-ad-client="ca-pub-4672816343502215"
                        data-ad-slot="4810790669"
                        data-ad-format="auto"
                        data-full-width-responsive="true"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
            </div>
        </div>

        <div class="depoimentos text-center ">
            <div class="container">
            <h2 class="depoimentos__titulo">Depoimentos</h2>
            <br>
            <?php echo do_shortcode('[sp_testimonial id="3084"]'); ?>

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
