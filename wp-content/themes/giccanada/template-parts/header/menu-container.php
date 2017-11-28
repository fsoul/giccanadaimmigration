<?php require_once  get_template_directory() .'/inc/walkers.php'; ?>
<div class="container-fluid" id="menu-container">
    <div class="row justify-content-center no-gutters">
        <div class="col-md-11 col-lg-9">
            <div class="row justify-content-between align-items-end no-gutters flex-nowrap menu-row">
                <a href="/" class="col-auto menu-logo"></a>
                <button class="col-auto align-self-center mobile-menu-button" data-toggle="modal"
                        data-target="#mobile-modal"></button>
                <div class="col-8 col-auto align-self-center menu-phone-block">
                    <div class="row no-gutters justify-content-center align-items-center flex-nowrap">
                        <i class="fa fa-phone tb-menu-logo"></i>
                        <a class="white-link-none" href="tel:+16475584910">+16475584910</a>
                    </div>
                </div>
				<?php wp_nav_menu( array(
					'theme_location'  => 'top',
					'menu_id'         => 'top-menu',
					'menu_class'      => 'nav flex-nowrap',
					'walker'          => new Top_Menu_Walker_Nav(),
					'container_class' => 'col col-auto align-self-center menu'
				) ); ?>
            </div>
        </div>
    </div>
</div> <!--menu-container-->
<div class="modal fade" id="mobile-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content container-fluid">
            <div class="modal-header">
                <button type="button" class="close" id="modal-back-arrow">
                    <span aria-hidden="true">&larr;</span>
                </button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
			<?php wp_nav_menu( array(
				'theme_location'  => 'mobile-top',
				'menu_id'         => 'modal-menu-list',
				'menu_class'      => 'row',
				'walker'          => new Mobile_Top_Menu_Walker_Nav(),
				'container_class' => 'modal-body container-fluid'
			) ); ?>
        </div>
    </div>
</div>