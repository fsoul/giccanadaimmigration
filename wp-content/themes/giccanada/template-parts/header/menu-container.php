<?php ?>
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
                <div class="col col-auto align-self-center menu">
                    <ul class="nav flex-nowrap">
                        <li class="menu-item">
                            <div class="menu-dropdown">
                                <button class="menu-link white-link-none dropbtn">Главная</button>
                                <div class="dropdown-content" id="main-menu-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col">
                                                <h3 class="row">Виды иммиграции</h3>
                                                <ul class="row">
                                                    <li><a href="#">Express Entry</a></li>
                                                    <li><a href="#">Федеральная программа FSWP</a></li>
                                                    <li><a href="#">Canadian Experience Class</a></li>
                                                    <li><a href="#">Провинциальная программа PNP</a></li>
                                                    <li><a href="#">Студенческие программы</a></li>
                                                    <li><a href="#">Иммиграция в Квебек</a></li>
                                                    <li><a href="#">Рабочая виза</a></li>
                                                    <li><a href="#">Federal Skilled Trades</a></li>
                                                    <li><a href="#">Семейное спонсорство</a></li>
                                                    <li><a href="#">Программа беженства</a></li>
                                                </ul>
                                            </div>
                                            <div class="col">
                                                <h3 class="row">Работа в Канаде</h3>
                                                <ul class="row">
                                                    <li><a href="#">Программа Онтарио</a></li>
                                                    <li><a href="#">Квебек</a></li>
                                                    <li><a href="#">Британская Колумбия</a></li>
                                                    <li><a href="#">Альберта</a></li>
                                                    <li><a href="#">Манитоба</a></li>
                                                    <li><a href="#">Саскатчиван</a></li>
                                                </ul>
                                            </div>
                                            <div class="col">
                                                <h3 class="row">Учёба в Канаде</h3>
                                                <ul class="row">
                                                    <li><a href="#">Учёба в Канаде и иммиграция</a></li>
                                                    <li><a href="#">Студенческая виза</a></li>
                                                    <li><a href="#"> Учебная программа Co-op 2016</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item menu-item">
                            <a href="#" class="menu-link white-link-none">Отзывы</a>
                        </li>
                        <li class="nav-item menu-item">
                            <a href="#" class="menu-link white-link-none">Контакты</a>
                        </li>
                        <li class="nav-item menu-item">
                            <a href="#" class="menu-link white-link-none">Личный кабинет</a>
                        </li>
                    </ul>
                </div>
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
            <div class="modal-body container-fluid">
                <ul class="row" id="modal-menu-list">
                    <li class="modal-item">Главная</li>
                    <li class="modal-item">Виды иммиграции
                        <ul class="row">
                            <li><a href="#">Express Entry</a></li>
                            <li><a href="#">Федеральная программа FSWP</a></li>
                            <li><a href="#">Canadian Experience Class</a></li>
                            <li><a href="#">Провинциальная программа PNP</a></li>
                            <li><a href="#">Студенческие программы</a></li>
                            <li><a href="#">Иммиграция в Квебек</a></li>
                            <li><a href="#">Рабочая виза</a></li>
                            <li><a href="#">Federal Skilled Trades</a></li>
                            <li><a href="#">Семейное спонсорство</a></li>
                            <li><a href="#">Программа беженства</a></li>
                        </ul>
                    </li>
                    <li class="modal-item">Работа в Канаде
                        <ul class="row">
                            <li><a href="#">Программа Онтарио</a></li>
                            <li><a href="#">Квебек</a></li>
                            <li><a href="#">Британская Колумбия</a></li>
                            <li><a href="#">Альберта</a></li>
                            <li><a href="#">Манитоба</a></li>
                            <li><a href="#">Саскатчиван</a></li>
                        </ul>
                    </li>
                    <li class="modal-item">Учеба в Канаде
                        <ul class="row">
                            <li><a href="#">Учёба в Канаде и иммиграция</a></li>
                            <li><a href="#">Студенческая виза</a></li>
                            <li><a href="#"> Учебная программа Co-op 2016</a></li>
                        </ul>
                    </li>
                    <li class="modal-item">Отзывы</li>
                    <li class="modal-item">Контакты</li>
                    <li class="modal-item">Русский</li>
                    <li class="modal-item">Личный кабинет</li>
                </ul>
            </div>
        </div>
    </div>
</div>