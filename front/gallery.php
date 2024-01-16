<?php
$total = (isset($_GET['type'])? $Gallery->count(['type_id'=>$type]):$Gallery->count());
$pageCount = ceil($total / 20);
$currentPage = (isset($_GET['p'])? $_GET['p']:1);
$start = ($currentPage-1) * 20;
$end = ($currentPage==$pageCount? $total:$currentPage*20);
?>

<div class="container">
    <?php
    $gallerys;
    if(isset($_GET['type'])) $gallerys = $Gallery->searchAll(['type_id'=>$_GET['type']], "limit $start,20");
    else $gallerys = $Gallery->searchAll([], "limit $start,20");

    $index = 0;
    for($i=0; $i<5; $i++){
        echo "<div class='row'>";
        for($j=0; $j<4; $j++){
            $gallery = $gallerys[$index];
            echo "
            <div class='col-12 col-md-3 gallery-grid' data-id='{$gallery['id']}'>
                <img class='gallery-img' src='./gallery/{$gallery['img']}'>
                <div class='gallery-title'>
                    <span>{$gallery['title']}</span>
                    <span>{$gallery['user']}</span>
                </div>
            </div>
            ";

            $index++;
            if($index >= count($gallerys)) break;
        }
        echo "</div>";
        if($index >= count($gallerys)) break;
    }
    ?>
</div>

