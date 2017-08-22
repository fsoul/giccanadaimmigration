<?php get_header(); ?>

<div class="fullscreen-bg">
    <div class="overlay">
        <h1>Простой пример<br>фонового видео на сайте</h1>
    </div>
    <video loop muted autoplay poster="images/plane.jpg" class="fullscreen-bg__video">
        <source src="video/plane.mp4" type="video/mp4">
        <source src="video/plane.webm" type="video/webm">
    </video>
</div>
<div class="content">
    <h2>Следующий блок</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit animi, expedita natus, nam commodi veniam ullam? Odio voluptatibus cum pariatur magni ex a animi maxime minima asperiores reprehenderit ad, blanditiis, eius corporis est tempora dolor accusantium, ullam perspiciatis debitis expedita.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis iusto non unde at suscipit error amet voluptates eligendi, itaque tempora!</p>
</div>


<?php get_footer();?>