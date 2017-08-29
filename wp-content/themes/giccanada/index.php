<?php get_header(); ?>
    <div class="header-container">
	    <?php get_template_part( 'template-parts/header/fixed-right-panel'); ?>
	    <?php get_template_part( 'template-parts/header/top-bar'); ?>
	    <?php get_template_part( 'template-parts/header/menu-container'); ?>
	    <?php get_template_part( 'template-parts/header/header-slider'); ?>
    </div> <!--header-container end-->
    <div class="container programms"> <!--programms-->
	    <?php get_template_part( 'template-parts/programms'); ?>
    </div> <!--programms end-->
    <div class="container-fluid academy"><!--academy-->
	    <?php get_template_part( 'template-parts/academy'); ?>
    </div> <!--academy end-->
    <div class="container-fluid common-info"><!--common-info-->
	    <?php get_template_part( 'template-parts/common-info'); ?>
    </div> <!--common-info end-->
    <div class="container-fluid process"><!--process-->
	    <?php get_template_part( 'template-parts/process'); ?>
    </div> <!--process end-->
    <div class="container-fluid reviews"><!--reviews-->
	    <?php get_template_part( 'template-parts/reviews'); ?>
    </div><!--reviews end-->
    <div class="container-fluid news"> <!--news-->
	    <?php get_template_part( 'template-parts/news'); ?>
    </div><!--news end-->
<?php get_footer(); ?>