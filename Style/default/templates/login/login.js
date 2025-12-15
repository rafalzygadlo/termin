document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[action="login/do"]');
    if (!form) {
        return; // Exit if we are not on the login page
    }

    const inputs = form.querySelectorAll('input[name="email"], input[name="password"]');
    const errorContainer = document.getElementById('error-container');

    inputs.forEach(function (input) {
        input.addEventListener('input', function () {
            // 1. Hide general error messages at the top
            if (errorContainer) {
                const alerts = errorContainer.querySelectorAll('.alert.alert-danger');
                alerts.forEach(alert => alert.remove());
            }

            // 2. Remove the 'is-invalid' class from the current field.
            // Bootstrap will automatically hide the .invalid-feedback message.
            this.classList.remove('is-invalid');
        });
    });
});