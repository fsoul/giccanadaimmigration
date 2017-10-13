<section class="radio-block">
    <label>Работали ли вы в Канаде по рабочей визе последний год?</label>
    <section>
        <input name="ass-worked-at-canada" class="ass-radio" value="t" checked type="radio" id="ass-worked-at-canada-t">
        <label for="ass-worked-at-canada-t">Да</label>
    </section>
    <section>
        <input name="ass-worked-at-canada" class="ass-radio" value="f" type="radio" id="ass-worked-at-canada-f">
        <label for="ass-worked-at-canada-f">Нет</label>
    </section>
</section>
<section class="file-upload-container clearfix" id="canadian-work-files">
    <div class="file-upload-button-container">
        <!--    <input type="file" onchange="app.func.addFileToList(this);" id="ass-studied-files" multiple accept="application/pdf, image/*">-->
        <input type="file" onchange="app.func.addFileToList(this, 'canadian-work-files');" id="ass-worked-files" multiple>
        <label class="ass-file-input-label">Приложите подтверждающие документы</label>
        <label class="ass-file-input" for="ass-worked-files"><span>Загрузить файл</span></label>
    </div>
    <div class="added-files"></div>
</section>
<section>
<section class="radio-block">
    <label>Работал(а) ли супруг(а) в Канаде по рабочей визе последний год?</label>
    <section>
        <input name="ass-partner-worked-at-canada" class="ass-radio" value="t" checked type="radio" id="ass-partner-worked-at-canada-t">
        <label for="ass-partner-worked-at-canada-t">Да</label>
    </section>
    <section>
        <input name="ass-partner-worked-at-canada" class="ass-radio" value="f" type="radio" id="ass-partner-worked-at-canada-f">
        <label for="ass-partner-worked-at-canada-f">Нет</label>
    </section>
</section>



