<section class="radio-block">
    <label>Учились ли вы в Канаде в течение последних двух лет?</label>
    <section>
        <input name="ass-studied-at-canada" class="ass-radio" value="f" checked type="radio"
               id="ass-studied-at-canada-f" data-role="radio">
        <label for="ass-studied-at-canada-f" data-template="canada-educ" data-parent="canada-educ"
               onclick="app.func.onFileDelRadioClick(event);">Нет</label>
    </section>
    <section>
        <input name="ass-studied-at-canada" class="ass-radio" value="t" type="radio" id="ass-studied-at-canada-t"
               data-role="radio">
        <label for="ass-studied-at-canada-t" data-template="canada-educ" data-parent="canada-educ"
               onclick="app.func.onFileAddRadioClick(event);">Да</label>
    </section>
</section>
<div id="canada-educ"></div>