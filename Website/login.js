function validateForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var errorMessage = document.getElementById("error-message");

    if (username === "" || password === "") {
        errorMessage.textContent = "Username and password are required.";
        return false;
    }

    // Additional validation can be added here
    // For example, checking if the username and password match a specific pattern

    errorMessage.textContent = ""; // Clear error message
    alert("Login successful!"); // This is just for demonstration. In a real application, you would authenticate the user.
    return true;
}

