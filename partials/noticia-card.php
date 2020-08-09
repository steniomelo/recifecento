
<div class="list-item noticia-card ">
    <a href="<?php the_permalink();?>">
        <div class="noticia-container">
            <div class="noticia-content">
                <div class="noticia-img">
                    <?php the_post_thumbnail('large');?>
                </div>

                <div class="noticia-details">
                    <header class="noticia-category">
                        <hr>
                        <?php $categories = get_the_category($post->ID); foreach( $categories as $category) { ?>
                            <small><?php echo $category->name; ?></small>
                        <?php } ?>
                    </header>

                    <div class="noticia-description">
                        <?php the_title(); ?>
                    </div>

                    <footer>
                        <i class="arrow-hover gray"></i>	
                    </footer>

                </div>
            </div>


        </div>
    </a>
    
</div>
