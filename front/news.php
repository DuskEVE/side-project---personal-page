
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

    const getTypeList = () => {
        $.get('./api/get_type.php', {display:1}, (response) => {
            response = JSON.parse(response);
            for(let i=0; i<response.length; i++){
                let type = response[i];
                let element = `
                    <button class="btn btn-secondary news-type-btn m-3" data-typeId='${type['id']}' data-appid='${type['appid']}'>${type['name']}</button>`;
                newsTypeList.append(element);
                $('.news-type-btn').last().on('click', switchNewsType);
            }
        });
    };
    const getNews = (appid) => {
        // if... 網頁首次載入時
        $.get('./api/get_steamNews.php', {appid, count:30}, (response) => {
            response = JSON.parse(response);
            steamNews = response.appnews.newsitems;
            getPageBar();
            renderNews(steamNews, 1);
        });
    };
    const switchNewsType = (event) => {
        let appid = $(event.target).data('appid');
        let typeId = $(event.target).data('typeId');
        newsContent.children().fadeOut(1000);
        setTimeout(() => {
            getNews(appid);
        }, 1000);
        switchBanner(typeId);
    }
    const getPageBar = () => {
        newsPageBar.empty();

        let pageCount = Math.ceil(steamNews / 6);
        for(let i=1; i<=pageCount; i++){
            let btnColor = (i===1? "btn-primary":"btn-secondary");
            let btn = `
                <button class='btn ${btnColor} news-page-btn m-2' data-id='${type}' data-page='${i}'>${i}</button>
            `;
            newsPageBar.append(btn);
            newsPageBar.children().last().on('click', changeNewsPage);
        }

    }
    const changeNewsPage = (event) => {
        let page = $(event.target).data('page');
        renderNews(steamNews, page);

        $(event.target).siblings('.btn-primary').removeClass('btn-primary').addClass('btn-secondary');
        $(event.target).removeClass('btn-secondary').addClass('btn-primary');
    };
    const renderNews = (news, page) => {
        let currentH = newsContent.height();
        newsContent.css({height:`${currentH}px`});
        newsContent.empty();

        let start = (page-1) * 6;
        let end = start + 6;
        if(end > steamNews.length) end = steamNews.length;
        for(let i=start; i<end; i++){
            let news = steamNews[i];

            let element = `
                <div class='mb-3 p-2 col-12 col-md-6 news-grid'>
                    <div class='dusk-bg-gray news-preview p-2'>
                        <h3 class='text-center'>${news['title']}</h3>
                        ${news['contents']}
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
    getNews(359320);
</script>