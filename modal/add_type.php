
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <form action="./api/add_type.php" method="post">
                <fieldset>
                    <legend>新增版面</legend>
                    <div class="mt-3">
                        <label class="form-label" for="name">版面名稱:</label>
                        <input class="form-control" type="text" name="name" id="name">
                    </div>
                    <div class="mt-3">
                        <input class="btn-secondary" type="submit" value="確認">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
