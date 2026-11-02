// Student: NAME, ID. File: listing.js. Function: sends a new item to listing.php.

window.onload = function () {
    requireLogin("manager", "mlogin.htm");
};

function addItem() {
    ajax("POST", "listing.php", formData(["name", "price", "quantity", "description"]), function (xhr) {
        showMsg(xhr.responseText);
    });
}
