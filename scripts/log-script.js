document.getElementById('lForm').addEventListener("submit", function (event) {
    const l_username = document.getElementById("username").value.trim();
    const l_password = document.getElementById("password").value.trim();
    const logErrors = document.querySelector('.logErrors');
    const l_errors = [];

    if (l_username === "") {
        l_errors.push("<li>Username required</li>");
    }
    if (l_password === "") {
        l_errors.push("<li>Password required</li>");
    }
    if (l_errors.length > 0) {
        event.preventDefault();
        logErrors.innerHTML = "";
        logErrors.innerHTML = l_errors.join("<br>")
    }

});