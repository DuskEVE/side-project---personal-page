<?php
if(!isset($_SESSION['user'])) echo "<script>location.href = './index.php';</script>";
?>
<h3 class="text-center text-light">上傳圖片</h3>
<form action="./api/upload_gallery.php" method="post" enctype="multipart/form-data">
    <?="<input type='hidden' name='user' value='{$_SESSION['user']}'>"?>
    <div class="container d-flex m-3 text-light">

        <div class="w-50 p-3">
            <label class="form-label" for="title">請選擇上傳圖片</label>
            <input class="form-control gallery-input mb-3" type="file" name="file" id="file">
            <img class="gallery-upload-preview" src="">
        </div>

        <div class="w-50 p-3">

            <fieldset>
                <div class="mb-3">
                    <label class="form-label" for="title">標題:</label>
                    <input class="form-control" type="text" name="title" id="title">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="type">所屬類型:</label>
                    <select class="form-select" name="type_id">
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

                <div class="mb-3">
                    <label class="form-label" for="text">內容敘述:</label>
                    <textarea class="form-control" name="text" style="height: 200px"></textarea>
                </div>
            </fieldset>

        </div>
    </div>
    <div class="text-center">
        <input class="btn btn-secondary mb-3" type="submit" value="確認">
    </div>
</form>