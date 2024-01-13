const navBar = document.querySelector(".navbar");
const navPlaceholder = document.querySelector(".nav-placeholder");
const loginBtn = $('.login-btn');
const loginModal = new bootstrap.Modal("#login-modal", {backdrop:'static'});
const loginSubmit = $('.login-submit');
const logoutBtn = $('.logout-btn');
const regSubmit = $('.reg-submit');

const navbarFixed = () => {
    if (window.scrollY > window.innerHeight*0.2) {
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

    if(user.length < 4) alert('請輸入長度至少為4的使用者帳號');
    else if(password.length < 4) alert('請輸入長度至少為4的密碼');
    else if(email.split('@').length <= 1) alert('請輸入正確格式的電子郵件');
    else{
        $.post('./api/reg.php', {user, password, email}, (response) => {
            if(response === 'success') location.href = './index.php';
            else alert(response);
        });
    }
};

addEventListener('scroll', navbarFixed);
loginBtn.on('click', loginPop);
loginSubmit.on('click', login);
logoutBtn.on('click', logout);
regSubmit.on('click', reg);