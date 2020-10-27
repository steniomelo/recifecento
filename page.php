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

    <div id="imovel-detalhe" class="container">
        <div class="row">
            <div class="col-sm-9">
                <?php if(is_archive()) : ?>
                        <a href="<?php the_permalink(); ?>" class="post">
                    <?php else : ?>
                        <div class="post">
                    <?php endif; ?>
                        <h1><?php the_title(); ?></h1>

                        <br>
                        <br>


                        <div class="imovel-container">
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="imovel-content">

                                        <div class="imovel-description">
                                           

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

            </div>

            <div class="col-sm-3">
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- Single Post -->
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-4672816343502215"
                    data-ad-slot="8531038660"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
        </div>
            
        </div>
    </div>

   

	<?php endwhile; ?>
	<?php endif; ?>

<?php
get_footer(); 
?>
