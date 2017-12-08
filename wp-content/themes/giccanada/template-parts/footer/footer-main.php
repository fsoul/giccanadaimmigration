<?php require_once  get_template_directory() .'/inc/walkers.php'; ?>

<div class="container-fluid">
	<div class="row no-gutters align-items-start footer-block">
		<div class="col-12 col-sm-3">
			<a href="/" class="footer-logo"></a>
		</div>
		<div class="col-12 col-sm-6">
			<div class="row no-gutters justify-content-center" id="footer-info">
				<div class="col-sm-5 col-auto footer-item">
					<?php wp_nav_menu( array(
						'theme_location'  => 'footer',
						'menu_id'         => 'footer-menu',
//							'menu_class'      => 'nav flex-nowrap',
						'walker'          => new Footer_Menu_Walker_Nav(),
						'container'          => 'nav',
						'container_class' => 'nav flex-column footer-nav'
					) ); ?>
				</div>
				<div class="col-sm-7 col-md-5 col-auto footer-item">
					<?php dynamic_sidebar( 'footer-contacts' ); ?>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-3">
			<?php dynamic_sidebar( 'footer-addresses' ); ?>
		</div>
	</div>
</div>
