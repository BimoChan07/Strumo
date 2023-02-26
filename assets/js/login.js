const toggleVisibility = () => {
    let passwordEvent = document.getElementById("password");
    passwordEvent.addEventListener("input", function() {
        let inputValue = document.getElementById("password").value;
        while (inputValue.length < 1) {
            return false;
        }
        document.getElementById("btn-eye").style.display = "block";
    });
}

const togglePassword = () => {
    event.preventDefault();
    let inputType = document.getElementById("password").type;
    if (inputType != "password") {
        document.getElementById("password").type = "password";
        document.getElementById("btn-eye").innerHTML = "Show";
    } else {
        document.getElementById("password").type = "text";
        document.getElementById("btn-eye").innerHTML = "Hide";
    }
}