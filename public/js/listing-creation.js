/**
 * Listings create page interactions
 * - Handling empty fields
 * - Handling description length.
 */
(function () {
    'use strict';

    const submitForm = document.querySelector('.listing-form');
    const description = document.querySelector('#description');
    const err = document.querySelector('#char-error');

    if (!submitForm || !description || !err) {
        console.warn('Listing creation script: Required elements not found.');
        return;
    }

    description.addEventListener('blur', () => {
        const len = description.value.length;
        if (len < 20) {
            err.innerHTML = 'Please add at least 20 characters';
            err.style.display = 'block';
        } else {
            err.innerHTML = '';
            err.style.display = 'none';
        }
    });

    submitForm.addEventListener('submit', (e) => {
        // Clear previous error styles
        err.style.display = 'none';

        let isValid = true;
        if (description.value.length < 20) {
            isValid = false;
            const msg = 'Description must be at least 20 characters.';
            err.innerHTML = msg;
            err.style.display = 'block';
            alert(msg); // Explicit alert to user
        }

        if (!isValid) {
            e.preventDefault();
            console.log('Form submission prevented due to validation.');
        } else {
            console.log('Form submitting...');
        }
    });

})();