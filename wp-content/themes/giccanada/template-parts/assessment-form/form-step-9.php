<section class="radio-block">
    <label>Есть ли у вас родственники в Канаде?</label>
    <section>
        <input name="ass-relatives" class="ass-radio" value="t" checked type="radio" id="ass-rel-t">
        <label for="ass-rel-t">Да</label>
    </section>
    <section>
        <input name="ass-relatives" class="ass-radio" value="f" type="radio" id="ass-rel-f">
        <label for="ass-rel-f">Нет</label>
    </section>
</section>
<section>
    <label for="ass-rel-last-name">Фамилия</label>
    <input type="text" name="asa-rel-last-name" id="ass-rel-last-name" placeholder="Введите фамилию">
</section>
<section>
    <label for="ass-rel-first-name">Имя</label>
    <input type="text" name="ass-rel-first-name" id="ass-rel-first-name" placeholder="Введите имя">
</section>
<section>
    <label for="ass-rel-middle-name">Отчество</label>
    <input type="text" name="ass-rel-middle-name" id="ass-rel-middle-name" placeholder="Введите отчетство">
</section>
<section>
    <label for="ass-rel-with">Родственные связи с вами</label>
    <input type="text" name="ass-rel-with" id="ass-rel-with">
</section>
<section>
    <label for="ass-rel-status">Статус в Канаде</label>
    <input type="text" name="ass-rel-status" id="ass-rel-status">
</section>
<section>
    <label for="ass-rel-province">Провинция в Канаде</label>
    <select id="ass-rel-province" class="ass-province" name="ass-rel-province" required>
        <option value="" disabled selected>Выберите провинцию</option>
        <option value="ON">Ontario</option>
        <option value="QC">Quebec</option>
        <option value="NS">Nova Scotia</option>
        <option value="NB">New Brunswick</option>
        <option value="MB">Manitoba</option>
        <option value="BC">British Columbia</option>
        <option value="PE">Prince Edward Island</option>
        <option value="SK">Saskatchewan</option>
        <option value="AB">Alberta</option>
        <option value="NL">Newfoundland and Labrador</option>
    </select>
</section>