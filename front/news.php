
<div style="width: 100%; height: 50px;"></div>

<div class="container text-light">
    <div class="d-flex justify-content-around flex-wrap dusk-bg-gray">
        <button class="btn btn-warning news-type-btn m-3" data-id='0'>所有新聞</button>
        <?php

        $types = $Type->searchAll(['display'=>1]);
        foreach($types as $type){
            echo "<button class='btn btn-secondary news-type-btn m-3' data-id='{$type['id']}'>{$type['name']}</button>";
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
            <div class='mb-3 p-2 col-12 col-md-6 news-grid'>
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

<div class="container text-center">
    <?php 
    $pageCount = ceil(($News->count(['display'=>1])) / 4);
    for($i=1; $i<=$pageCount; $i++){
        $btnColor = ($i==1? "btn-primary":"btn-secondary");
        echo "<button class='btn $btnColor news-page-btn m-2' data-page='$i'>$i</button>";
    }
    ?>
</div>