<section>
    <label for="ass-future-province">Провинция в Канаде</label>
    <select id="ass-future-province" class="ass-province" required name="ass-future-province" data-role="select"
            onchange="app.func.onProvinceChanged(this.value, 'ass-rel-city');">
        <option value="" disabled selected>Выберите провинцию</option>
	    <?= getProvinceOptions();?>
    </select>
    <span class="error-text" id="error-ass-future-province"></span>
</section>
<section>
    <label for="ass-future-city">Город</label>
    <select id="ass-future-city" class="ass-city" name="ass-future-city" required data-role="select">
        <option value="" disabled selected>Выберите город</option>
    </select>
    <span class="error-text" id="error-ass-future-city"></span>
</section>