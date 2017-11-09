<section class="radio-block">
    <label>Есть ли у вас родственники в Канаде?</label>
    <section>
        <input name="ass-relatives" class="ass-radio" value="t" checked type="radio" id="ass-rel-t" data-role="radio">
        <label for="ass-rel-t">Да</label>
    </section>
    <section>
        <input name="ass-relatives" class="ass-radio" value="f" type="radio" id="ass-rel-f" data-role="radio">
        <label for="ass-rel-f">Нет</label>
    </section>
</section>
<section>
    <label for="ass-rel-last-name">Фамилия</label>
    <input type="text" name="asa-rel-last-name" id="ass-rel-last-name" placeholder="Введите фамилию" data-role="text">
    <span class="error-text" id="error-ass-rel-last-name"></span>
</section>
<section>
    <label for="ass-rel-first-name">Имя</label>
    <input type="text" name="ass-rel-first-name" id="ass-rel-first-name" placeholder="Введите имя" data-role="text">
    <span class="error-text" id="error-ass-rel-first-name"></span>
</section>
<section>
    <label for="ass-rel-middle-name">Отчество</label>
    <input type="text" name="ass-rel-middle-name" id="ass-rel-middle-name" placeholder="Введите отчетство" data-role="text">
    <span class="error-text" id="error-ass-rel-middle-name"></span>
</section>
<section>
    <label for="ass-rel-with">Родственные связи с вами</label>
    <input type="text" name="ass-rel-with" id="ass-rel-with" data-role="text">
    <span class="error-text" id="error-ass-rel-with"></span>
</section>
<section>
    <label for="ass-rel-status">Статус в Канаде</label>
    <input type="text" name="ass-rel-status" id="ass-rel-status" data-role="text">
    <span class="error-text" id="error-ass-rel-status"></span>
</section>
<section>
    <label for="ass-rel-province">Провинция в Канаде</label>
    <select id="ass-rel-province" class="ass-province" name="ass-rel-province" required data-role="select">
        <option value="" disabled selected>Выберите провинцию</option>
        <?= getProvinceOptions();?>
    </select>
    <span class="error-text" id="error-ass-rel-province"></span>
</section>