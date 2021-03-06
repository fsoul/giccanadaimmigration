<?php ?>
<div class="delete-copy"><span class="added-file-delete" data-parent="#canada-relations" data-del="-copy<?=$index;?>"><i class="fa fa-times"></i></span></div>
<section>
	<label for="ass-rel-last-name-<?=$index;?>">Фамилия</label>
	<input type="text" id="ass-rel-last-name-<?=$index;?>" placeholder="Введите фамилию" data-role="text" name="relative[rel-<?=$index;?>][ass-rel-last-name]" required>
	<span class="error-text" id="error-ass-rel-last-name-<?=$index;?>"></span>
</section>
<section>
	<label for="ass-rel-first-name-<?=$index;?>">Имя</label>
	<input type="text" id="ass-rel-first-name-<?=$index;?>" placeholder="Введите имя" data-role="text" name="relative[rel-<?=$index;?>][ass-rel-first-name]" required>
	<span class="error-text" id="error-ass-rel-first-name-<?=$index;?>"></span>
</section>
<section>
	<label for="ass-rel-with-<?=$index;?>">Родственные связи с вами</label>
	<input type="text" id="ass-rel-with-<?=$index;?>" data-role="text" name="relative[rel-<?=$index;?>][ass-rel-with]" required>
	<span class="error-text" id="error-ass-rel-with-<?=$index;?>"></span>
</section>
<section>
	<label for="ass-rel-status-<?=$index;?>">Статус в Канаде</label>
	<input type="text" id="ass-rel-status-<?=$index;?>" data-role="text" name="relative[rel-<?=$index;?>][ass-rel-status]" required>
	<span class="error-text" id="error-ass-rel-status-<?=$index;?>"></span>
</section>
<section>
	<label for="ass-rel-province-<?=$index;?>">Провинция в Канаде</label>
	<select id="ass-rel-province-<?=$index;?>" class="ass-province" required data-role="select" name="relative[rel-<?=$index;?>][ass-rel-province]">
		<option value="" disabled selected>Выберите провинцию</option>
		<?= getProvinceOptions();?>
	</select>
	<span class="error-text" id="error-ass-rel-province-<?=$index;?>"></span>
</section>
