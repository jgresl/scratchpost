window.onload = function() {
    var mainForm = document.querySelector("#form");
    var requiredFields = document.querySelectorAll(".required");
    var formMessage = document.querySelector("#form_message");
    var email_label = document.querySelector("#email_label");
    var email_field = document.querySelector("#email_field");
    var submit_button = document.querySelector("#submit_button");

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
            }
        }
    );
}