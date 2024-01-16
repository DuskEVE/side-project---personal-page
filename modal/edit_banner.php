
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <form action="./api/edit_banner.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="type-id">
                <fieldset>
                    <legend>版面橫幅編輯</legend>
                    <div class="mt-3">
                        <label class="form-label" id="type-label" for="type"></label>
                    </div>
                    <div class="mt-3">
                        <label class="form-label" for="file">上傳圖片:</label>
                        <input class="form-control banner-input" type="file" name="file" id="file">
                    </div>
                    <div class="mt-3">
                        <img class="banner-upload-preview" src="">
                    </div>
                    <div class="mt-3">
                        <input class="btn-secondary" type="submit" value="確認">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
