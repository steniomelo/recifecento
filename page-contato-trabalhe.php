<?php
/**
 * Template name: Contato - Trabalhe conosco
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
                    <h1 class="title"><?php echo get_the_title($GLOBALS['contato']->ID); ?></h1>
                </div>

            
                <div class="contato-option col-md-5 col-sm-12 d-none d-md-flex">
                    <a href="<?php echo BASE;?>/contato/atendimento" class="">
                        <img src="<?php echo ASSETS;?>/img/icons/contato-atendimento.svg">
                        <span><?php echo $GLOBALS['campos']['contato']['quero_atendimento']; ?></span>
                    </a>
                </div>
                <div class="contato-option col-md-5 col-sm-12 active">
                    <a  class="">
                    <img src="<?php echo ASSETS;?>/img/icons/contato-trabalhar.svg">
                        <span><?php echo $GLOBALS['campos']['contato']['quero_trabalhar']; ?></span>
                    </a>
                </div>
            </header>

            <div class="contato-content">
                <div class="row">
                    <div class="space col-md-1 col-sm-12">

                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="content-options">
                            <a href="tel:<?php echo str_replace(array(' ','-'), '', $GLOBALS['campos']['contato']['telefone']) ?>" class="option">
                                <div class="option-image col-md-2">
                                    <img src="<?php echo ASSETS;?>/img/icons/option-phone.svg">
                                </div>
                                <div class="option-text col-md-10">
                                <strong><?php echo $GLOBALS['campos']['contato']['por_telefone']['titulo']; ?></strong>
                                    <span><?php echo $GLOBALS['campos']['contato']['por_telefone']['sub-titulo']; ?> </span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 sidebar">
                        <?php 
                        if ( qtrans_getLanguage() == 'pb' ) {
                            echo do_shortcode('[ninja_form id=8]');
                        } else {
                            echo do_shortcode('[ninja_form id=9]');
                        }
                        ?>
                    </div>
                </div>
            </div>


		</div>

	</div>


	<?php endwhile; ?>
	<?php endif; ?>

<?php get_footer(); ?>
