window.onload = function() {
    var mainForm = document.querySelector("#form");
    var requiredFields = document.querySelectorAll(".required");
    var formMessage = document.querySelector("#form_message");

    mainForm.addEventListener("submit", 
        function (e) {
            e.preventDefault();
            var requiredValidated = true;

            // Validate all required fields
            for (var i = 0; i < requiredFields.length; i++) {
                // Logic for text fields
                if (requiredFields[i].value == null || requiredFields[i].value == "") {
                    requiredFields[i].classList.add("emptyField");
                    requiredValidated = false;
                }
            }

            // Update form message based on validations
            if (!requiredValidated) {
                formMessage.innerHTML= "Required fields missing";
            } else {
                formMessage.innerHTML= "";
            }

            // Submit form
            if (requiredValidated) {
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