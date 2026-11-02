window.onload = function () {
    requireLogin("customer", "login.htm");
    loadCatalog();
    cartAction("view");
    setInterval(loadCatalog, 10000);
};

function loadCatalog() {
    ajax("GET", "catalog.php", null, function (xhr) {
        document.getElementById("catalog").innerHTML = xhr.responseText;
    });
}

function addToCart(number) {
    cartAction("add", number);
}

function removeFromCart(number) {
    cartAction("remove", number);
}

function cartAction(action, number) {
    ajax("POST", "buying.php", "action=" + action + "&number=" + (number || 0), function (xhr) {
        if (!xhr.responseXML) {
            return;
        }
        var cart = xhr.responseXML.documentElement;
        showCart(cart);
        loadCatalog();
        showMsg(cart.getAttribute("confirmed") ? "Your purchase has been confirmed and total amount due to pay is $" + cart.getAttribute("confirmed") : "");
        if (cart.getAttribute("unavailable")) {
            alert("Sorry, this item is not available for sale");
        }
        if (cart.getAttribute("cancelled")) {
            alert("Your purchase request has been cancelled, welcome to shop next time");
        }
    });
}

function text(item, name) {
    return item.getElementsByTagName(name)[0].textContent;
}

function addCell(row, content) {
    var cell = row.insertCell(-1);
    cell.appendChild(typeof content == "string" ? document.createTextNode(content) : content);
    return cell;
}

function makeButton(label, click) {
    var button = document.createElement("input");
    button.type = "button";
    button.value = label;
    button.onclick = click;
    return button;
}

function showCart(cart) {
    var box = document.getElementById("cart");
    var items = cart.getElementsByTagName("item");
    box.textContent = "";
    if (items.length == 0) {
        box.textContent = "The cart is empty.";
        return;
    }

    var table = document.createElement("table");
    table.border = "1";
    var head = table.insertRow(-1);
    var titles = ["Item Number", "Price", "Quantity", "Remove"];
    for (var i = 0; i < titles.length; i++) {
        var th = document.createElement("th");
        th.textContent = titles[i];
        head.appendChild(th);
    }

    for (var j = 0; j < items.length; j++) {
        addRow(table, items[j]);
    }

    var total = table.insertRow(-1);
    var label = addCell(total, "Total:");
    label.colSpan = 3;
    label.className = "right";
    addCell(total, "$" + cart.getAttribute("total"));

    var actions = table.insertRow(-1);
    actions.className = "actions";
    var buttons = addCell(actions, makeButton("Confirm Purchase", function () { cartAction("confirm"); }));
    buttons.colSpan = 4;
    buttons.appendChild(document.createTextNode(" "));
    buttons.appendChild(makeButton("Cancel Purchase", function () { cartAction("cancel"); }));
    box.appendChild(table);
}

function addRow(table, item) {
    var number = text(item, "number");
    var row = table.insertRow(-1);
    addCell(row, number);
    addCell(row, "$" + text(item, "price"));
    addCell(row, text(item, "quantity"));
    addCell(row, makeButton("Remove from the cart", function () { removeFromCart(number); }));
}
