// Student: NAME, ID. File: register.js. Function: sends the registration form to register.php.

function register() {
    var data = formData(["email", "firstname", "surname", "password", "password2", "phone"]);
    ajax("POST", "register.php", data, function (xhr) {
        showMsg(xhr.responseText);
    });
}
