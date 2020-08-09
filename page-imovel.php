<?php
/**
 * The template for displaying all pages.
 *
 * @link https://livecomposerplugin.com/themes/
 *
 * @package LC Blank
 */
get_header();

$my_slug = get_query_var('imovel_id');

$args = array(
  'name' => $my_slug,
  'post_type' => 'properties',
  'post_status' => 'publish',
  'posts_per_page' => 1
);

$imovel = get_posts($args);
$photo = get_field('properties_photo_cover', $imovel[0]->ID);
$photos_extras = json_decode(get_field('properties_photo', $imovel[0]->ID));
//the_field('properties_builders', $imovel[0]->ID);
?>
        <!-- <pre>
            <?php //print_r($imovel); ?>
        </pre> -->
<div id="imovel-detalhe">
    <header class="imovel-header">
        <div class="container">
            <div class="imovel-title mr-auto">
                <h2 class="imovel-bairro">
                    <?php 
                        $explode_neighborhood = explode('-', get_field('properties_neighborhood', $imovel[0]->ID));
                        echo $explode_neighborhood[0];
                    ?>
                </h2>
                <h3 class="imovel-nome">
                    <?php echo get_field('properties_name', $imovel[0]->ID); ?>
                </h3>
            </div>

            <!-- <div class="imovel-construtora d-none d-sm-block">
                <small>Queiroz Galvão</small>
            </div> -->

            <div class="imovel-price">
                <hr class="d-none d-sm-block">
                <small>A partir de</small>
                <strong class="price">
                    <small class="price-cifrao">R$</small>
                    <span class="price-valor"><?php echo number_format(get_field('properties_price', $imovel[0]->ID), 2, ',', '.'); ?></span>
                </strong>
            </div>

            <a href="#vamosnegociar" class="imovel-btn d-none d-sm-flex">
                <span>Vamos negociar</span>
                <i class="arrow-hover"></i>
            </a>
        </div>
    </header>
    
    <div class="imovel-destaque tab-content">
        <?php if ($photos_extras): ?>
            <div 
                class="tab-pane fade show active" 
                id="imovel-galeria" 
                role="tabpanel" 
            >
                <span class="arrow arrow-prev">
                    <img src="<?php echo ASSETS;?>/img/icons/arrow-slider.svg">
                </span>


                <div class="imovel-galeria" data-destaque-galeria>
                    <?php 
                        foreach ($photos_extras->Foto as $gallery): 
                            if ($gallery->FotoDestaque == 0):
                    ?>
                    <div 
                        class="galeria-foto" 
                        data-lazy="<?php echo $gallery->URLArquivo; ?>" style="background-image: url('<?php echo $gallery->URLArquivo; ?>')">
                    </div>
                    <?php
                        endif; 
                        endforeach; 
                    ?>
                </div>
                <span class="arrow arrow-next">
                    <img src="<?php echo ASSETS;?>/img/icons/arrow-slider.svg">
                </span>
            </div>
        <?php endif; ?>

        <div 
            class="tab-pane fade <?php echo !$photo ? 'show active' : ''; ?>" 
            id="imovel-mapa" 
            role="tabpanel" 
            aria-labelledby="profile-tab"
        >
            <div id="mapa"></div>
        </div>

        <div 
            class="tab-pane fade" 
            id="imovel-streetview" 
            role="tabpanel" 
            aria-labelledby="contact-tab"
        >
            <div id="street-view"></div>
        </div>
    </div>

    <div class="imovel-container container">
        <div class="row">
            <div class="col-sm-7">

                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <?php if ($photos_extras): ?>
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#imovel-galeria" role="tab" aria-controls="pills-home" aria-selected="true">
                            <img src="<?php echo ASSETS;?>/img/icons/camera.svg" alt="">
                            <?php echo $GLOBALS['campos']['config']['geral']['fotografias']; ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo !$photo ? 'active' : ''; ?>" id="pills-profile-tab" data-toggle="pill" href="#imovel-mapa" role="tab" aria-controls="pills-profile" aria-selected="false">
                            <img src="<?php echo ASSETS;?>/img/icons/map.svg" alt="">
                            <?php echo $GLOBALS['campos']['config']['geral']['localizacao']; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link vizinhanca" id="pills-contact-tab" data-toggle="pill" href="#imovel-streetview" role="tab" aria-controls="pills-contact" aria-selected="false">
                            <img src="<?php echo ASSETS;?>/img/icons/tree.svg" alt="">
                            <?php echo $GLOBALS['campos']['config']['geral']['vizinhanca']; ?>
                        </a>
                    </li>
                </ul>

                <div class="imovel-content">
                    
                    <header class="content-header">
                        <div class="content-title">
                            <h1><?php echo get_field('properties_name', $imovel[0]->ID); ?></h1>
                            <p><?php echo get_field('properties_address', $imovel[0]->ID); ?>&nbsp;-&nbsp;<?php echo get_field('properties_neighborhood', $imovel[0]->ID); ?></p>
                        </div>
                    </header>

                    <div class="imovel-info">
                        <?php if (get_field('properties_size', $imovel[0]->ID)): ?>
                        <div class="info info-tamanho">
                            <img src="<?php echo ASSETS;?>/img/icons/tamanho.svg" />
                            <small><?php echo get_field('properties_size', $imovel[0]->ID); ?></small>
                        </div>
                        <?php endif; ?>

                        <?php if (get_field('properties_room', $imovel[0]->ID)): ?>
                        <div class="info info-quartos">
                            <img src="<?php echo ASSETS;?>/img/icons/quarto.svg">
                            <small><?php echo get_field('properties_room', $imovel[0]->ID); ?></small>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (get_field('properties_toilet', $imovel[0]->ID)): ?>
                        <div class="info info-banheiros">
                            <img src="<?php echo ASSETS;?>/img/icons/banheiro.svg">
                            <small><?php echo get_field('properties_toilet', $imovel[0]->ID); ?></small>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (get_field('properties_vacancy', $imovel[0]->ID)): ?>
                        <div class="info info-vagas">
                            <img src="<?php echo ASSETS;?>/img/icons/vaga.svg">
                            <small><?php echo get_field('properties_vacancy', $imovel[0]->ID); ?></small>
                        </div>
                        <?php endif; ?>
                        
                        <!-- <?php if($imovel->temEspacoGourmet) { ?>
                            <div class="info">
                                <img src="<?php echo ASSETS;?>/img/icons/gourmet.svg">
                                <small>Gourmet</small>
                            </div>
                        <?php } ?>
                        <?php if($imovel->temArcondicionadoSplit) { ?>
                            <div class="info">
                                <img src="<?php echo ASSETS;?>/img/icons/split.svg">
                                <small>Air Split</small>
                            </div>
                        <?php } ?> -->
                    </div>

                    <div class="imovel-description">
                        <h2>Empreendimento</h2>

                        <p class="description"><?php echo $imovel[0]->post_content; ?></p>

                        <div class="imovel-more-info">
                            <?php 
                                $icons = get_field('properties_features', $imovel[0]->ID);
                                foreach((array) $icons as $icon):
                                    $features_icon = get_field('features_icon', $icon->ID)['url'];
                            ?>
                                <div class="info">
                                    <img src="<?php echo $features_icon; ?>" />
                                    <small><?php echo $icon->post_title; ?></small>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>

            <div id="vamosnegociar" class="col-sm-5 sidebar" data-codigo="<?php echo $my_slug; ?>">
                <div class="vamosnegocias-form">
                    <div class="vamosnegocias-header">
                        <h2>
                            <?php if (qtrans_getLanguage() == 'pb'): ?>
                                Confira nossa condições especiais
                            <?php else: ?>
                                Check out our special conditions
                            <?php endif; ?>
                        </h2>
                        <p>
                            <?php if (qtrans_getLanguage() == 'pb'): ?>
                                Entre em contato e teremos prazer em atendê-lo (a)
                            <?php else: ?>
                                Contact us and we will be happy to assist you
                            <?php endif; ?>
                        </p>
                        <ul class="simulation-tabs">
                            <li class="current">
                                <a>
                                    <div class="icon">
                                        <svg width="21" height="21" viewBox="0 0 21 21">
                                            <path fill="#3D4345" fill-rule="nonzero" stroke="#3D4345" stroke-width=".635" d="M20.07 15.01a.878.878 0 0 1-.375.085.919.919 0 0 1-.695-.333l-2.275-2.605h-2.569v.308c0 2.596-1.841 4.707-4.105 4.707H4.96L2.685 19.78a.924.924 0 0 1-.696.332.878.878 0 0 1-.38-.087c-.37-.176-.608-.586-.608-1.045v-8.937c0-2.596 1.842-4.707 4.106-4.707H7.53v-.31C7.53 2.431 9.37.319 11.635.319h4.943c2.263 0 4.105 2.112 4.105 4.707v8.936c0 .462-.24.873-.612 1.048zM4.973 6.917c-1.511 0-2.74 1.405-2.74 3.131v7.864l1.724-1.97a.929.929 0 0 1 .702-.332h5.29c1.51 0 2.74-1.405 2.74-3.132v-2.43c0-1.727-1.23-3.131-2.74-3.131H4.972zm14.173-1.895c0-1.727-1.229-3.132-2.74-3.132H11.43c-1.51 0-2.74 1.405-2.74 3.132v.31h1.146c2.279 0 4.133 2.12 4.133 4.725v.53h2.752c.265 0 .514.117.701.33l1.724 1.969V5.022zM7.531 13.41c.737-.131 1.152-.63 1.152-1.214 0-.592-.306-.953-1.075-1.228-.549-.21-.773-.348-.773-.565 0-.184.136-.368.555-.368.465 0 .763.152.93.224l.19-.742c-.213-.106-.513-.197-.93-.217v-.58h-.64v.625c-.689.138-1.092.591-1.092 1.169 0 .637.47.965 1.16 1.202.478.164.685.322.685.571 0 .262-.251.407-.62.407-.418 0-.798-.138-1.069-.289l-.19.768c.244.145.66.263 1.102.283v.616h.615v-.662z"/>
                                        </svg>
                                    </div>
                                    <span>
                                        <?php if (qtrans_getLanguage() == 'pb'): ?>
                                            Quero Fazer uma Proposta
                                        <?php else: ?>
                                            I want to make a proposal
                                        <?php endif; ?>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <div class="icon">
                                        <svg width="22" height="20" viewBox="0 0 22 20">
                                            <path fill="#3D4345" fill-rule="nonzero" d="M10.753 2.489c-1.93 0-3.493 1.591-3.493 3.554 0 1.963 1.564 3.555 3.493 3.555 1.93 0 3.494-1.592 3.494-3.555S12.683 2.49 10.753 2.49zm.287 5.589v.662h-.614v-.617c-.443-.02-.858-.137-1.103-.282l.19-.768c.272.15.651.288 1.07.288.368 0 .62-.144.62-.406 0-.25-.208-.407-.685-.572-.691-.236-1.16-.564-1.16-1.202 0-.577.403-1.03 1.092-1.168v-.625h.639v.58c.418.02.718.111.93.216l-.189.742c-.168-.072-.466-.223-.93-.223-.42 0-.556.184-.556.367 0 .217.225.355.774.565.769.276 1.074.637 1.074 1.228 0 .585-.414 1.084-1.152 1.215zm7.17 4.99h1.346c.762 0 1.457-.294 1.983-.776v1.716c0 1.107-.894 2.01-1.983 2.01H1.982c-.476 0-1.015-.226-1.27-.45-.319-.28-.712-.945-.712-1.56v-1.39h.423c.47.292 1.013.45 1.56.45h1.283c.36.414.661.902.866 1.45h13.26a4.644 4.644 0 0 1 .817-1.45zm0 3.952h1.346c.762 0 1.457-.294 1.983-.775v1.715c0 1.108-.894 2.011-1.983 2.011H1.982c-.476 0-1.015-.226-1.27-.45-.319-.28-.712-.945-.712-1.56V16.57h.423c.47.292 1.013.45 1.56.45h1.283c.36.414.661.902.866 1.45h13.26a4.636 4.636 0 0 1 .817-1.45zM19.555.036c1.089 0 1.983.88 1.983 1.986v8.03c0 1.106-.894 2.015-1.983 2.015H1.982c-.476 0-1.015-.227-1.27-.45-.32-.283-.712-.95-.712-1.566V2.022C0 .916.894.036 1.982.036h17.574zm-2.165 10.53c.48-1.376 1.517-2.348 2.674-2.77V4.288c-1.181-.406-2.185-1.326-2.662-2.777H4.123c-.488 1.376-1.516 2.327-2.648 2.751v3.564a4.788 4.788 0 0 1 2.657 2.74h13.26z"/>
                                        </svg>
                                    </div>
                                    <span>
                                        <?php if (qtrans_getLanguage() == 'pb'): ?>
                                            Quero Simular um Financiamento
                                        <?php else: ?>
                                            I want to Simulate a Funding
                                        <?php endif; ?>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php 
                        if (qtrans_getLanguage() == 'pb'):
                            // Proposta PT
                            echo do_shortcode('[ninja_form id=1]');
                            echo do_shortcode('[ninja_form id=6]');
                        else:
                            // Proposta EN
                            echo do_shortcode('[ninja_form id=5]');
                            echo do_shortcode('[ninja_form id=7]');
                        endif;
                     ?>
                    <a href="<?php echo get_page_link(159); ?>" class="talk_broker">
                        <?php if (qtrans_getLanguage() == 'pb'): ?>
                            Quero Atendimento
                        <?php else: ?>
                            I want service
                        <?php endif; ?>
                    </a>
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
<?php endif; ?>
<script>

var latLng;

function init() {


    $.ajax({
        url: 'https://maps.google.com/maps/api/geocode/json?key=<?php echo GOOGLE_API; ?>&address=<?php echo get_field("properties_address", $imovel[0]->ID); ?>+<?php echo get_field("properties_neighborhood", $imovel[0]->ID); ?>',
        type: 'GET',
        success: function(response) {

            if(response.status == 'OK')
            latLng = response.results[0].geometry.location;


            //console.log(latLng);
            initMap();
            //streetView();
        }
    })
}

var panorama;
function streetView() {
    panorama = new google.maps.StreetViewPanorama(
    document.getElementById('street-view'),
    {
        position: latLng,
        pov: {heading: 165, pitch: 0},
        zoom: 1
    });
}

function initMap() {
    //console.log(latLng);
    var myLatLng = latLng;

    // Create a map object and specify the DOM element
    // for display.
    var map = new google.maps.Map(document.getElementById('mapa'), {
    center: myLatLng,
    zoom: 16
    });

    // Create a marker and set its position.
    var marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
    });

    // var panorama = new google.maps.StreetViewPanorama(
    // document.getElementById('street-view'),
    // {
    //     position: latLng,
    //     pov: {heading: 165, pitch: 10},
    //     zoom: 2
    // });
    //map.setStreetView(panorama);
}

</script>


<?php
wp_enqueue_script('google-maps');
wp_enqueue_script('imovel-detalhe');
get_footer(); 
?>
