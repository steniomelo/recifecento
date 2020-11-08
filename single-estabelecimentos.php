<?php
/**
 * The template for displaying all pages.
 *
 * @link https://livecomposerplugin.com/themes/
 *
 * @package LC Blank
 */
get_header();


$photo = get_field('properties_photo_cover', $imovel[0]->ID);
$photos_extras = json_decode(get_field('properties_photo', $imovel[0]->ID));
?>

<?php if(have_posts()): while(have_posts()) : the_post(); ?>

<?php 

    $imovel = [
        'horarios' => get_field('horario_de_funcionamento', $post->ID),
        'endereco' => get_field('endereco', $post->ID),
        'telefone' => get_field('telefone', $post->ID),
        'site' => get_field('site', $post->ID),
        'estacionamentos' => get_field('estacionamentos'),
        'estacionamento_destacado' => get_field('estacionamento_destacado'),
        'produtos' => get_field('produtos'),
    ];

    $estacionamento_destacado = get_field('endereco', $imovel['estacionamento_destacado'][0]->ID );
    $categoria = get_the_category();
    $categoria_pai = get_category_parents($categoria[0]->term_id);
?>

<div id="imovel-detalhe" class="container">
    <header class="imovel-header">
        <div class="row no-gutters">
            <div class="col-sm-6 imovel-header__details">
                <div class="imovel-header__tags">
                    <?php if(get_field('recomendado', $post->ID)) : ?>
                    <span class="tags__recomendado recomendado">
                        <img src="<?php echo ASSETS;?>/img/icons/star.svg" class="recomendado__icon">
                        Recomendado
                    </span>
                    <?php endif; ?>

                    <div class="tags__categoria">
                        <?php echo $categoria[0]->name; ?>
                    </div>
                </div>
                <div class="imovel-header__title">
                    <?php the_title(); ?>
                </div>

                <div class="imovel-header__dots">

                </div>
                <div class="imovel-header__details-photos" data-destaque-galeria>
                    <div class="photo">
                        <?php the_post_thumbnail(array(567,304)); ?>
                    </div>
                    <?php if( have_rows('imagens') ): ?>
                        <?php while( have_rows('imagens') ): the_row(); 

                            // Get sub field values.
                            $image1 = get_sub_field('imagem_1');
                            $image2 = get_sub_field('imagem_2');
                            $image3 = get_sub_field('imagem_3');
                            $image4 = get_sub_field('imagem_4');

                            ?>
                            
                            <?php if($image1) : ?>
                                <div class="photo">
                                <?php echo wp_get_attachment_image( $image1, array(567,304)); ?>
                                </div>
                            <?php endif; ?>
                            <?php if($image2) :  ?>
                                <div class="photo">
                                    <?php echo wp_get_attachment_image( $image2, array(567,304) ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if($image3) : ?>
                                <div class="photo">
                                    <?php echo wp_get_attachment_image( $image3, array(567,304) ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if($image4) : ?>
                                <div class="photo">
                                    <?php echo wp_get_attachment_image( $image4, array(567,304) ); ?>
                                </div>
                            <?php endif; ?>

                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-6 imovel-header__map">
                <div class="map-buttons">
                    <div class="buttons">
                        <a href="https://www.google.com.br/maps/place/<?php echo $estacionamento_destacado['address'] ?>" class="btn btn-danger">Ir ao estacionamento</a>
                        <a href="https://www.google.com.br/maps/place/<?php echo $imovel['endereco']['address']; ?>" class="btn btn-danger">Ir ao local</a>
                    </div>
                </div>
                <div id="mapa"></div>
            </div>
        </div>
    </header>


    <div class="imovel-container">
        <div class="row">
            <div class="col-sm-5">

                <div class="imovel-content">
                    
                    

                    <div class="imovel-description">
                        <h4>Informações</h4>

                            <div class="imovel-aberto ml-auto widget-abertofechado <?php echo strtolower(isAberto($imovel['horarios']))?>"><?php echo isAberto($imovel['horarios']) ?></div>


                        <p class="description"><?php the_content(); ?></p>

                        <p>
                            <?php
                                $posttags = get_the_tags();
                                if ($posttags) {
                                foreach($posttags as $tag) {
                                    echo '<span class="badge badge-pill badge-danger " style="font-size:12px; font-weight:normal" href="'.get_site_url().'/">#'.$tag->name . '</span> '; 
                                }
                                }
                            ?>
                        </p>

                        <div class="imovel-info">

                        


                        <?php if (!empty($imovel['horarios']['dias_da_semana'])): ?>
                            <div class="info info-horario">
                                <img src="<?php echo ASSETS;?>/img/icons/calendar.svg" />
                                <small><?php echo formatarHorarios($imovel['horarios']); ?></small>
                            </div>
                        <?php endif; ?>

                        

                        <?php if ($imovel['endereco']): ?>
                        <div class="info info-endereco">
                            <img src="<?php echo ASSETS;?>/img/icons/pin.svg" />
                            <small><?php echo $imovel['endereco']['address']; ?></small>
                        </div>
                        <?php endif; ?>

                        <?php if ($imovel['telefone']): ?>
                        <div class="info info-telefone">
                            <img src="<?php echo ASSETS;?>/img/icons/phone.svg" />
                            <small><?php echo $imovel['telefone']; ?></small>
                        </div>
                        <?php endif; ?>

                        <?php if ($imovel['site']): ?>
                        <div class="info info-site">
                            <img src="<?php echo ASSETS;?>/img/icons/site.svg" />
                            <small><?php echo $imovel['site']; ?></small>
                        </div>
                        <?php endif; ?>
                        
                        
                    </div>

                        <div class="imovel-more-info">
                            <?php
                            if( $imovel['estacionamentos'] ): ?>
                            <div>
                                <h4>Estacionamentos mais próximos</h4>
                            </div>
                            <br>


                            <div class="estacionamentos">
                                <?php foreach( $imovel['estacionamentos'] as $post ): 

                                    // Setup this post for WP functions (variable must be named $post).
                                    setup_postdata($post); ?>

                                    <div class="estacionamento">
                                        <div class="mb-3"><img src="<?php echo ASSETS;?>/img/icons/estacionamento.svg" /></div>
                                        <h5><?php the_title();?></h5>
                                        <p><?php the_content(); ?></p>
                                        <a href="<?php the_permalink(); ?>">Ir até estacionamento</a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php 
                            // Reset the global post object so that the rest of the page works correctly.
                            wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </div>

                    </div>


                    

                    
                </div>
            </div>

            <div class="col-sm-6 ml-sm-5 imovel-produtos">
                <?php if( $imovel['produtos'] ): ?>
                <h4>Produtos / Serviços</h4>

                

                            <div class="produtos row">
                                <?php foreach( $imovel['produtos'] as $post ): 

                                    // Setup this post for WP functions (variable must be named $post).
                                    setup_postdata($post); ?>
                                    <div class=" col-sm-3">
                                    <div class="produto">
                                        <div class="produto-thumbnail">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </div>
                                        <div class="produto-title">
                                            <h5><?php the_title();?></h5>
                                        </div>
                                    </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php 
                            // Reset the global post object so that the rest of the page works correctly.
                            wp_reset_postdata(); ?>
                            <?php endif; ?>

                <br>
                <br>
                 <h4>Este estabelecimento é seu?</h4> <p> <a href="#contato">Entre em contato</a> para editar informações ou remover as informações da plataforma.</p>
                                     <div>
                        <small><?php display_last_updated_date() ;?></small>
                       
                    </div>

            </div>


        </div>
    </div>
</div>

<?php 
    $similares = get_field('properties_related', $imovel[0]->ID);
    if ($similares):
?>
<section id="imoveis-similares" class="section list-similares">

    <div class="section-content">
        <div class="list-horizontal" >
            <div class="list-items list-imoveis" data-list-horizontal>
                <header class="section-header">
                    <h2 class="section-title">Similares</h2>
                </header>
                <?php 
                    foreach($similares as $similar): 
                        set_query_var('similar', $similar);
                        get_template_part( 'partials/imovel', 'card' );
                    endforeach;
                ?>
                <div class="space"></div>
            </div>
        </div>
    </div>
</section>
<?php endif; 

$endereco = get_field('endereco');

?>

<script>

function init() {
    initMap();

}

function initMap() {
    let location = {
        'lat': <?php echo $endereco['lat']; ?>,
        'lng': <?php echo $endereco['lng']; ?>
    }

    let assets = '<?php echo ASSETS ?>';

    console.log('assets', assets);

    // Create a map object and specify the DOM element
    // for display.
    var map = new google.maps.Map(document.getElementById('mapa'), {
        center: location,
        zoom: 16,
        disableDefaultUI: true
    });

    // Create a marker and set its position.
    var marker = new google.maps.Marker({
        map: map,
        position: location,
        icon: assets + "/img/layout/m1.png",
    });


}

</script>

	<?php endwhile; ?>
	<?php endif; ?>

<?php
wp_enqueue_script('google-maps');
wp_enqueue_script('imovel-detalhe');
get_footer(); 
?>
