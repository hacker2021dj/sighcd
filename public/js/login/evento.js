const wrapper = document.querySelector('.wrapper');
const registerLink = document.querySelector('.register-link');
const loginLink = document.querySelector('.login-link');


registerLink.onclick = () => {
    wrapper.classList.add('active');
}


loginLink.onclick = () => {
    wrapper.classList.remove('active');
}

setTimeout(function () {
    var alert = document.querySelector('.alert');
    if (alert != null)
        alert.remove();
}, 5000);
