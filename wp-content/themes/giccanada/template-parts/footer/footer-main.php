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
					<div class="row no-gutters footer-contact-item">
						<a href="#" class="col-auto footer-phone"></a>
						<a href="#" class="col-auto footer-contact-link footer-text white-link-none">+16475584910</a>
					</div>
					<div class="row no-gutters footer-contact-item">
						<a href="#" class="col-auto footer-fax"></a>
						<a href="#" class="col-auto footer-contact-link footer-text white-link-none">+16475584910</a>
					</div>
					<div class="row no-gutters footer-contact-item">
						<a href="#" class="col-auto footer-mail"></a>
						<a href="#" class="col-auto footer-contact-link footer-text white-link-none">cicinfocenter@gmail.com</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-3">
			<div class="footer-address-item row no-gutters">
				<div class="col">
					<h2 class="footer-address-name footer-text">Киев, Украина</h2>
					<p class="footer-address footer-text">ул. Антоновича 172, 714а</p>
				</div>
			</div>
			<div class="row no-gutters footer-address-item">
				<div class="col">
					<h2 class="footer-address-name footer-text">Aventura, FL 33180, USA</h2>
					<p class="footer-address footer-text">APT 1410</p>
				</div>
			</div>
		</div>
	</div>
</div>
