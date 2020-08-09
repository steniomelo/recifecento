<?php
  /**
    * The template for displaying the "Home" page
    *
    * @link https://codex.wordpress.org/Template_Hierarchy
    *
    * @package Moura_Construções
  **/

  get_header();
?>

<section class="page">
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <header class="page-header">
                <h1 class="page-title">
                    Assistência técnica
                </h1>
            </header>

            <div class="page-description">
                <p>A Moura Construções preza pela sua satisfação como nosso cliente. Sabemos que um atendimento de excelência não termina na entrega do imóvel, e por isso, nossa assistência técnica é tão importante. Solicite sua assistência, nossos colaboradores estão sempre prontos para atendê-lo!</p>
            </div>

                        <?php echo do_shortcode( '[contact-form-7 id="2146" title="Assistência técnica - Padrão"]' ); ?>

        </div>
    </div>

</section>
<?php
  // get_sidebar();
  get_footer();
