
const navBar = document.querySelector(".navbar");
const navPlaceholder = document.querySelector(".nav-placeholder");
const loginBtn = $('.login-btn');
const loginModal = new bootstrap.Modal("#login-modal", {backdrop:'static'});
const loginSubmit = $('.login-submit');
const logoutBtn = $('.logout-btn');
const regSubmit = $('.reg-submit');
const galleryGrid = $('.gallery-grid');
const editBannerBtn = $('.edit-banner-btn');
const addTypeModal = new bootstrap.Modal("#add-type-modal", {backdrop:'static'});
const editBannerModal = new bootstrap.Modal("#edit-banner-modal", {backdrop:'static'});
const bannerInput = $('.banner-input');
const addTypeBtn = $('.add-type-btn');
const displayTypeBtn = $('.display-type-btn');
const deleteTypeBtn = $('.delete-type-btn');
const galleryInput = $('.gallery-input');
const galleryViewModal = new bootstrap.Modal("#gallery-view-modal");
const editUserSubmit = $('.edit-user-submit');
const galleryLikeBtn = $('.gallery-like-btn');
const galleryDeleteBtn = $('.gallery-delete-btn');
const updateNewsModal = new bootstrap.Modal("#update-news-modal");
const updateNewsBtn = $('.update-news-btn');
const newsPreview = $('.news-preview');

// 讓navbar在視窗向下滾動30vh後(banner的高度)固定在最上方(fixed-top)
const navbarFixed = () => {
    if (window.scrollY > window.innerHeight*0.3) {
        navBar.classList.add("fixed-top");
        navPlaceholder.setAttribute("style", "height: 56.8px");
    }
    else {
        navBar.classList.remove("fixed-top");
        navPlaceholder.setAttribute("style", "height: 0px");
    }
};
const loginPop = () => {
    loginModal.show();
};
const login = () => {
    let user = {user: $('#user').val(), password: $('#password').val()};
    // 用ajax的方式向後端送出使用者登入資料，若成功登入就重整頁面，登入失敗的話用alert印出錯誤訊息
    $.post('./api/login_check.php', user, (response) => {
        if(response === 'success') location.reload();
        else alert(response);
    });
};
const logout = () => {
    $.post('./api/logout.php', () => location.reload());
};
const reg = () => {
    let user = $('#regUser').val();
    let password = $('#regPassword').val();
    let email = $('#regEmail').val();
    // 用RegExp驗證密碼內容，只允許英文字母大小寫和數字
    let regex = new RegExp('^[a-zA-Z0-9]*$');
    // 先檢查過註冊的資料是否符合規範，再用ajax的方式將資料傳到後端
    if(user.length < 4) alert('請輸入長度至少為4的使用者帳號');
    else if(password.length < 4) alert('請輸入長度至少為4的密碼');
    else if(!regex.test(user) || !regex.test(password)) alert('帳號和密碼只允許英文大小寫字母和數字!');
    else if(email.split('@').length <= 1) alert('請輸入正確格式的電子郵件');
    else{
        $.post('./api/reg.php', {user, password, email}, (response) => {
            if(response === 'success'){
                alert('註冊成功!');
                location.href = './index.php';
            }
            else alert(response);
        });
    }
};
// 當滑鼠移到預覽圖片(gallery grid)上時，顯示相關資訊(標題和按讚人數)
const titleShow = (event) => {
    let title = $(event.target).find('.gallery-info');
    title.css({'visibility': 'visible'}).animate({opacity: 1.0}, 200);
};
// 當滑鼠離開預覽圖片(gallery grid)上時，隱藏相關資訊(標題和按讚人數)
const titleHide = (event) => {
    let title = $(event.target).find('.gallery-info');
    title.css({'visibility': 'hide'}).animate({opacity: 0}, 200);
};
// 點擊編輯版面橫幅按鈕時讓bootstra modal視窗顯示，並同時以ajax的方式向後端抓取目標版面的資料
const editBannerPop = (event) => {
    let id = $(event.target).data('id');
    let appid = $(event.target).data('appid');
    let name = $(event.target).data('name');

    $('#type-id').val(id);
    if(id !== 0){
        $('#type-name').parent().show();
        $('#type-name').val(name);
    }
    else $('#type-name').parent().hide();
    if(appid !== undefined){
        $('#type-appid').parent().show();
        $('#type-appid').val(appid);
    }
    else $('#type-appid').parent().hide();
    editBannerModal.show();
};
// 即時產生上傳橫幅圖片的預覽圖
const bannerPreview = (event) => {
    let file = event.target.files[0];
    if(file){
        $('.banner-upload-preview').attr('src', URL.createObjectURL(file));
    }
};
// 即時產生上傳圖片的預覽圖
const galleryPreview = (event) => {
    let file = event.target.files[0];
    if(file){
        $('.gallery-upload-preview').attr('src', URL.createObjectURL(file));
    }
}
// 點及圖片縮圖(gallery grid)時，顯示bootstrap modal並且同時以ajax方式抓取目標圖片的相關資料並更新在modal上
const galleryDisplay = (event) => {
    let id = $(event.target).data('id');
    let user = $(event.target).data('user');
    $.post('./api/get_gallery.php', {id}, (response) => {
        response = JSON.parse(response);
        $('.gallery-view').attr('src', `./gallery/${response['img']}`);
        $('.gallery-view-title').text(response['title']);
        $('.gallery-view-text').text(response['text']);
        $('#gallery-view-modal').find('.gallery-like-btn').attr('data-id', id);
    });
    // 如果是登入的使用者，則額外檢查是否對該圖片有按過讚
    if(user.length > 0){
        $.post('./api/check_like.php', {id, user}, (response) => {
            if(response === '1'){
                $('#gallery-view-modal').find('i').attr('class', 'fa-solid fa-heart');
                $('#gallery-view-modal').find('.gallery-like-btn').removeClass('btn-secondary').addClass('btn-primary');
            }
            else{
                $('#gallery-view-modal').find('i').attr('class', 'fa-regular fa-heart');
                $('#gallery-view-modal').find('.gallery-like-btn').removeClass('btn-primary').addClass('btn-secondary');
            }
        });
        // 檢查登入的使用者是否為該圖片的上傳者，是的話則顯示刪除圖片按鈕
        $.post('./api/check_user.php', {id, user}, (response) => {
            if(response === '1'){
                galleryDeleteBtn.attr('id', id);
                galleryDeleteBtn.show();
            }
        });
    }
    galleryViewModal.show();
};
// 編輯已註冊使用者，和註冊大致相同
const editUser = () => {
    let id = $('#editId').val();
    let user = $('#editUser').val();
    let password = $('#editPassword').val();
    let email = $('#editEmail').val();

    if(user.length < 4) alert('請輸入長度至少為4的使用者帳號');
    else if(password.length < 4) alert('請輸入長度至少為4的密碼');
    else if(email.split('@').length <= 1) alert('請輸入正確格式的電子郵件');
    else{
        $.post('./api/edit_user.php', {id, user, password, email}, (response) => {
            if(response === 'success'){
                alert('修改成功!');
                location.href = './index.php';
            }
            else alert(response);
        });
    }
};
// 點擊喜歡按鈕後，透過ajex的方式向後端傳送資料，並透過回傳資料及時改變按鈕狀態和按讚人數計數
const like = (event) => {
    let id = $(event.target).data('id');
    let likeCount = $(`#gallery-${id}`).find('.like-count');
    let count = Number(likeCount.text());
    let user = $(event.target).data('user');
    $.post('./api/like.php', {id, user}, (response) => {
        if(response == '1'){
            $(event.target).removeClass('btn-secondary').addClass('btn-primary');
            $(event.target).find('i').addClass('fa-solid').removeClass('fa-regular');
            $(`#gallery-${id}`).find('i').addClass('fa-solid').removeClass('fa-regular');
            likeCount.text(`${(count+1)}`);
            gsap.to(event.target, {
                width:'+=30',
                height:'+=20',
                duration: 0.5,
            })
            gsap.to(event.target, {
                width:'-=30',
                height:'-=20',
                duration: 0.5,
                delay:0.5
            })
        }
        else{
            $(event.target).removeClass('btn-primary').addClass('btn-secondary');
            $(event.target).find('i').addClass('fa-regular').removeClass('fa-solid');
            $(`#gallery-${id}`).find('i').addClass('fa-regular').removeClass('fa-solid');
            likeCount.text(`${(count-1)}`);
        }
    });
};
const addTypePop = () => {
    addTypeModal.show();
};
// 於管理頁面控制版面使否顯示給使用者和遊客，透過ajax向後端發出請求並即時改變按鈕狀態
const displayType = (event) => {
    let id = $(event.target).data('id');
    $.post('./api/display_type.php', {id}, (response) => {
        if(response === '1'){
            $(event.target).removeClass('btn-primary').addClass('btn-secondary');
            $(event.target).text('隱藏版面');
        }
        else{
            $(event.target).removeClass('btn-secondary').addClass('btn-primary');
            $(event.target).text('顯示版面');
        }

        // reload gallery nav drop-down
        $.get('./api/get_type.php', {display: 1}, (response) => {
            let menus = JSON.parse(response);
            const galleryNav = $('#gallery-nav');
            galleryNav.empty();
            menus.forEach(menu => {
                let element = `
                <li><a class='dropdown-item' href='./index.php?do=gallery&type=${menu['id']}'>${menu['name']}</a></li>
                <li><hr class='dropdown-divider'></li>
                `;
                galleryNav.append(element);
            });
        });
    });
};
// 刪除版面
const deleteType = (event) => {
    let id = $(event.target).data('id');
    $.post('./api/delete_type.php', {id}, () => {
        $(`#type-${id}`).remove();
    });
};
// 刪除圖片
const galleryDelete = (event) => {
    let id = Number($(event.target).attr('id'));
    $.post('./api/delete_gallery.php', {id}, () => {
        $(`.gallery-grid[data-id=${id}]`).css({'pointer-events':'none'}).empty();
        galleryViewModal.hide();
    });
}
const updateNewsPop = (event) => {
    let id = $(event.target).data('id');
    $('#news-id').val(id);
    // 如果data-id=0，代表是按下新增按鈕，其餘則是編輯按鈕
    if(id !== 0){
        $.post('./api/get_news.php', {id}, (response) => {
            response = JSON.parse(response);
            $('.type-select').children().each((index, element) => {
                if(Number($(element).val()) === response.type_id) $(element).attr('selected', 'selected');
                else $(element).attr('selected', null);
                console.log(response.type_id, Number($(element).val()));
            });
            $('.news-title').val(response.title);
            $('.news-text').val(response.text);
        })
    }
    else{
        $('.type-select').children().each((index, element) => {
            if(index === 0) $(element).attr('selected', 'selected');
            else $(element).attr('selected', null);
        });
        $('.news-title').val('');
        $('.news-text').val('');
    }

    updateNewsModal.show();
}

addEventListener('scroll', navbarFixed);
loginBtn.on('click', loginPop);
loginSubmit.on('click', login);
logoutBtn.on('click', logout);
regSubmit.on('click', reg);
galleryGrid.on('mouseover', titleShow);
galleryGrid.on('mouseout', titleHide);
galleryGrid.on('click', galleryDisplay);
editBannerBtn.on('click', editBannerPop);
addTypeBtn.on('click', addTypePop);
displayTypeBtn.on('click', displayType);
deleteTypeBtn.on('click', deleteType);
bannerInput.on('change', bannerPreview);
galleryInput.on('change', galleryPreview);
editUserSubmit.on('click', editUser);
galleryLikeBtn.on('click', like);
galleryDeleteBtn.on('click', galleryDelete);
updateNewsBtn.on('click', updateNewsPop);
