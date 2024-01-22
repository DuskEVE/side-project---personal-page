<?php
$total;
if(isset($_GET['type'])) $total = $Gallery->count(['type_id'=>$_GET['type']]);
else if(isset($_GET['user'])) $total = $Gallery->count(['user'=>$_GET['user']]);
else $total = $Gallery->count();
$pageCount = ceil($total / 20);
$currentPage = (isset($_GET['p'])? $_GET['p']:1);
$start = ($currentPage-1) * 20;
$end = ($currentPage==$pageCount? $total:$currentPage*20);
?>

<div class="container">
    <div class="d-flex justify-content-center">
        <button class="btn btn-warning m-3">最新上傳</button>
        <button class="btn btn-secondary m-3">最多人喜歡</button>
    </div>

    <?php
    $gallerys;
    $option = "order by `id` desc limit $start,20";
    if(isset($_GET['type'])) $gallerys = $Gallery->searchAll(['type_id'=>$_GET['type']], $option);
    else if(isset($_GET['user'])) $gallerys = $Gallery->searchAll(['user'=>$_GET['user']], $option);
    else $gallerys = $Gallery->searchAll([], $option);

    $user = "";
    if(isset($_SESSION['user'])) $user = $_SESSION['user'];
    $index = 0;
    if($total > 0){
        for($i=0; $i<5; $i++){
            echo "<div class='row'>";
            for($j=0; $j<4; $j++){
                $gallery = $gallerys[$index];
                $like = 'fa-regular';
                if(strlen($user)>0 && $GalleryLike->count(['gallery_id'=>$gallery['id'], 'user'=>$user])) $like = 'fa-solid';
                echo "
                <div class='col-12 col-md-3 gallery-grid' data-id='{$gallery['id']}' data-user='"
                    .(isset($_SESSION['user'])? $_SESSION['user']:"")."'>
                    <img class='gallery-img' src='./gallery/{$gallery['img']}'>
                    <div class='gallery-info'>
                        <div class='gallery-title ps-2'>{$gallery['title']}</div>
                        <div class='gallery-user ps-2'>{$gallery['user']}</div>
                        <div class='gallery-like' id='gallery-{$gallery['id']}'>
                            <i class='$like fa-heart'></i>
                            <span class='like-count'>{$gallery['like_count']}</span>
                        </div>
                    </div>
                </div>
                ";

                $index++;
                if($index >= count($gallerys)) break;
            }
            echo "</div>";
            if($index >= count($gallerys)) break;
        }
    }

    if($pageCount > 1){
        echo "<div class='container mb-3 text-center'>";
        for($i=1; $i<=$pageCount; $i++){
            $target = "";
            if(isset($_GET['type'])) $target = "&type={$_GET['type']}";
            else if(isset($_GET['user'])) $target = "&user={$_GET['user']}";
            $btn = ($i==$currentPage? "btn-primary":"btn-secondary");
            echo "<a class='btn $btn ms-2 me-2' href='./index.php?do=gallery$target&p=$i'>$i</a>";
        }
    }
    ?>
</div>

