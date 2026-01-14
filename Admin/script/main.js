function changeType() {
    let eye = document.getElementById("password");
    let type = eye.type;
    if (type == "password") {
        eye.setAttribute('type', 'text');
    } else {
        eye.setAttribute('type', 'password');

    }
}