<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://livecomposerplugin.com/themes/
 *
 * @package LC Blank
 */

get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

	<div id="single">
		<div class="container">
			<header class="noticia-header text-center">
				<?php $categories = get_the_category($post->ID); foreach( $categories as $category) { ?>
					<small class="noticia-category"><?php echo $category->name; ?></small>
				<?php } ?>

				<div class="row">
					<h1 class="noticia-title col-sm-10 mx-auto"><?php the_title(); ?></h1>
				</div>
			</header>
		</div>

		<div class="noticia-thumbnail">
			<?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?>
		</div>

		<div class="noticia-content">
			<div class="container">
				<div class="row">
					<div class="col-sm-9 mx-auto">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>

		<footer class="noticia-posts">
			<div class="container">
				<div class="row col-sm-9 mx-auto">
					<div class="col-sm-5 mr-auto">
						<?php
						$prev_post = get_previous_post();
						if (!empty( $prev_post )): ?>
							<div class="post">
								<a href="<?php echo $prev_post->guid ?>">
									<?php echo get_the_post_thumbnail($prev_post->ID, 'thumbnail'); ?>
									<div class="post-details">
										<?php $categories = get_the_category($prev_post->ID); foreach( $categories as $category) { ?>
											<small class="post-category"><?php echo $category->name; ?></small>
										<?php } ?>
										<strong>
                                            <?php
                                                $partes = explode("[:en]", $prev_post->post_title);
                                                if(count($partes) > 1) {
                                                    if (qtrans_getLanguage() == 'pb') {
                                                        echo str_replace("[:pb]", "", $partes[0]);
                                                    } else {
                                                        echo str_replace("[:]", "", $partes[1]);
                                                    }
                                                } else {
                                                    echo $prev_post->post_title;
                                                }
                                            ?>
											<?php //echo $prev_post->post_title ?>
										</strong>
									</div>
								</a>
							</div>
						<?php endif ?>
					</div>
					<div class="col-sm-5">
						<?php
						$next_post = get_next_post();
						if (!empty( $next_post )): ?>
							<div class="post right">
								<a href="<?php echo $next_post->guid ?>">
									<?php echo get_the_post_thumbnail($next_post->ID, 'thumbnail'); ?>
									<div class="post-details">
										<?php $categories = get_the_category($next_post->ID); foreach( $categories as $category) { ?>
											<small class="post-category"><?php echo $category->name; ?></small>
										<?php } ?>
										<strong>
                                            <?php
                                                $partes = explode("[:en]", $next_post->post_title);
                                                if(count($partes) > 1) {
                                                    if (qtrans_getLanguage() == 'pb') {
                                                        echo str_replace("[:pb]", "", $partes[0]);
                                                    } else {
                                                        echo str_replace("[:]", "", $partes[1]);
                                                    }
                                                } else {
                                                    echo $prev_post->post_title;
                                                }
                                            ?>
											<?php //echo $next_post->post_title ?>
										</strong>
									</div>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</footer>

	</div>


	<?php endwhile; ?>
	<?php endif; ?>

<?php get_footer(); ?>
