
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <!-- <h1 class="modal-title fs-5" id="edit-banner-modal-label">版面橫幅編輯</h1> -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <form action="./api/edit_banner.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>版面橫幅編輯</legend>
                    <div class="mt-3">
                        <label class="form-label" for="type">版面:</label>
                        <select class="form-control" name="type" id="type">
                            <option value="0">Home page(defult)</option>
                            <?php
                            $types = $Type->searchAll();
                            foreach($types as $type){
                            ?>
                            <option value="<?=$type['id']?>"><?=$type['name']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label class="form-label" for="file">上傳圖片:</label>
                        <input class="form-control" type="file" name="file" id="file">
                    </div>
                    <div class="mt-3">
                        <input class="btn-secondary" type="submit" value="確認">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
