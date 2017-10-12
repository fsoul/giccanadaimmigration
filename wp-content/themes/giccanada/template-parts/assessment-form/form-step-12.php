<section class="radio-block">
    <label>Учились ли вы в Канаде в течение последних двух лет?</label>
    <section>
        <input name="ass-studied-at-canada" class="ass-radio" value="t" checked type="radio" id="ass-studied-at-canada-t">
        <label for="ass-studied-at-canada-t">Да</label>
    </section>
    <section>
        <input name="ass-studied-at-canada" class="ass-radio" value="f" type="radio" id="ass-studied-at-canada-f">
        <label for="ass-studied-at-canada-f">Нет</label>
    </section>
</section>
<section class="file-upload-container clearfix" id="canadian-education-files">
    <div class="file-upload-button-container">
        <!--    <input type="file" onchange="app.func.addFileToList(this);" id="ass-studied-files" multiple accept="application/pdf, image/*">-->
        <input type="file" onchange="app.func.addFileToList(this, 'canadian-education-files');" id="ass-studied-files" multiple>
        <label class="ass-file-input-label">Приложите подтверждающие документы</label>
        <label class="ass-file-input" for="ass-studied-files"><span>Загрузить файл</span></label>
    </div>
    <div class="added-files"></div>
</section>
<section>
<section class="radio-block">
    <label>Учился(ась) ли супруг(а) ли вы в Канаде в течение последних двух лет?</label>
    <section>
        <input name="ass-partner-studied-at-canada" class="ass-radio" value="t" checked type="radio" id="ass-partner-studied-at-canada-t">
        <label for="ass-partner-studied-at-canada-t">Да</label>
    </section>
    <section>
        <input name="ass-partner-studied-at-canada" class="ass-radio" value="f" type="radio" id="ass-partner-studied-at-canada-f">
        <label for="ass-partner-studied-at-canada-f">Нет</label>
    </section>
</section>



