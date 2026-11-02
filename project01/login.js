function login() {
    ajax("POST", "login.php", formData(["email", "password"]), function (xhr) {
        if (xhr.responseText == "OK") {
            location.href = "buying.htm";
        } else {
            showMsg(xhr.responseText);
        }
    });
}
