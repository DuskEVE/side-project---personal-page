<?php
if(!isset($_SESSION['user'])){
    echo "
    <script>
        alert('請先登入會員!');
        location.href = './index.php';
    </script>";
}

$user = $User->search(['user'=>$_SESSION['user']]);
?>

<div class="container d-flex justify-content-center">
    <div class="w-50 mt-3 mb-3">
        <fieldset>
            <input type="hidden" id="editId" value="<?=$user['id']?>">
            <legend class="text-light text-center">使用者編輯</legend>
            <div class="mt-3">
                <label class="form-label text-light" for="user">帳號:</label>
                <input class="form-control" type="text" name="user" id="editUser" value="<?=$user['user']?>">
            </div>
            <div class="mt-3">
                <label class="form-label text-light" for="password">密碼:</label>
                <input class="form-control" type="password" name="password" id="editPassword" value="<?=$user['password']?>">
            </div>
            <div class="mt-3">
                <label class="form-label text-light" for="email">電子信箱:</label>
                <input class="form-control" type="text" name="email" id="editEmail" value="<?=$user['email']?>">
            </div>
            <div class="mt-3 text-center">
                <button class="btn btn-primary edit-user-submit">確認編輯</button>
            </div>
        </fieldset>
    </div>
</div>