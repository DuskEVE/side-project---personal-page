

<div id="carouselAuto" class="carousel slide" data-bs-ride="carousel" style="height: 400px;">
    <div class="carousel-inner">
        <?php
        foreach($types as $type){
            $gallery = $Gallery->searchAll(['type_id'=>$type['id']], "order by `id` desc limit 1");
            if(count($gallery) > 0){
                echo "
                <div class='carousel-item active'>
                    <a href='./index.php?do=gallery&type={$type['id']}'>
                        <img src='./gallery/{$gallery[0]['img']}' class='d-block m-auto gallery-carousel'>
                    </a>
                </div>
                ";
            }
        }
        ?>
        <!-- <div class="carousel-item active">
            <img src="https://picsum.photos/id/1/600/400" class="d-block m-auto" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://picsum.photos/id/2/600/400" class="d-block m-auto" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://picsum.photos/id/3/600/400" class="d-block m-auto" alt="...">
        </div> -->
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

<!-- <div class="text-center">
    <h3>This is main page in index</h3>
</div> -->