/**
 * Listings create page interactions
 * - Handling empty fields
 * - Handling description length.
 */
(function() {
    'use strict';

    const submit = document.querySelector('.listing-form');
    const description = document.querySelector('#description');
    const err = document.querySelector('#char-error');

    description.addEventListener('blur', () => {
        const len = description.value.length;
        if(len < 20){
            err.innerHTML = 'Please add at least 20 characters';
        }else
            err.innerHTML = '';
    });

    submit.addEventListener('submit', (e) => {
        let isValid = true;
        if(description.value.lenght < 20){
            isValid = false;
        }
        if(!isValid){
            e.preventDefault();
        }
    });

})();