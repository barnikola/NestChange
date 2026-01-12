/**
 * Multi-Step Registration Form
 * - Shows 3 steps on mobile (< 768px)
 * - Shows single page on desktop (>= 768px)
 * - Saves progress in sessionStorage
 */

(function () {
    'use strict';

    const MOBILE_BREAKPOINT = 768;
    let currentStep = 1;
    const totalSteps = 3;

    // Check if we're on mobile
    function isMobile() {
        return window.innerWidth < MOBILE_BREAKPOINT;
    }

    // Initialize multi-step form
    function initMultiStepForm() {
        const form = document.querySelector('.auth-form');
        if (!form || !form.classList.contains('registration-form')) {
            return; // Not a registration form
        }

        // Only activate on mobile
        if (!isMobile()) {
            return;
        }

        // Create step indicator
        createStepIndicator();

        // Wrap form fields in steps
        createSteps();

        // Add navigation buttons
        addNavigationButtons();

        // Load saved progress
        loadProgress();

        // Show first step
        showStep(currentStep);

        // Save progress on input change
        form.addEventListener('input', saveProgress);

        // Handle window resize
        window.addEventListener('resize', handleResize);
    }

    function createStepIndicator() {
        const form = document.querySelector('.auth-form');
        const indicator = document.createElement('div');
        indicator.className = 'step-indicator';
        indicator.id = 'step-indicator';

        for (let i = 1; i <= totalSteps; i++) {
            const dot = document.createElement('div');
            dot.className = 'step-dot';
            dot.dataset.step = i;
            indicator.appendChild(dot);
        }

        const stepText = document.createElement('div');
        stepText.className = 'step-text';
        stepText.id = 'step-text';
        stepText.textContent = `Step ${currentStep} of ${totalSteps}`;

        form.insertBefore(stepText, form.firstChild);
        form.insertBefore(indicator, form.firstChild);
    }

    function createSteps() {
        const form = document.querySelector('.auth-form');
        const formGroups = Array.from(form.querySelectorAll('.form-group'));

        // Step 1: Basic Info (name, surname, email, password, confirm password)
        const step1Fields = formGroups.slice(0, 5);

        // Step 2: Documents (ID document, Student ID, end date)
        const step2Fields = formGroups.slice(5, 8);

        // Step 3: Review (we'll create this)
        const step3 = document.createElement('div');
        step3.className = 'form-step';
        step3.dataset.step = '3';
        step3.innerHTML = `
            <div style="text-align: center; padding: 2rem 0;">
                <h3 style="margin-bottom: 1rem;">Review Your Information</h3>
                <p style="color: #6b7280; margin-bottom: 1.5rem;">Please review your details before submitting.</p>
                <div id="review-content" style="text-align: left; background: #f9fafb; padding: 1rem; border-radius: 6px; margin-bottom: 1rem;">
                    <!-- Will be populated dynamically -->
                </div>
                <p style="font-size: 0.875rem; color: #6b7280;">Click "Register" to create your account.</p>
            </div>
        `;

        // Wrap step 1 fields
        const step1Div = document.createElement('div');
        step1Div.className = 'form-step active';
        step1Div.dataset.step = '1';
        step1Fields.forEach(field => step1Div.appendChild(field));

        // Wrap step 2 fields
        const step2Div = document.createElement('div');
        step2Div.className = 'form-step';
        step2Div.dataset.step = '2';
        step2Fields.forEach(field => step2Div.appendChild(field));

        // Insert steps before submit button
        const submitBtn = form.querySelector('button[type="submit"]');
        form.insertBefore(step1Div, submitBtn);
        form.insertBefore(step2Div, submitBtn);
        form.insertBefore(step3, submitBtn);
    }

    function addNavigationButtons() {
        const form = document.querySelector('.auth-form');
        const submitBtn = form.querySelector('button[type="submit"]');

        // Create button container
        const btnContainer = document.createElement('div');
        btnContainer.className = 'step-buttons';
        btnContainer.id = 'step-buttons';

        // Back button
        const backBtn = document.createElement('button');
        backBtn.type = 'button';
        backBtn.className = 'btn-outline step-button';
        backBtn.id = 'back-btn';
        backBtn.textContent = 'Back';
        backBtn.addEventListener('click', previousStep);

        // Next button
        const nextBtn = document.createElement('button');
        nextBtn.type = 'button';
        nextBtn.className = 'btn-submit step-button';
        nextBtn.id = 'next-btn';
        nextBtn.textContent = 'Next';
        nextBtn.addEventListener('click', nextStep);

        btnContainer.appendChild(backBtn);
        btnContainer.appendChild(nextBtn);

        // Hide original submit button initially
        submitBtn.style.display = 'none';
        submitBtn.id = 'final-submit';

        form.insertBefore(btnContainer, submitBtn);
    }

    function showStep(step) {
        currentStep = step;

        // Update step indicator
        const dots = document.querySelectorAll('.step-dot');
        dots.forEach((dot, index) => {
            if (index + 1 === step) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });

        // Update step text
        const stepText = document.getElementById('step-text');
        if (stepText) {
            stepText.textContent = `Step ${step} of ${totalSteps}`;
        }

        // Show/hide steps
        const steps = document.querySelectorAll('.form-step');
        steps.forEach(stepDiv => {
            if (parseInt(stepDiv.dataset.step) === step) {
                stepDiv.classList.add('active');
            } else {
                stepDiv.classList.remove('active');
            }
        });

        // Update buttons
        updateButtons();

        // Populate review if on step 3
        if (step === 3) {
            populateReview();
        }

        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function updateButtons() {
        const backBtn = document.getElementById('back-btn');
        const nextBtn = document.getElementById('next-btn');
        const submitBtn = document.getElementById('final-submit');
        const btnContainer = document.getElementById('step-buttons');

        if (currentStep === 1) {
            backBtn.style.display = 'none';
            nextBtn.style.display = 'block';
            submitBtn.style.display = 'none';
            btnContainer.style.gridTemplateColumns = '1fr';
        } else if (currentStep === totalSteps) {
            backBtn.style.display = 'block';
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'block';
            btnContainer.style.gridTemplateColumns = '1fr 1fr';
        } else {
            backBtn.style.display = 'block';
            nextBtn.style.display = 'block';
            submitBtn.style.display = 'none';
            btnContainer.style.gridTemplateColumns = '1fr 1fr';
        }
    }

    function nextStep() {
        // Validate current step
        if (!validateStep(currentStep)) {
            return;
        }

        if (currentStep < totalSteps) {
            showStep(currentStep + 1);
        }
    }

    function previousStep() {
        if (currentStep > 1) {
            showStep(currentStep - 1);
        }
    }

    function validateStep(step) {
        const stepDiv = document.querySelector(`.form-step[data-step="${step}"]`);
        if (!stepDiv) return true;

        const inputs = stepDiv.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.style.borderColor = '#dc2626';
                isValid = false;
            } else {
                input.style.borderColor = '#ddd';
            }
        });

        if (!isValid) {
            alert('Please fill in all required fields.');
        }

        return isValid;
    }

    function populateReview() {
        const reviewContent = document.getElementById('review-content');
        if (!reviewContent) return;

        const form = document.querySelector('.auth-form');
        const data = new FormData(form);

        let html = '';
        html += `<p><strong>Name:</strong> ${data.get('name')} ${data.get('surname')}</p>`;
        html += `<p><strong>Email:</strong> ${data.get('email')}</p>`;

        const idDoc = form.querySelector('input[name="id-document"]');
        const studentId = form.querySelector('input[name="student-id"]');

        html += `<p><strong>ID Document:</strong> ${idDoc && idDoc.files.length > 0 ? idDoc.files[0].name : 'Not uploaded'}</p>`;
        html += `<p><strong>Student ID:</strong> ${studentId && studentId.files.length > 0 ? studentId.files[0].name : 'Not uploaded'}</p>`;
        html += `<p><strong>Student Status Until:</strong> ${data.get('student_status_until') || 'Not set'}</p>`;

        reviewContent.innerHTML = html;
    }

    function saveProgress() {
        const form = document.querySelector('.auth-form');
        const data = new FormData(form);
        const progress = {};

        for (let [key, value] of data.entries()) {
            if (key !== 'csrf_token' && typeof value === 'string') {
                progress[key] = value;
            }
        }

        progress.currentStep = currentStep;
        sessionStorage.setItem('registrationProgress', JSON.stringify(progress));
    }

    function loadProgress() {
        const saved = sessionStorage.getItem('registrationProgress');
        if (!saved) return;

        try {
            const progress = JSON.parse(saved);
            const form = document.querySelector('.auth-form');

            Object.keys(progress).forEach(key => {
                if (key === 'currentStep') {
                    currentStep = progress[key];
                } else {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input && input.type !== 'file') {
                        input.value = progress[key];
                    }
                }
            });
        } catch (e) {
            console.error('Failed to load progress:', e);
        }
    }

    function handleResize() {
        // If resized to desktop, reload page to show full form
        if (!isMobile()) {
            location.reload();
        }
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMultiStepForm);
    } else {
        initMultiStepForm();
    }
})();
