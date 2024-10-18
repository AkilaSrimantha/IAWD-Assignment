function validateForm() {
    const fullName = document.getElementById("fullName").value;
    const email = document.getElementById("email").value;
    const mobile = document.getElementById("mobile").value;
    const birthDate = document.getElementById("birthDate").value;
    const address = document.getElementById("address").value;
    const postalCode = document.getElementById("postalCode").value;
    const country = document.getElementById("country").value;
    const faculty = document.getElementById("faculty").value;
    const course = document.getElementById("course").value;

    if (!fullName || !email || !mobile || !birthDate || !address || !postalCode || !country || !faculty || !course) {
        alert("All fields are required!");
        return false;
    }


        const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
        if (!emailPattern.test(email)) {
            alert("Email must be a valid Gmail address (e.g., example@gmail.com)");
            return false;
        }


        const phonePattern = /^\d{10}$/;
        if (!phonePattern.test(mobile)) {
            alert("Mobile number must be exactly 10 digits.");
            return false;

    return true;
}

}