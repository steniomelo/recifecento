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

<?php 

    $imovel = [
        'horarios' => get_field('horario_de_funcionamento', $post->ID),
        'endereco' => get_field('endereco', $post->ID),
        'telefone' => get_field('telefone', $post->ID),
    ];

?>

<div id="imovel-detalhe" class="container">
    <header class="imovel-header">
        <div class="row no-gutters">
            <div class="col-sm-6 imovel-header__details">
                
                <div class="imovel-header__title">
                    <?php the_title(); ?>
                </div>

                <div class="imovel-header__dots">

                </div>
                <div class="imovel-header__details-photos" data-destaque-galeria>
                    <div class="photo">
                        <?php the_post_thumbnail(array(567,304)); ?>
                    </div>
                    
                </div>
            </div>
            <div class="col-sm-6 imovel-header__map">
                <div class="map-buttons">
                    <div class="buttons">
                        <a href="https://www.google.com.br/maps/place/<?php echo $imovel['endereco']['address'] ?>" class="btn btn-danger">Ir ao estacionamento</a>
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

                        <div class="imovel-aberto ml-auto <?php echo strtolower(isAberto($imovel['horarios']))?>"><?php echo isAberto($imovel['horarios']) ?></div>


                        <p class="description"><?php the_content(); ?></p>

                        <div class="imovel-info">

                        


                        <?php if (!empty($imovel['horarios'])): ?>
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

                        

                    </div>

                    

                    
                </div>
            </div>

            <div class="col-sm-6 ml-sm-5 imovel-produtos">
                
            </div>


        </div>
    </div>
</div>

<?php 

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
