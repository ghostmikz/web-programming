// Student: NAME, ID. File: processing.js. Function: shows the sold items and runs the process action.

window.onload = function () {
    requireLogin("manager", "mlogin.htm");
    loadSold();
};

function loadSold() {
    ajax("GET", "processing.php", null, function (xhr) {
        document.getElementById("sold").innerHTML = xhr.responseText;
    });
}

function processItems() {
    ajax("POST", "processing.php", "process=1", function (xhr) {
        showMsg(xhr.responseText);
        loadSold();
    });
}
