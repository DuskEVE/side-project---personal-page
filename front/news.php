
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

<div class="container text-center news-page-bar">
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
    const newsPageBar = $('.news-page-bar');

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
            getPageBar(type);
            renderNews(response);
        });
    };
    const switchNewsType = (event) => {
        let typeId = $(event.target).data('id');
        newsContent.children().fadeOut(1000);
        setTimeout(() => {
            getNews(typeId);
        }, 1000);
    }
    const getPageBar = (type) => {
        newsPageBar.empty();
        $.get('./api/get_newsCount.php', {type_id: type}, (response) => {
            let pageCount = Math.ceil(response / 6);
            for(let i=1; i<=pageCount; i++){
                let btnColor = (i===1? "btn-primary":"btn-secondary");
                let btn = `
                    <button class='btn ${btnColor} news-page-btn m-2' data-id='${type}' data-page='${i}'>${i}</button>
                `;
                newsPageBar.append(btn);
                newsPageBar.children().last().on('click', changeNewsPage);
            }
        })
    }
    const changeNewsPage = (event) => {
        let typeId = $(event.target).data('id');
        let page = $(event.target).data('page');
        let start = (page-1) * 6;
        let end = start+6;
        let option = `order by \`id\` desc limit ${start},${end}`;
        
        $.get('./api/get_news.php', {type_id:typeId, option}, (response) => {
            response = JSON.parse(response);
            renderNews(response)
        });

        $(event.target).siblings('.btn-primary').removeClass('btn-primary').addClass('btn-secondary');
        $(event.target).removeClass('btn-secondary').addClass('btn-primary');
    };
    const renderNews = (response) => {
        let currentH = newsContent.height();
        newsContent.css({height:`${currentH}px`});
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

                $(element).hide().appendTo(newsContent).fadeIn(1000);
            }
            setTimeout(() => {
                gsap.to(newsContent, {
                    height:'auto',
                    duration: 1,
                }), 1000
            });
    };

    newsTypeBtn.on('click', switchNewsType)

    getTypeList();
    getNews(0);
</script>