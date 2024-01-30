
<div style="width: 100%; height: 50px;"></div>

<div class="container text-light">
    <div class="d-flex justify-content-around flex-wrap dusk-bg-gray">
        <a class="btn btn-warning m-3" href="">所有新聞</a>
        <?php
        $types = $Type->searchAll(['display'=>1]);
        foreach($types as $type){
            echo "<a class='btn btn-secondary m-3' href=''>{$type['name']}</a>";
        }
        ?>
    </div>

    <?php
    $newsList = $News->searchAll(['display'=>1], "order by `id` desc limit 6");
    $index = 0;
    for($i=0; $i<3; $i++){
        echo "<div class='row'>";
        for($j=0; $j<2; $j++){
            $news = $newsList[$index];
            $index++;
            $content = nl2br($news['text']);
            echo "
            <div class='mb-3 p-2 col-12 col-md-6'>
                <div class='dusk-bg-gray news-preview p-2'>
                    <h3 class='text-center'>{$news['title']}</h3>
                    <div class='d-flex justify-content-center'>
                        <img src=''>
                    </div>
                    <p>$content</p>
                </div>
            </div>";
            if($index+1 > count($newsList)) break;
        }
        echo "</div>";
        if($index+1 > count($newsList)) break;
    }
    ?>

</div>