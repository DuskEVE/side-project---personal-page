<?php
if(!isset($_SESSION['admin'])) echo "<script>location.href = './index.php';</script>";
?>

<h3 class="text-center text-light">Account manage page</h3>

<div class="container">
    <form action="./api/manage_account.php" method="post">

        <table class="table table-dark text-center">
            <thead>
                <tr>
                    <th>使用者帳號</th>
                    <th>密碼</th>
                    <th>電子信箱</th>
                    <th>管理權限</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $datas = $User->searchAll();
                foreach($datas as $data){
                    if($data['user'] == 'admin') continue;
                ?>

                <input type="hidden" name="id[]" value="<?=$data['id']?>">
                <tr>
                    <td><?=$data['user']?></td>
                    <td><?=str_repeat("*", strlen($data['password']))?></td>
                    <td><?=$data['email']?></td>
                    <td><input class="form-check-input" type="checkbox" name="admin[]" value="<?=$data['id']?>" <?=$data['admin']==1?"checked":""?>></td>
                    <td><input class="form-check-input" type="checkbox" name="del[]" value="<?=$data['id']?>">刪除使用者</td>
                </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
        <div class="text-center">
            <input type="submit" class="btn btn-primary mb-3" value="確認修改">
        </div>
    </form>
</div>