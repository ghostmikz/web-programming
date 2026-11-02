window.onload = function () {
    ajax("POST", "logout.php", null, function (xhr) {
        showMsg(xhr.responseText);
    });
};
