<div class="list-item noticia-card">
    <div class="noticia-card__container">
        <div class="noticia-card__content">
            <div class="noticia-card__img noticia-img">
                <?php the_post_thumbnail(); ?>
            </div>

            <a href="<?php the_permalink(); ?>" class="noticia-card__details noticia-details">
                <div class="tags__categoria">
                    <?php $categoria = get_the_category(); echo $categoria[0]->name; ?>
                </div>
                <div class="noticia-card__text">
                    <h3><?php the_title(); ?></h3>
                    <?php the_excerpt(); ?>
                </div>
            </a>
        </div>
    </div>
</div>