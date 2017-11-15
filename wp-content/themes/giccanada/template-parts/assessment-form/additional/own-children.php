<?php ?>
<div class="delete-copy"><span class="added-file-delete" data-parent="#own-children" data-del="-copy<?=$index;?>"><i class="fa fa-times"></i></span></div>
<section>
	<label for="child-surname-<?=$index;?>">Фамилия</label>
	<input type="text" name="child[<?=$index?>][child-surname]" id="child-surname-<?=$index;?>" data-role="text">
	<span class="error-text" id="error-child-surname-<?=$index;?>"></span>
</section>
<section>
	<label for="child-name-<?=$index;?>">Имя</label>
	<input type="text" name="child[<?=$index?>][child-name]" id="child-name-<?=$index;?>" data-role="text">
	<span class="error-text" id="error-child-name-<?=$index;?>"></span>
</section>
<section class="combine-date birth-date">
	<div data-role="combine-date" id="child-birth-date-<?=$index;?>" data-msg="error-child-birth-date-<?=$index;?>">
		<label>Дата рождения</label>
		<div>
			<select title="" name="child[<?=$index?>][child-birth-day]" class="day" id="child-birth-day-<?=$index;?>" required
			        data-class="child-birth-date-<?=$index;?>" data-role="select">
				<option value="" disabled selected>Day</option>
				<?= getDayOptions(); ?>
			</select>

			<select title="" name="child[<?=$index?>][child-birth-month]" class="month" id="child-birth-month-<?=$index;?>" required
			        data-class="child-birth-date-<?=$index;?>" data-role="select">
				<option value="" disabled selected>Month</option>
				<?= getMonthOptions(); ?>
			</select>

			<select title="" name="child[<?=$index?>][child-birth-year]" class="year" id="child-birth-year-<?=$index;?>" required
			        data-class="child-birth-date-<?=$index;?>" data-role="select">
				<option value="" disabled selected>Year</option>
				<?= getYearOptions(); ?>
			</select>
		</div>
		<span class="error-text" id="error-child-birth-date-<?=$index;?>"></span>
	</div>
</section>
