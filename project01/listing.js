window.onload = function () {
    requireLogin("manager", "mlogin.html");
};

function addItem() {
    ajax("POST", "listing.php", formData(["name", "price", "quantity", "description"]), function (xhr) {
        showMsg(xhr.responseText);
    });
}
