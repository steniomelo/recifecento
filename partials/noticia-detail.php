<?php if(is_archive()) : ?>
    <a href="<?php the_permalink(); ?>" class="post">
<?php else : ?>
    <div class="post">
<?php endif; ?>
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
                        <h4 class="ml-auto text-left"><?php the_time(get_option('date_format')); ?></h4>

                        <?php if(is_archive()) : ?>
                            <p class="description"><?php the_excerpt(); ?></p>
                        <?php else: ?>
                            <p class="description"><?php the_content(); ?></p>
                        <?php endif; ?>
                    </div>

                </div>

                <div>
                    <small><?php display_last_updated_date() ;?></small>
                </div>

            </div>
        </div>

    </div>
<?php if(is_archive()) : ?>
    </a>
<?php else : ?>
    </div>
<?php endif; ?>

