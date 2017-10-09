<?php ?>

<div class="container-fluid">
	<div class="row align-items-center no-gutters footer-bottom">
		<div class="col-sm-6 col-md-3" id="footer-socials">
			<!--footer-socials-->
			<div class="row flex-nowrap">
                <a href="#" class="col-2"><i class="fa fa-vk tb-menu-logo"></i></a>
                <a href="#" class="col-2"><i class="fa fa fa-facebook tb-menu-logo"></i></a>
                <a href="#" class="col-2"><i class="fa fa-instagram tb-menu-logo"></i></a>
			</div>
		</div>
		<div class="col-sm-6" id="footer-map">
            <a href="#" class="footer-text footer-site-map white-link-underline">Карта сайта</a>
		</div>
		<div class="col-sm-12 col-md-3 col-auto">
			<span class="footer-text footer-cr">&copy;2017 GIC Canada. All rights reserved.</span>
		</div>
	</div>
</div>
<?php dynamic_sidebar( 'contact-sidebar' ); ?>
<?php get_template_part( 'template-parts/footer/fixed-right-panel'); ?>
<?php get_template_part( 'template-parts/footer/mobile-btn-up'); ?>
<?php get_template_part( 'template-parts/assessment-form/layout'); ?>
