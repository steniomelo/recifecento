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
<div class="section section-has-bars text-left" id="comprar-casa">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-5 t-a-m-c">
        <h2 class="section-title section-title-w">COMPRE SUA PRÓPRIA CASA</h2>

        <br>

        <p>A chance de realizar o sonho da casa própria está cada vez mais próxima.</p>

      </div>
    </div>
  </div>
</div>

<div class="section " >
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-10 col-md-offset-1">
        <?php echo do_shortcode( '[contact-form-7 id="2143" title="Comprar casa - Padrão"]' ); ?>
      </div>
    </div>
  </div>
</div>
</section>
<?php
  // get_sidebar();
  get_footer();
