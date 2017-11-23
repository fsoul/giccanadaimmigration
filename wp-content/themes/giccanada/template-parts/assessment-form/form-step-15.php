<div>
    <p>Пожалуйста, предоставьте подробную информацию о Вашем партнере.</p>
    <div id="partner-info">
        <section class="radio-block">
            <label>Есть ли у вас супруг/а или гражданский партнер?</label>
            <section>
                <input name="part-relation" class="ass-radio" value="n" checked type="radio" id="part-relation-n" data-role="radio"
                       data-template="partner-info" data-parent="partner" onclick="app.func.onPartnerDelRadioClick(event);" required>
                <label for="part-relation-n" >Нет</label>
            </section>
            <section>
                <input name="part-relation" class="ass-radio" value="y" type="radio"
                       id="part-relation-y" data-role="radio" data-template="partner-info" data-parent="partner"
                onclick="app.func.onPartnerAddRadioClick(event);" required>
                <label for="part-relation-y" >Да</label>
            </section>
        </section>
    </div>
</div>
<div id="part-educ-cont" style="display: none">
    <div id="part-educ">
        <p>Образование партнера (школа, училище, институт, курсы) в хронологическом порядке.</p>
    </div>
    <section>
        <button class="ass-add-button" data-parent="partner" data-template="part-educ"><span>Добавить учебное заведение</span></button>
    </section>
</div>
<div id="part-work-cont" style="display: none">
    <div id="part-work">
        <p>Укажите опыт работы партнера в хронологическом порядке начиная с последнего места работы.</p>
    </div>
    <section>
        <button class="ass-add-button" data-parent="partner" data-template="part-work"><span>Добавить место работы</span></button>
    </section>
</div>