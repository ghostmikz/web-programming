// Student: NAME, ID. File: ajax.js. Function: XMLHttpRequest helpers shared by all pages.

function ajax(method, url, data, done) {
    var xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            done(xhr);
        }
    };
    xhr.send(data);
}

// Build "a=1&b=2" from the values of the inputs with these ids.
function formData(ids) {
    var parts = [];
    for (var i = 0; i < ids.length; i++) {
        parts.push(ids[i] + "=" + encodeURIComponent(document.getElementById(ids[i]).value));
    }
    return parts.join("&");
}

function showMsg(text) {
    document.getElementById("msg").textContent = text;
}

// Send the user to the login page if they are not logged in.
function requireLogin(role, page) {
    ajax("GET", "check.php?role=" + role, null, function (xhr) {
        if (xhr.responseText == "") {
            location.href = page;
        }
    });
}
