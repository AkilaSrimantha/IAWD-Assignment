function validateForm() {
    // Clear previous error messages
    document.getElementById("nameError").innerHTML = "";
    document.getElementById("indexError").innerHTML = "";
    document.getElementById("emailError").innerHTML = "";
    document.getElementById("codeError").innerHTML = "";
    document.getElementById("subjectError").innerHTML = "";
    document.getElementById("phoneError").innerHTML = "";
    document.getElementById("genderError").innerHTML = "";

    let isValid = true;

    // Validate student name
    const name = document.getElementById("studentName").value;
    if (name === "") {
        document.getElementById("nameError").innerHTML = "Please enter your name.";
        isValid = false;
    }

    // Validate index number
    const indexNumber = document.getElementById("indexNumber").value;
    if (indexNumber === "") {
        document.getElementById("indexError").innerHTML = "Please enter your index number.";
        isValid = false;
    }

    // Validate email
    const email = document.getElementById("email").value;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "" || !emailPattern.test(email)) {
        document.getElementById("emailError").innerHTML = "Please enter a valid email address.";
        isValid = false;
    }

    // Validate subject code
    const subjectCode = document.getElementById("subjectCode").value;
    if (subjectCode === "") {
        document.getElementById("codeError").innerHTML = "Please select a subject code.";
        isValid = false;
    }

    // Validate subject
    const subject = document.getElementById("subject").value;
    if (subject === "") {
        document.getElementById("subjectError").innerHTML = "Please select a subject.";
        isValid = false;
    }

    // Validate phone number
    const phone = document.getElementById("phone").value;
    const phonePattern = /^[0-9]{10}$/; // Adjust pattern as needed for your region
    if (phone === "" || !phonePattern.test(phone)) {
        document.getElementById("phoneError").innerHTML = "Please enter a valid 10-digit phone number.";
        isValid = false;
    }

    // Validate gender selection
    const male = document.getElementById("male").checked;
    const female = document.getElementById("female").checked;
    if (!male && !female) {
        document.getElementById("genderError").innerHTML = "Please select your gender.";
        isValid = false;
    }

    return isValid; // Return true if all validations pass, otherwise false
}
