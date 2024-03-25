
<div style="width: 100%; height: 50px;"></div>

<div class="container text-light">
    <div class="d-flex justify-content-around flex-wrap dusk-bg-gray news-type-list">

    </div>

    <div class="container news-content d-flex flex-wrap">

    </div>

</div>

<div class="container text-center news-page-bar">

</div>

<script>
    const newsTypeList = $('.news-type-list');
    const newsTypeBtn = $('.news-type-btn');
    const newsContent = $('.news-content');
    const newsPageBar = $('.news-page-bar');
    let steamNews = null;
    // 用ajax方式向後端取得所有版面資訊(id和appid)，並且印出按鈕
    const getTypeList = () => {
        $.get('./api/get_type.php', {display:1}, (response) => {
            response = JSON.parse(response);
            for(let i=0; i<response.length; i++){
                let type = response[i];
                let btn = (i===0?"btn-warning":"btn-secondary");
                let element = `
                    <button class="btn ${btn} news-type-btn m-3" data-typeid='${type['id']}' data-appid='${type['appid']}'>${type['name']}</button>`;
                newsTypeList.append(element);
                $('.news-type-btn').last().on('click', switchNewsType);
            }

            let firstAppId = $('.news-type-btn').eq(0).data('appid');
            let typeId = $('.news-type-btn').eq(0).data('typeid');
            getNews(firstAppId);
            switchBanner(typeId);
        });
    };
    // 透過get_steamNews.php向steam提供的public api取得遊戲新聞(有CORS，所以無法直接在前端就用js去串steam的api)
    const getNews = (appid) => {
        $.get('./api/get_steamNews.php', {appid, count:20}, (response) => {
            response = JSON.parse(response);
            steamNews = response.appnews.newsitems;
            getPageBar();
            renderNews(steamNews, 1);
        });
    };
    // 切換顯示新聞的遊戲類別
    const switchNewsType = (event) => {
        let appid = $(event.target).data('appid');
        let typeId = $(event.target).data('typeid');
        $('.btn-warning').removeClass('btn-warning').addClass('btn-secondary');
        $(event.target).removeClass('btn-secondary').addClass('btn-warning');
        newsContent.children().fadeOut(1000);
        setTimeout(() => {
            getNews(appid);
        }, 1000);
        switchBanner(typeId);
    }
    // 印出分頁按鈕列
    const getPageBar = () => {
        newsPageBar.empty();

        let pageCount = Math.ceil(steamNews.length / 6);
        for(let i=1; i<=pageCount; i++){
            let btnColor = (i===1? "btn-primary":"btn-secondary");
            let btn = `
                <button class='btn ${btnColor} news-page-btn m-2' data-page='${i}'>${i}</button>
            `;
            newsPageBar.append(btn);
            newsPageBar.children().last().on('click', changeNewsPage);
        }

    }
    // 切換分頁
    const changeNewsPage = (event) => {
        let page = $(event.target).data('page');
        renderNews(steamNews, page);

        $(event.target).siblings('.btn-primary').removeClass('btn-primary').addClass('btn-secondary');
        $(event.target).removeClass('btn-secondary').addClass('btn-primary');
    };
    // 依指定的頁數印出新聞
    const renderNews = (news, page) => {
        let currentH = newsContent.height();
        newsContent.css({height:`${currentH}px`});
        newsContent.empty();

        let start = (page-1) * 6;
        let end = start + 6;
        if(end > steamNews.length) end = steamNews.length;
        for(let i=start; i<end; i++){
            let news = steamNews[i];
            let content = news['contents'];
            content = content.split('\n').join('</p><p>');

            let element = `
                <div class='mb-3 p-2 col-12 col-md-6 news-grid'>
                    <article class='dusk-bg-gray news-preview p-2'>
                        <h3 class='text-center'>${news['title']}</h3>
                        <p>${content}</p>
                    </article>
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
    // 按當前的新聞分類顯示不同的版面橫幅
    const switchBanner = (typeId) => {
        $.get('./api/get_banner.php', {type_id: typeId}, (response) => {
            response = JSON.parse(response);

            $('.top-img').fadeTo('slow', 0.3, function(){
                $(this).css({'background-image': `url(./banner/${response.img})`})
            }).fadeTo('slow', 1);
        });
    }

    newsTypeBtn.on('click', switchNewsType)

    getTypeList();
</script>