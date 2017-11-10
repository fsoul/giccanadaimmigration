<section class="radio-block">
    <label>Работали ли вы в Канаде по рабочей визе последний год?</label>
    <section>
        <input name="ass-worked-at-canada" class="ass-radio" value="f" checked type="radio" id="ass-worked-at-canada-f"
               data-role="radio">
        <label for="ass-worked-at-canada-f" data-template="work-in-canada" data-parent="work-in-canada"
               onclick="app.func.onFileDelRadioClick(event);">Нет</label>
    </section>
    <section>
        <input name="ass-worked-at-canada" class="ass-radio" value="t" type="radio" id="ass-worked-at-canada-t"
               data-role="radio">
        <label for="ass-worked-at-canada-t" data-template="work-in-canada" data-parent="work-in-canada"
               onclick="app.func.onFileAddRadioClick(event);">Да</label>
    </section>
</section>
<div id="work-in-canada"></div>