const navBar = document.querySelector(".navbar");
const navPlaceholder = document.querySelector(".nav-placeholder");
const loginBtn = document.querySelector(".login-btn");
const loginModal = new bootstrap.Modal("#login-modal", {backdrop:'static'});

function navbarFixed(){
    if (window.scrollY > window.innerHeight*0.2) {
        navBar.classList.add("fixed-top");
        navPlaceholder.setAttribute("style", "height: 56.8px");
    } else {
        navBar.classList.remove("fixed-top");
        navPlaceholder.setAttribute("style", "height: 0px");
    }
}

function login(){
    loginModal.show();
}

addEventListener('scroll', navbarFixed);
loginBtn.addEventListener('click', login)
