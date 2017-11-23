<?php ?>
<div class="delete-copy"><span class="added-file-delete" data-parent="#own-work" data-del="-copy<?=$index;?>"><i class="fa fa-times"></i></span></div>
<section>
	<label for="company-name-<?=$index;?>">Наименование компании / нанимателя</label>
	<input type="text" name="work[<?=$index;?>][company-name]" id="company-name-<?=$index;?>" data-role="mixed" required>
	<span class="error-text" id="error-company-name-<?=$index;?>"></span>
</section>
<section>
	<label for="company-country-<?=$index;?>">Город, страна</label>
	<input type="text" name="work[<?=$index;?>][company-country]" id="company-country-<?=$index;?>" data-role="text" required>
	<span class="error-text" id="error-company-country-<?=$index;?>"></span>
</section>
<section>
	<label for="company-position-<?=$index;?>">Должность</label>
	<input type="text" name="work[<?=$index;?>][company-position]" id="company-position-<?=$index;?>" data-role="text" required>
	<span class="error-text" id="error-company-position-<?=$index;?>"></span>
</section>
<section>
	<div class="period-date clearfix" id="ass-company-period-<?=$index;?>" data-msg="error-ass-company-period-<?=$index;?>" data-role="period-date">
		<div>
			<div class="from-date clearfix">
				<label>Период работы, c</label>
				<select title="" class="month" name="work[<?=$index;?>][ass-company-from-m]" id="ass-company-from-m-<?=$index;?>"
				        required data-class="ass-company-period-<?=$index;?>" data-role="select">
					<option value="" disabled selected>Month</option>
					<?= getMonthOptions(); ?>
				</select>

				<select title="" class="year" name="work[<?=$index;?>][ass-company-from-y]" id="ass-company-from-y-<?=$index;?>"
				        required data-class="ass-company-period-<?=$index;?>" data-role="select">
					<option value="" disabled selected>Year</option>
					<?= getYearOptions(); ?>
				</select>
			</div>
			<div class="to-date clearfix">
				<label>по</label>
				<select title="" id="ass-company-to-m-<?=$index;?>" name="work[<?=$index;?>][ass-company-to-m]" class="month"
				        required data-class="ass-company-period-<?=$index;?>" data-role="select">
					<option value="" disabled selected>Month</option>
					<?= getMonthOptions(); ?>
				</select>

				<select title="" id="ass-company-to-y-<?=$index;?>" name="work[<?=$index;?>][ass-company-to-y]" class="year"
				        required data-class="ass-company-period-<?=$index;?>" data-type="period-date-select" data-role="select">
					<option value="" disabled selected>Year</option>
					<?= getYearOptions(); ?>
				</select>
			</div>
			<span class="error-text" id="error-ass-company-period-<?=$index;?>"></span>
		</div>
	</div>
</section>
<section>
	<label for="company-requirement-<?=$index;?>">Должностные обязанности</label>
	<textarea name="work[<?=$index;?>][company-requirement]" id="company-requirement-<?=$index;?>" rows="4"
	          cols="50" data-role="mixed" required></textarea>
	<span class="error-text" id="error-company-requirement-<?=$index;?>"></span>
</section>
