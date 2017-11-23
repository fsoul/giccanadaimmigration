<?php ?>
<section class="file-upload-container clearfix" id="canadian-work-files">
	<div class="file-upload-button-container">
		<input type="file"id="ass-worked-files" multiple accept="application/pdf, image/*"
		       data-container="canadian-work-files-list" data-type="multiple" data-attach="att_work" data-role="file-multiply" required>
		<label class="ass-file-input-label">Приложите подтверждающие документы</label>
		<label class="ass-file-input" for="ass-worked-files"><span>Загрузить файл</span></label>
		<span class="error-text add-btn-err" id="error-ass-worked-files"></span>
	</div>
	<div class="added-files" id="canadian-work-files-list"></div>
</section>
<section>
<section class="radio-block">
	<label>Работал(а) ли супруг(а) в Канаде по рабочей визе последний год?</label>
	<section>
		<input name="ass-partner-worked-at-canada" class="ass-radio" value="f" checked
		       type="radio" id="ass-partner-worked-at-canada-f" data-role="radio" required>
		<label for="ass-partner-worked-at-canada-f">Нет</label>
	</section>
	<section>
		<input name="ass-partner-worked-at-canada" class="ass-radio" value="t"
		       type="radio" id="ass-partner-worked-at-canada-t" data-role="radio" required>
		<label for="ass-partner-worked-at-canada-t">Да</label>
	</section>
</section>
