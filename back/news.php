<?php
if(!isset($_SESSION['admin'])) echo "<script>location.href = './index.php';</script>";
?>

<h3 class="text-center text-light">News manage page</h3>

<div class="container">
    <div class="text-center">
        <button class="btn btn-success update-news-btn mb-3" data-id="0">新增新聞</button>
    </div>

    <form action="./api/update_news.php" method="post">

        <table class="table table-dark text-center align-middle">
            <thead>
                <tr>
                    <th style="width: 20%;">標題</th>
                    <th style="width: 20%;">所屬類別</th>
                    <th style="width: 40%;">內容</th>
                    <th style="width: 20%;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $datas = $News->searchAll();
                foreach($datas as $data){
                    $type = $Type->search(['id'=>$data['type_id']])['name'];
                ?>

                <input type="hidden" name="id[]" value="<?=$data['id']?>">
                <tr>
                    <td><?=$data['title']?></td>
                    <td><?=$type?></td>
                    <td><?=nl2br(mb_substr($data['text'], 0, 50))."..."?></td>
                    <td>
                        <span>
                            <input type="checkbox" name="display[]" value="<?=$data['id']?>" <?=($data['display']==1?"checked":"")?>>顯示&nbsp;
                        </span>
                        <input type="checkbox" name="del[]" value="<?=$data['id']?>">刪除&nbsp;
                        <div class="btn btn-success update-news-btn" data-id="<?=$data['id']?>">編輯</div>
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