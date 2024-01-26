
<div style="width: 100%; height: 50px;"></div>

<div class="container text-light d-flex flex-column align-items-center">

    <?php
    $newsList = $News->searchAll(['display'=>1], "order by `id` desc limit 10");
    foreach($newsList as $index=>$news){
        $content = nl2br($news['text']);
        echo "
        <div class='mb-3 p-3 dusk-bg-gray news-preview col-12 col-md-6'>
            <h3 class='text-center'>{$news['title']}</h3>
            <div class='d-flex justify-content-center'>
                <img src=''>
            </div>
            <p>$content</p>
        </div>
        ";
    }
    ?>

    <!-- <div class="mb-3 p-3 dusk-bg-gray news-preview">
        <div class="d-flex justify-content-center">
            <img src="https://picsum.photos/id/1/300/300">
        </div>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Fuga, veniam aut deleniti eos voluptatum, 
            nostrum temporibus voluptates nam vel, 
            quas rem voluptas id similique. Omnis voluptas fugit saepe obcaecati necessitatibus?
        </p>
    </div>
    <div class="mb-3 p-3 dusk-bg-gray news-preview">
        <div class="d-flex justify-content-center">
            <img src="https://picsum.photos/id/2/300/300">
        </div>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Fuga, veniam aut deleniti eos voluptatum, 
            nostrum temporibus voluptates nam vel, 
            quas rem voluptas id similique. Omnis voluptas fugit saepe obcaecati necessitatibus?
        </p>
    </div>
    <div class="mb-3 p-3 dusk-bg-gray news-preview">
        <div class="d-flex justify-content-center">
            <img src="https://picsum.photos/id/3/300/300">
        </div>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Fuga, veniam aut deleniti eos voluptatum, 
            nostrum temporibus voluptates nam vel, 
            quas rem voluptas id similique. Omnis voluptas fugit saepe obcaecati necessitatibus?
        </p>
    </div> -->

</div>