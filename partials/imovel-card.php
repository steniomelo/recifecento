<div class="list-item imovel-card ">
    <a href="<?php echo get_post_permalink($similar->ID); ?>">
    <div class="imovel-container">
        <div class="imovel-content">
            <div class="imovel-img">
				<div class="images" data-imovelcard-slick>
                    <?php 
                        $photo_similar_extras = json_decode(get_field('properties_photo', $similar->ID));
                        foreach ($photo_similar_extras->Foto as $gallery):
                            if ($gallery->FotoDestaque == 0):
                    ?>
                        <img src="<?php echo $gallery->URLArquivo; ?>">
                    <?php
                        endif; 
                        endforeach; 
                    ?>
                </div>
            </div>

            <div class="imovel-details">
                <header class="imovel-title">
                    <h2 class="imovel-bairro">
                        <?php 
                            $explode_neighborhood = explode('-', get_field('properties_neighborhood', $similar->ID));
                            echo $explode_neighborhood[0];
                        ?>
                    </h2>
                    <h3 class="imovel-nome"><?php echo get_field('properties_name', $similar->ID); ?></h3>
                    <i class="arrow-hover gray"></i>	
                </header>
                <div class="imovel-info">
                    <?php if (get_field('properties_size', $similar->ID)): ?>
                    <div class="info info-tamanho">
                        <img src="<?php echo ASSETS;?>/img/icons/tamanho.svg" />
                        <small><?php echo get_field('properties_size', $similar->ID); ?></small>
                    </div>
                    <?php endif; ?>

                    <?php if (get_field('properties_room', $similar->ID)): ?>
                    <div class="info info-quartos">
                        <img src="<?php echo ASSETS;?>/img/icons/quarto.svg">
                        <small><?php echo get_field('properties_room', $similar->ID); ?></small>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (get_field('properties_toilet', $similar->ID)): ?>
                    <div class="info info-banheiros">
                        <img src="<?php echo ASSETS;?>/img/icons/banheiro.svg">
                        <small><?php echo get_field('properties_toilet', $similar->ID); ?></small>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="imovel-description">
                    <?php 
                        $id = $similar->ID;
                        $my_get_post = get_post($id);
                        $my_post = $my_get_post->post_content;
                        $my_post_content = apply_filters('the_content', $my_post);
                        $my_formatted_content = str_replace(']]>', ']]>', $my_post_content);
                        echo $my_formatted_content;
                    ?>
                </div>

                <div class="imovel-price">
                    <small><?php echo $GLOBALS['campos']['config']['geral']['a_partir_de']; ?></small>
                    <strong class="price">
                        <small class="price-cifrao">R$</small>
                        <span class="price-valor"><?php echo number_format(get_field('properties_price', $similar->ID), 2, ',', '.'); ?></span>
                    </strong>
                </div>
            </div>
        </div>
    </div>
    </a>
    
</div>
