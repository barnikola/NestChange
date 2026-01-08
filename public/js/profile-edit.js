/**
 * Profile edit page interactions
 * - Preview selected profile photo before upload
 */
(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const uploadInput = document.getElementById('photoUpload');
        const previewImg = document.getElementById('previewImg');

        if (!uploadInput || !previewImg || !window.FileReader) return;

        uploadInput.addEventListener('change', function(evt) {
            const files = evt.target.files;
            if (!files || files.length === 0) return;

            const reader = new FileReader();
            reader.onload = function() {
                previewImg.src = reader.result;
            };
            reader.readAsDataURL(files[0]);
        });
    });
})();





