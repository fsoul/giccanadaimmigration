<section>
    <label for="ass-rel-province">Провинция в Канаде</label>
    <select id="ass-rel-province" class="ass-province" required name="ass-rel-province" onchange="app.func.onProvinceChanged(this.value, 'ass-rel-city');">
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
<section>
    <label for="ass-rel-city">Город</label>
    <select id="ass-rel-city" class="ass-city" required>
        <option value="" disabled selected>Выберите город</option>
    </select>
</section>