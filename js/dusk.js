
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
    let regex = new RegExp('^[a-zA-Z0-9]*$');

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
const titleShow = (event) => {
    let title = $(event.target).find('.gallery-info');
    title.css({'visibility': 'visible'}).animate({opacity: 1.0}, 200);
};
const titleHide = (event) => {
    let title = $(event.target).find('.gallery-info');
    title.css({'visibility': 'hide'}).animate({opacity: 0}, 200);
};
const editBannerPop = (event) => {
    let id = $(event.target).data('id');
    let name = $(event.target).data('name');
    $('#type-id').attr('value', id);
    $('#type-label').text(`版面: ${name}`);
    editBannerModal.show();
};
const bannerPreview = (event) => {
    let file = event.target.files[0];
    if(file){
        $('.banner-upload-preview').attr('src', URL.createObjectURL(file));
    }
};
const galleryPreview = (event) => {
    let file = event.target.files[0];
    if(file){
        $('.gallery-upload-preview').attr('src', URL.createObjectURL(file));
    }
}
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
        $.post('./api/check_user.php', {id, user}, (response) => {
            if(response === '1'){
                galleryDeleteBtn.attr('id', id);
                galleryDeleteBtn.show();
            }
        });
    }
    galleryViewModal.show();
};
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
    });
};
const deleteType = (event) => {
    let id = $(event.target).data('id');
    $.post('./api/delete_type.php', {id}, () => {
        $(`#type-${id}`).remove();
    });
};
const galleryDelete = (event) => {
    let id = Number($(event.target).attr('id'));
    $.post('./api/delete_gallery.php', {id}, () => {
        $(`.gallery-grid[data-id=${id}]`).css({'pointer-events':'none'}).empty();
        galleryViewModal.hide();
    });
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
