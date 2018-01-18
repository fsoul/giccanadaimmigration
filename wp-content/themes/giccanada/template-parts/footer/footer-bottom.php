<?php ?>
<div class="container-fluid">
	<div class="row align-items-center no-gutters footer-bottom">
        <div class="col-6 col-sm-2 col-md-2" id="footer-socials">
            <?php dynamic_sidebar( 'bottom-footer' ); ?>
        </div>
        <div class="col-6 col-sm-2 col-md-1" id="footer-map">
            <a href="#" class="footer-site-map white-link-underline">Карта сайта</a>
        </div>
		<div class="col-12 col-sm-8 col-md-6">
            <div class="row">
                <a href="javascript:void(0);" class="col-12 col-sm-6 white-link-underline terms-modal">Условия использования</a>
                <a href="javascript:void(0);" class="col-12 col-sm-6 white-link-underline agreement-modal">Пользовательское соглашение и политика конфиденциальности</a>
            </div>
        </div>
		<div class="col-sm-12 col-md-3">
			<span class="footer-text footer-cr">&copy;<?=date("Y");?> GIC Canada. All rights reserved.</span>
		</div>
	</div>
</div>
