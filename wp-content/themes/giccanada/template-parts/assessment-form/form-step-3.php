<section class="file-upload-container clearfix" id="photo-file">
    <div class="file-upload-button-container">
        <input type="file" onchange="" name="ass-photo" id="ass-photo" accept="image/*">
        <label class="ass-file-input-label">Пожалуйста, выберите свою фотографию</label>
        <label class="ass-file-input" for="ass-studied-files" onclick="app.croppie.croppieLoadImage();"><span>Загрузить файл</span></label>
    </div>
    <div id="added-photo"></div>
    <div style="width: 100%; height: 20px;" onclick="app.croppie.saveCroppedBlob();">SAVE</div>
</section>