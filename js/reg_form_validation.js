window.onload = function() {
    var mainForm = document.querySelector("#form");
    var requiredFields = document.querySelectorAll(".required");
    var formMessage = document.querySelector("#form_message");

    mainForm.addEventListener("submit", 
        function (e) {
            e.preventDefault();
            var requiredValidated = true;
            var lengthValidated = false;
            var passwordValidated = false;

            // Validate all required fields
            for (var i = 0; i < requiredFields.length; i++) {
                // Logic for text fields
                if (requiredFields[i].value == null || requiredFields[i].value == "") {
                    requiredFields[i].classList.add("emptyField");
                    requiredValidated = false;
                }
                // Logic for check box
                if (requiredFields[i].type == "checkbox" && requiredFields[i].checked == false) {
                    requiredFields[i].parentNode.classList.add("emptyField");
                    requiredValidated = false;
                }
            }

            // Validate password length
            var password = document.querySelector("#password");
            if (password.value.length >= 6) {
                lengthValidated = true;
            }

            // Validate matching passwords
            var password2 = document.querySelector("#password2");
            if (password.value === password2.value) {
                passwordValidated = true;
            }

            // Update form message based on validations
            if (!requiredValidated) {
                formMessage.innerHTML= "There are required fields still missing";
            } else if (!lengthValidated) {
                formMessage.innerHTML= "The password must be at least 6 characters in length";
            } else if (!passwordValidated) {
                formMessage.innerHTML= "The passwords do not match";
            } else {
                formMessage.innerHTML= "";
            }
            
            // Submit form if all tests pass
            if (requiredValidated && lengthValidated && passwordValidated) {
                mainForm.submit();
            }
        }
    );

    mainForm.addEventListener("input", 
        function (e) {
            // Cheack all required fields for new input
            for (var i = 0; i < requiredFields.length; i++) {
                // Logic for text fields
                if (requiredFields[i].value != null && requiredFields[i].value != "") {
                    requiredFields[i].classList.remove("emptyField");
                }
                // Logic for check box
                if (requiredFields[i].type == "checkbox" && requiredFields[i].checked == true) {
                    requiredFields[i].parentNode.classList.remove("emptyField");
                    isValidated = false;
                }
            }
        }
    );
}