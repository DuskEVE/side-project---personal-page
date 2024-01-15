<?php
if(!isset($_SESSION['admin'])) echo "<script>location.href = './index.php';</script>";
?>

<h3 class="text-center text-light">Account manage page</h3>

<div class="container">
    <form action="./api/manage_account.php" method="post">

        <table class="table table-dark text-center align-middle">
            <thead>
                <tr>
                    <th style="width: 70%;">橫幅圖片預覽</th>
                    <th style="width: 20%;">版面名稱</th>
                    <th style="width: 10%;">操作</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img class="banner-preview" src="./banner/<?=$Banner->search(['type_id'=>0])['img']?>">
                    </td>
                    <td>
                        Home page(defult)
                    </td>
                    <td>
                        <button class="btn btn-secondary" data-id="0">編輯版面橫幅圖片</button>
                    </td>
                </tr>
                
                <?php
                $datas = $Type->searchAll();
                foreach($datas as $data){
                ?>

                <tr>
                    <td>
                        <?php
                        $check = $Banner->count(['type_id'=>$data['id']]);
                        if($check){
                            $img = $Banner->search(['type_id'=>$data['id']])['img'];
                            echo "<img class='banner-preview' src='./banner/$img'>";
                            }
                        else echo "尚未上傳圖片";
                        ?>
                    </td>
                    <td>
                        <?=$data['name']?>
                    </td>
                    <td>
                        <button class="btn btn-secondary">編輯版面橫幅圖片</button>
                    </td>
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