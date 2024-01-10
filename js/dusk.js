const navBar = document.querySelector(".navbar");
const navPlaceholder = document.querySelector(".nav-placeholder");
const loginBtn = $('.login-btn');
const loginModal = new bootstrap.Modal("#login-modal", {backdrop:'static'});
const loginSubmit = $('login-submit');

function navbarFixed(){
    if (window.scrollY > window.innerHeight*0.2) {
        navBar.classList.add("fixed-top");
        navPlaceholder.setAttribute("style", "height: 56.8px");
    } else {
        navBar.classList.remove("fixed-top");
        navPlaceholder.setAttribute("style", "height: 0px");
    }
}

function loginPop(){
    loginModal.show();
}

function login(){
    let user = {user: $('#user').val(), password: $('#password').val()};
    console.log(user);
    $.post('./api/login_check.php', user, (response) => {
        console.log(response);
    });
}

addEventListener('scroll', navbarFixed);
loginBtn.on('click', loginPop)
loginSubmit.on('click', login);
