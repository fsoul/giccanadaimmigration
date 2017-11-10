<?php ?>
<section class="file-upload-container clearfix" id="canadian-education-files">
    <div class="file-upload-button-container">
        <input type="file" id="ass-studied-files" multiple accept="application/pdf, image/*"
               data-container="ass-studied-files-list" data-type="multiple" data-attach="att_educ" data-role="file-multiply">
        <label class="ass-file-input-label">Приложите подтверждающие документы</label>
        <label class="ass-file-input" for="ass-studied-files"><span>Загрузить файл</span></label>
        <span class="error-text add-btn-err" id="error-ass-studied-files"></span>
    </div>
    <div class="added-files" id="ass-studied-files-list"></div>
</section>
<section>
<section class="radio-block">
    <label>Учился(ась) ли супруг(а) ли вы в Канаде в течение последних двух лет?</label>
    <section>
        <input name="ass-partner-studied-at-canada" class="ass-radio" value="f" checked type="radio" id="ass-partner-studied-at-canada-f">
        <label for="ass-partner-studied-at-canada-f">Нет</label>
    </section>
    <section>
        <input name="ass-partner-studied-at-canada" class="ass-radio" value="t" type="radio" id="ass-partner-studied-at-canada-t">
        <label for="ass-partner-studied-at-canada-t">Да</label>
    </section>
</section>