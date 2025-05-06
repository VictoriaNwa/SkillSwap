document.getElementById('rForm').addEventListener("submit", function(event) {
    const r_username = document.getElementById("username").value.trim();
    const r_email = document.getElementById("email").value.trim();
    const r_phone_number = document.getElementById("phone_number").value.trim();
    const r_password = document.getElementById("password").value.trim();

    // map to pull error messages from
    const r_map = [
        {value: r_username, e: "<li>Username must be at least 3 characters.</li>", validate: val => val.length >= 3},
        {value: r_email, e: "<li>Enter a valid email address.</li>", validate: val => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)},
        {value: r_phone_number, e: "<li>Phone number must be 10 digits long.</li>", validate: val => /^\d{10}$/.test(val)},
        {value: r_password, e: "<li>Password must be at least 8 characters long, contain one uppercase, one lowercase, one digit, and one symbol.</li>", validate: val => /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/.test(val)}
    ];

    // creaters array for error messages and saves element
    const r_errors = [];
    const regErrors = document.querySelector(".regErrors");

    // pushes corresponing error if validation returns false
    r_map.forEach(x => {
        if (!x.validate(x.value)) {
            r_errors.push(x.e);
        }
    });

    // if errors array is has errors print them and screen and prevent continuation
    if (r_errors.length > 0) {
        event.preventDefault();
        regErrors.innerHTML = "";
        regErrors.innerHTML = r_errors.join("<br>");
    }

    /* could do it this way as well
    if (r_errors.length > 0) {
        event.preventDefault();
        regErrors.innerHTML = "";
        errors.forEach(err => {
            const p = document.createElement("p");
            p.textContent = err;
            regErrors.appendChild(p);
        });
    } */
});
