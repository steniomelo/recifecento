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
?>

<div id="imovel-detalhe" class="container">
    <div class="row">
        <div class="col-sm-9">
            <header class="imovel-header">
                <div class="row no-gutters">
                    <div class="col-sm-12 imovel-header__details">
                        <div class="imovel-header__tags">
                            <?php if(get_field('recomendado', $post->ID)) : ?>
                            <span class="tags__recomendado recomendado">
                                <img src="<?php echo ASSETS;?>/img/icons/star.svg" class="recomendado__icon">
                                Recomendado
                            </span>
                            <?php endif; ?>
        
                            <div class="tags__categoria">
                                <?php $categoria = get_the_category(); echo $categoria[0]->name; ?>
                            </div>
                        </div>
                        <div class="imovel-header__title">
                            <?php the_title(); ?>
                        </div>
        
                        <div class="imovel-header__details-photos" data-destaque-galeria>
                            <div class="photo">
                                <?php the_post_thumbnail(array(567,304)); ?>
                            </div>
                            
                        </div>
                    </div>
                
                </div>
            </header>
        
        
            <div class="imovel-container">
                <div class="row">
                    <div class="col-sm-12">
        
                        <div class="imovel-content">
                            
                            
        
                            <div class="imovel-description">
                                <h4 class="ml-auto text-right"><?php the_date(); ?></h4>
        

        
        
                                <p class="description"><?php the_content(); ?></p>
        
                                
                                
                                
                            </div>
        

        
                            </div>
        
                            <div>
                                <small><?php display_last_updated_date() ;?></small>
                            </div>
        
                            
        
                            
                        </div>
                    </div>
    
                </div>

        </div>
        <div class="col-sm-3">
            ads
        </div>
    </div>
</div>


	<?php endwhile; ?>
	<?php endif; ?>

<?php
get_footer(); 
?>
