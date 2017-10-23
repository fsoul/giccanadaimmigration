<section>
    <label for="ass-rel-province">Провинция в Канаде</label>
    <select id="ass-rel-province" class="ass-province" required name="ass-rel-province" onchange="app.func.onProvinceChanged(this.value, 'ass-rel-city');">
        <option value="" disabled selected>Выберите провинцию</option>
	    <?= getProvinceOptions();?>
    </select>
    <span class="error-text" id="error-ass-rel-province"></span>
</section>
<section>
    <label for="ass-rel-city">Город</label>
    <select id="ass-rel-city" class="ass-city" name="ass-rel-city" required>
        <option value="" disabled selected>Выберите город</option>
    </select>
    <span class="error-text" id="error-ass-rel-city"></span>
</section>