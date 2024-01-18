<?php
if(!isset($_SESSION['admin'])) echo "<script>location.href = './index.php';</script>";
?>

<h3 class="text-center text-light">Manage page</h3>

<div class="container">

    <div class="text-center">
        <button class="btn btn-success add-type-btn mb-3">新增版面</button>
    </div>

    <table class="table table-dark text-center align-middle">
        <thead>
            <tr>
                <th style="width: 60%;">橫幅圖片預覽</th>
                <th style="width: 20%;">版面名稱</th>
                <th style="width: 20%;">操作</th>
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
                    <button class="btn btn-success edit-banner-btn" data-id="0" data-name="Home page">更新版面橫幅圖片</button>
                </td>
            </tr>
            
            <?php
            $datas = $Type->searchAll();
            foreach($datas as $data){
            ?>

            <tr id="type-<?=$data['id']?>">
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
                    <div class="d-flex flex-column align-items-center">
                        <button class="m-1 btn btn-success edit-banner-btn" 
                                data-id="<?=$data['id']?>" data-name="<?=$data['name']?>">
                            編輯版面橫幅圖片
                        </button>
                        <button class="m-1 btn <?=($data['display']==1?"btn-secondary":"btn-primary")?> display-type-btn" 
                                data-id="<?=$data['id']?>">
                            <?=($data['display']==1?"隱藏版面":"顯示版面")?>
                        </button>
                        <button class="m-1 btn btn-danger delete-type-btn" 
                                data-id="<?=$data['id']?>">
                            刪除版面
                        </button>
                    </div>
                </td>
            </tr>

            <?php
            }
            ?>
        </tbody>
    </table>

</div>