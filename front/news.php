
<div style="width: 100%; height: 50px;"></div>

<div class="container text-light">
    <div class="d-flex justify-content-around flex-wrap dusk-bg-gray news-type-list">
        <button class="btn btn-warning news-type-btn m-3" data-id='0'>所有新聞</button>
        <?php
        // $types = $Type->searchAll(['display'=>1]);
        // foreach($types as $type){
        //     echo "<button class='btn btn-secondary news-type-btn m-3' data-id='{$type['id']}'>{$type['name']}</button>";
        // }
        ?>
    </div>

    <div class="container news-content d-flex flex-wrap">

    </div>

    <?php
    // $newsList = $News->searchAll(['display'=>1], "order by `id` desc limit 6");
    // $index = 0;
    // for($i=0; $i<3; $i++){
    //     echo "<div class='row'>";
    //     for($j=0; $j<2; $j++){
    //         $news = $newsList[$index];
    //         $index++;
    //         $content = nl2br($news['text']);
    //         echo "
    //         <div class='mb-3 p-2 col-12 col-md-6 news-grid'>
    //             <div class='dusk-bg-gray news-preview p-2'>
    //                 <h3 class='text-center'>{$news['title']}</h3>
    //                 <div class='d-flex justify-content-center'>
    //                     <img src=''>
    //                 </div>
    //                 <p>$content</p>
    //             </div>
    //         </div>";
    //         if($index+1 > count($newsList)) break;
    //     }
    //     echo "</div>";
    //     if($index+1 > count($newsList)) break;
    // }
    ?>
</div>

<div class="container text-center">
    <?php 
    // $pageCount = ceil(($News->count(['display'=>1])) / 4);
    // for($i=1; $i<=$pageCount; $i++){
    //     $btnColor = ($i==1? "btn-primary":"btn-secondary");
    //     echo "<button class='btn $btnColor news-page-btn m-2' data-page='$i'>$i</button>";
    // }
    ?>
</div>

<script>
    const newsTypeList = $('.news-type-list');
    const newsTypeBtn = $('.news-type-btn');
    const newsContent = $('.news-content');

    const getTypeList = () => {
        $.get('./api/get_type.php', {display:1}, (response) => {
            response = JSON.parse(response);
            for(let i=0; i<response.length; i++){
                let type = response[i];
                let element = `
                    <button class="btn btn-secondary news-type-btn m-3" data-id='${type['id']}'>${type['name']}</button>`;
                newsTypeList.append(element);
                $('.news-type-btn').last().on('click', switchNewsType);
            }
        });
    };
    const getNews = (type) => {
        let option = 'order by `id` desc limit 6';
        $.get('./api/get_news.php', {type_id:type, option}, (response) => {
            response = JSON.parse(response);
            newsContent.empty();

            for(let i=0; i<response.length; i++){
                let news = response[i];
                news['text'] = news['text'].replace('/n', '<br>')
                let element = `
                    <div class='mb-3 p-2 col-12 col-md-6 news-grid'>
                        <div class='dusk-bg-gray news-preview p-2'>
                            <h3 class='text-center'>${news['title']}</h3>
                            <p>${news['text']}</p>
                        </div>
                    </div>`;

                newsContent.append(element);
            }
        });
    };
    const switchNewsType = (event) => {

    }
    const changeNewsPage = (event) => {
        let typeId = $(event.target).data('id');
        let option = 'order by `id` desc limit 6';

        $.post('./api/get_news.php', {type_id:typeId, option}, (response) => {
            response = JSON.parse(response);
            // switch displayed news
        });

    };

    newsTypeBtn.on('click', switchNewsType)

    getTypeList();
    getNews(0);
</script>