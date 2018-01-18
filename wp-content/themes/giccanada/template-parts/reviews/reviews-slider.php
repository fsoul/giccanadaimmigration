<?php

$args = array(
	'category_name'  => 'review',
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'orderby'        => 'date',
	'order'          => 'DESC',
	'posts_per_page' => 16
);

$query = new WP_Query( $args );
if ( $query->have_posts() ) : ?>
    <div id="reviews-carousel" class="owl-carousel owl-theme owl-loaded owl-drag">
		<?php while ( $query->have_posts() ) : ?>
			<?php $query->the_post(); ?>
            <div class="item">
                <div class="d-block">
                    <div class="container">
                        <div class="row">
                            <div class="col reviews-image"><?php the_post_thumbnail(); ?></div>
                        </div>
                        <div class="row">
                            <h2 class="col reviews-reviewer-name"><?= get_post_meta( get_the_ID(), 'reviews-reviewer-name', true ); ?></h2>
                        </div>
                        <div class="container reviews-slr-item">
                            <div class="row no-gutters">
                                <div class="col">
                                    <p class="reviews-reviewer-proc"><?= get_post_meta( get_the_ID(), 'reviews-reviewer-proc', true ); ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="quotes-img"></div>
                                </div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col">
                                    <div class="reviews-review"><?php the_content(); ?></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="quotes-img"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<?php
		endwhile;
		wp_reset_postdata(); // сбрасываем переменную $post
        ?>
    </div>
<?php endif; ?>