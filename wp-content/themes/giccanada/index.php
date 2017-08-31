<?php get_header(); ?>
    <div class="header-container">
	    <?php get_template_part( 'template-parts/header/fixed-right-panel'); ?>
	    <?php get_template_part( 'template-parts/header/top-bar'); ?>
	    <?php get_template_part( 'template-parts/header/menu-container'); ?>
        <div id="header-slider-container">
	        <?php get_template_part( 'template-parts/header/header-slider'); ?>
        </div>
    </div> <!--header-container end-->
    <div class="container" id="programms"> <!--programms-->
	    <?php get_template_part( 'template-parts/programms/programms'); ?>
    </div> <!--programms end-->
    <div class="container-fluid" id="academy-container"><!--academy-->
	    <?php get_template_part( 'template-parts/academy/academy'); ?>
    </div> <!--academy end-->
    <div class="container-fluid" id="common-info"><!--common-info-->
	    <?php get_template_part( 'template-parts/common-info'); ?>
    </div> <!--common-info end-->
    <div class="container-fluid" id="process"><!--process-->
	    <?php get_template_part( 'template-parts/process/process'); ?>
    </div> <!--process end-->
    <div class="container-fluid" id="reviews"><!--reviews-->
	    <?php  get_template_part( 'template-parts/reviews/reviews'); ?>
    </div><!--reviews end-->
    <div class="container-fluid" id="news"> <!--news-->
	    <?php get_template_part( 'template-parts/news'); ?>
    </div><!--news end-->
<?php get_footer(); ?>