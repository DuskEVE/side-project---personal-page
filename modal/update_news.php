
<div class="modal-dialog">
    <div class="modal-content dusk-bg-lightgray text-light">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <form action="./api/update_news.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="news-id" value="0">
                <fieldset>
                    <legend>新增新聞</legend>
                    <div class="mt-3">
                        <label class="form-label" for="type">所屬類型</label>
                        <select class="form-select type-select" name="type_id">
                            <?php
                            $types = $Type->searchAll();
                            foreach($types as $type){
                                echo "<option id='option-{$type['id']}' value='{$type['id']}'>{$type['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label class="form-label" for="title">新聞標題:</label>
                        <input class="form-control news-title" type="text" name="title">
                    </div>
                    <div class="mt-3">
                        <label class="form-label" for="text">新聞內容:</label>
                        <textarea class="form-control news-text" name="text" style="height: 200px;"></textarea>
                    </div>
                    <div class="mt-3">
                        <input class="btn btn-success" type="submit" value="確認">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
