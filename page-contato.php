<?php
/**
 * Template name: Contato
 */

get_header(); ?>

    <?php 
        if ( have_posts() ) : while ( have_posts() ) : the_post(); 

        $fields = get_fields();
    
    ?>

	<div id="contato">
		<div class="container">
            <header class="contato-header row">
                <div class="contato-title col-sm-1">
                    <h1 class="title"><?php the_title(); ?></h1>
                </div>

            
                <div class="contato-option col-md-5 col-sm-12">
                    <a href="<?php echo BASE;?>/contato/atendimento" class="">
                        <img src="<?php echo ASSETS;?>/img/icons/contato-atendimento.svg">
                        <span><?php echo $GLOBALS['campos']['contato']['quero_atendimento']; ?></span>
                    </a>
                </div>
                <div class="contato-option col-md-5 col-sm-12">
                    <a href="<?php echo BASE;?>/contato/trabalheconosco" class="">
                    <img src="<?php echo ASSETS;?>/img/icons/contato-trabalhar.svg">
                        <span><?php echo $GLOBALS['campos']['contato']['quero_trabalhar']; ?></span>
                    </a>
                </div>
            </header>

		</div>

	</div>


	<?php endwhile; ?>
	<?php endif; ?>

<?php get_footer(); ?>
