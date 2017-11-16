<div class="modal fade" id="assessment-modal">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="ass-step-init">
                    <div class="container-fluid">
                        <div class="row justify-content-center no-gutters">
                            <div id="ass-logo" class="col"></div>
                        </div>
                        <div class="row justify-content-center no-gutters">
                            <div class="col">
                                <h5 class="modal-title">ASSESSMENT FORM</h5>
                            </div>
                        </div>
                    </div>
                    <div>
                        <p>
                            <span>Добрый день!</span>
                            <span>После заполнения формы, оплаты услуг и открытия иммиграционного дела
                                    Вам будет присвоен личный номер файла и отправлен на указанный Вами e-mail.</span>
                            <span>C его помощью Вы получите доступ в личный кабинет, где сможете следить за обновлением статуса своего дела.</span>
                        </p>
                    </div>
                    <button class="orange-btn" id="ass-init-btn">Заполнить форму</button>
                </div>
                <div class="progress-container">
                    <div class="container-fluid">
                        <div class="row justify-content-center no-gutters">
                            <div class="col">
                                <h5>ASSESSMENT FORM</h5>
                            </div>
                        </div>
                    </div>
                    <p class="progress-cation">Шаг <span class="progress-current-step"></span> из <span class="progress-steps-count"></span></p>
                    <div class="progressbar">
                        <div></div>
                    </div>
                </div>
                <form id="assessment-form" action="handler.php" method="post">
                    <h5>Личные данные</h5>
                    <fieldset class="assessment-step -step1"></fieldset>
                    <h5>Семейное положение</h5>
                    <fieldset class="assessment-step -step2"></fieldset>
                    <h5>Ваша фотография</h5>
                    <fieldset class="assessment-step -step3"></fieldset>
                    <h5>Личные данные</h5>
                    <fieldset class="assessment-step -step4"></fieldset>
                    <h5>Паспортные данные</h5>
                    <fieldset class="assessment-step -step5"></fieldset>
                    <h5>Контактные данные</h5>
                    <fieldset class="assessment-step -step6"></fieldset>
                    <h5>Английский язык</h5>
                    <fieldset class="assessment-step -step7"></fieldset>
                    <h5>Французский язык</h5>
                    <fieldset class="assessment-step -step8"></fieldset>
                    <h5>Родственники в Канаде</h5>
                    <fieldset class="assessment-step -step9 relations"></fieldset>
                    <h5>Где вы намереваетесь жить в Канаде?</h5>
                    <fieldset class="assessment-step -step10"></fieldset>
                    <h5>Образование</h5>
                    <fieldset class="assessment-step -step11 education"></fieldset>
                    <h5>Образование в Канаде</h5>
                    <fieldset class="assessment-step -step12 canada-educ"></fieldset>
                    <h5>Опыт работы</h5>
                    <fieldset class="assessment-step -step13 work"></fieldset>
                    <h5>Опыт работы в Канаде</h5>
                    <fieldset class="assessment-step -step14 work-in-canada"></fieldset>
                    <h5>Информация о партнере</h5>
                    <fieldset class="assessment-step -step15 partner"></fieldset>
                    <h5>Информация о детях</h5>
                    <fieldset class="assessment-step -step16 children"></fieldset>
                    <h5>Оплата за регистрацию иммиграционного файла</h5>
                    <fieldset class="assessment-step -step17 payment"></fieldset>
                    <input type="hidden" name="addr" value="<?= get_option('show_email');?>">
                    <?php if($_GET['debug'] == 'submit') : ?>
                        <input type="submit">
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var form = document.getElementById('assessment-form');
    form.addEventListener('onValidate', function (e) {
        alert(e);
        debugger;
    });
</script>