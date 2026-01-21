document.addEventListener('DOMContentLoaded', function () {
    const password = document.getElementById('password');
    const confirmInput = document.getElementById('confirm-password');
    const form = document.querySelector('.auth-form');
    const dateInput = document.getElementById('end-date');
    const idInput = document.getElementById('id-document');
    const studentIdInput = document.getElementById('student-id');
    const profilePicInput = document.getElementById('profile-picture');

    function showFeedback(input, msg, color) {

        let targetContainer = input.parentNode;
        if (input.type === 'file' && input.parentNode.classList.contains('file-input-wrapper')) {
            targetContainer = input.parentNode.parentNode;
        } else if (input.parentNode.classList.contains('password-input-wrapper')) {
            targetContainer = input.parentNode.parentNode;
        }

        let old = targetContainer.querySelector('.simple-feedback');
        if (old) old.remove();

        let phpErrors = targetContainer.querySelectorAll('.form-error');
        phpErrors.forEach(el => el.style.display = 'none');

        if (!msg) return;

        let div = document.createElement('div');
        div.className = 'simple-feedback';
        div.style.fontSize = '0.8rem';
        div.style.marginTop = '4px';
        div.style.color = color;
        div.textContent = msg;
        targetContainer.appendChild(div);
    }

    function checkPassword() {
        const val = password.value;
        if (val.length === 0) {
            showFeedback(password, 'Password is required', 'red');
            return false;
        }

        const hasLength = val.length >= 8;
        const hasUpper = /[A-Z]/.test(val);
        const hasLower = /[a-z]/.test(val);
        const hasNumber = /\d/.test(val);
        const hasSpecial = /[^A-Za-z0-9]/.test(val);

        if (hasLength && hasUpper && hasLower && hasNumber && hasSpecial) {
            showFeedback(password, 'OK', 'green');
            return true;
        }

        let error = 'Weak: ';
        if (!hasLength) error += '8+ characters ';
        if (!hasUpper) error += 'uppercase letter ';
        if (!hasLower) error += 'lowercase letter ';
        if (!hasNumber) error += 'number ';
        if (!hasSpecial) error += 'special character ';

        showFeedback(password, error, 'red');
        return false;
    }

    function checkMatch() {
        const val = confirmInput.value;
        if (val.length === 0) {
            showFeedback(confirmInput, 'Please confirm password', 'red');
            return false;
        }

        if (password.value !== val) {
            showFeedback(confirmInput, 'Passwords do not match', 'red');
            return false;
        }

        showFeedback(confirmInput, 'Match!', 'green');
        return true;
    }

    function checkDate() {
        if (!dateInput.value) {
            showFeedback(dateInput, 'Date is required', 'red');
            return false;
        }

        const selectedDate = new Date(dateInput.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selectedDate < today) {
            showFeedback(dateInput, 'Date must be today or in the future', 'red');
            return false;
        }

        showFeedback(dateInput, 'OK', 'green');
        return true;
    }

    function validateFile(input, name, allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'], isOptional = false) {

        if (input.files.length === 0) {
            if (isOptional) {
                showFeedback(input, '', 'black');
                return true;
            }
            showFeedback(input, `${name} is required`, 'red');
            return false;
        }

        const file = input.files[0];
        const ext = file.name.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(ext)) {
            showFeedback(input, `Invalid file type (${allowedExtensions.join(', ').toUpperCase()} only)`, 'red');
            input.value = '';
            return false;
        }

        showFeedback(input, 'OK', 'green');
        return true;
    }

    function checkFiles() {
        let valid = true;

        if (idInput) {
            if (!validateFile(idInput, 'ID Document')) valid = false;
        }

        if (studentIdInput) {
            if (!validateFile(studentIdInput, 'Student ID')) valid = false;
        }

        if (profilePicInput) {
            if (!validateFile(profilePicInput, 'Profile Picture', ['jpg', 'jpeg', 'png'], true)) valid = false;
        }

        return valid;
    }

    password.addEventListener('input', () => {
        checkPassword();
        if (confirmInput.value.length > 0) checkMatch();
    });

    confirmInput.addEventListener('input', checkMatch);

    dateInput.addEventListener('change', checkDate);


    if (idInput) {
        idInput.addEventListener('change', () => {
            validateFile(idInput, 'ID Document');
        });
    }


    if (studentIdInput) {
        studentIdInput.addEventListener('change', () => {
            validateFile(studentIdInput, 'Student ID');
        });
    }

    if (profilePicInput) {
        profilePicInput.addEventListener('change', () => {
            validateFile(profilePicInput, 'Profile Picture', ['jpg', 'jpeg', 'png'], true);
        });
    }

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const isPasswordValid = checkPassword();
        const isMatchValid = checkMatch();
        const isDateValid = checkDate();
        const areFilesValid = checkFiles();

        if (isPasswordValid && isMatchValid && isDateValid && areFilesValid) {
            form.submit();
            return;
        }
        if (!isPasswordValid) {
            password.focus();
            return;
        }

        if (!isMatchValid) {
            confirmInput.focus();
            return;
        }

        if (!isDateValid) {
            if (dateInput) dateInput.focus();
            return;
        }

        if (!areFilesValid) {
            // Logic to focus first invalid file
            if (idInput && !validateFile(idInput, 'ID Document')) idInput.focus();
            else if (studentIdInput && !validateFile(studentIdInput, 'Student ID')) studentIdInput.focus();
            else if (profilePicInput && !validateFile(profilePicInput, 'Profile Picture', ['jpg', 'jpeg', 'png'], true)) profilePicInput.focus();
            return;
        }
    });
}
);
