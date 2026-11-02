function register() {
    var data = formData(["email", "firstname", "surname", "password", "password2", "phone"]);
    ajax("POST", "register.php", data, function (xhr) {
        showMsg(xhr.responseText);
    });
}
