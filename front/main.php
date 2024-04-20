

<div id="carouselAuto" class="carousel slide" data-bs-ride="carousel" style="height: 400px;">
    <div class="carousel-inner">
        <?php
        $types = $Type->searchAll();
        foreach($types as $index=>$type){
            $gallery = $Gallery->searchAll(['type_id'=>$type['id']], "order by `id` desc limit 1");
            $active = ($index==0? "active":"");
            if(count($gallery) > 0){
                echo "
                <div class='carousel-item $active'>
                    <a href='./index.php?do=gallery&type={$type['id']}'>
                        <img src='./gallery/{$gallery[0]['img']}' class='d-block m-auto gallery-carousel'>
                    </a>
                </div>
                ";
            }
        }
        ?>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAuto" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselAuto" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container">

    <?php
    foreach($types as $index=>$type){
        $banner = $Banner->search(['type_id'=>$type['id']]);
        if($index%3 == 0) echo "<div class='row m-3 p-3'>";
    ?>
    <div class="col col-md-4 mb-3">
        <div class="card bg-secondary m-auto" style="width: 18rem;">
            <img src="./banner/<?=$banner['img']?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center"><?=$type['name']?></h5>
                
                <div class="text-center">
                <a href="?do=gallery&type=<?=$type['id']?>" class="btn btn-primary">gallery</a>
                </div>
            </div>
        </div>
    </div>
    <?php
        if($index!=0 && $index%3==0) echo "</div>";
    }
    echo "</div>";
    ?>

</div>

<!-- <div class="row m-3 p-3" id="side-project">
    <div class="col col-md-4 mb-3">
        <div class="card m-auto" style="width: 18rem;">
        <img src="./img/s-01.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title text-center">萬年曆</h5>
            
            <div class="text-center">
            <a href="https://wda.mackliu.com/s1120415/calendar/" class="btn btn-primary">瀏覽</a>
            <a href="https://github.com/DuskEVE/PHP-Calendar" class="btn btn-success">原始碼</a>
            </div>
        </div>
        </div>
    </div>
</div> -->