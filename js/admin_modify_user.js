window.onload = function () {
    var editSelect = document.querySelectorAll(".edit_select");

    for (var i = 0; i < editSelect.length; i++) {
        editSelect[i].addEventListener("change",
            function (e) {
                var confirmed = confirm("Are you sure you want to modify the user?");
                
                // Submit form
                if (confirmed) {
                    this.form.submit();
                }
            }
        );
    }
}