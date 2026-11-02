// Student: NAME, ID. File: logout.js. Function: logs out through logout.php and shows the thanks message.

window.onload = function () {
    ajax("POST", "logout.php", null, function (xhr) {
        showMsg(xhr.responseText);
    });
};
