// Student: NAME, ID. File: mlogin.js. Function: sends the manager login to mlogin.php and shows the links.

function mlogin() {
    ajax("POST", "mlogin.php", formData(["managerid", "password"]), function (xhr) {
        if (xhr.responseText == "OK") {
            showMsg("");
            document.getElementById("loginform").className = "hidden";
            document.getElementById("back").className = "hidden";
            document.getElementById("links").className = "menu";
        } else {
            showMsg(xhr.responseText);
        }
    });
}
