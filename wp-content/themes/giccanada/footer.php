    <div class="container-fluid" id="footer"><!--footer-->
        <div class="container-fluid footer-wrapper">
            <?php get_template_part( 'template-parts/footer/footer', 'main'); ?>
        </div>
        <?php get_template_part( 'template-parts/footer/footer', 'bottom'); ?>
    </div> <!--footer end-->
</div>
<?php dynamic_sidebar( 'contact-sidebar' ); ?>
<?php get_template_part( 'template-parts/footer/fixed-right-panel'); ?>
<?php get_template_part( 'template-parts/footer/mobile-btn-up'); ?>
<?php //get_template_part( 'template-parts/assessment-form/layout'); ?>
<?php wp_footer(); ?>
</body>
</html>