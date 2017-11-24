<?php ?>
<section class="file-upload-container clearfix" id="canadian-education-files">
    <div class="file-upload-button-container">
        <input type="file" id="ass-studied-files" multiple accept="application/pdf, image/*"
               data-container="ass-studied-files-list" data-type="multiple" data-attach="att_educ" data-role="file-multiply" required>
        <label class="ass-file-input-label">Приложите подтверждающие документы</label>
        <label class="ass-file-input" for="ass-studied-files"><span>Загрузить файл</span></label>
        <span class="error-text add-btn-err" id="error-ass-studied-files"></span>
    </div>
    <div class="added-files" id="ass-studied-files-list"></div>
</section>
<section>