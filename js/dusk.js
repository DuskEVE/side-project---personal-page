const navBar = document.querySelector(".navbar");
const navPlaceholder = document.querySelector(".nav-placeholder");
const loginBtn = $('.login-btn');
const loginModal = new bootstrap.Modal("#login-modal", {backdrop:'static'});
const loginSubmit = $('.login-submit');
const logoutBtn = $('.logout-btn');

function navbarFixed(){
    if (window.scrollY > window.innerHeight*0.2) {
        navBar.classList.add("fixed-top");
        navPlaceholder.setAttribute("style", "height: 56.8px");
    }
    else {
        navBar.classList.remove("fixed-top");
        navPlaceholder.setAttribute("style", "height: 0px");
    }
}

function loginPop(){
    loginModal.show();
}

function login(){
    let user = {user: $('#user').val(), password: $('#password').val()};
    $.post('./api/login_check.php', user, (response) => {
        if(response === 'success') location.reload();
        else alert(response);
    });
}

function logout(){
    $.post('./api/logout.php', () => location.reload());
}

addEventListener('scroll', navbarFixed);
loginBtn.on('click', loginPop);
loginSubmit.on('click', login);
logoutBtn.on('click', logout);
