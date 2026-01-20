<?php
// Report Form Modal
require_once dirname(__DIR__, 2) . '/config.php';
?>
<div id="report-modal" class="report-modal-overlay" style="display:none;">
    <div class="report-modal-container">
        <button class="report-modal-close" onclick="closeReportModal()" aria-label="Close modal">&times;</button>
        <div class="report-modal-header">
            <h2 class="report-modal-title">🚩 Report</h2>
            <p class="report-modal-subtitle">Help us maintain a safe community by reporting inappropriate content</p>
        </div>
        
        <div id="report-message" class="report-message" style="display:none;"></div>
        
        <form id="reportForm" class="report-form">
            <input type="hidden" name="reported_type" id="reported_type">
            <input type="hidden" name="reported_id" id="reported_id">
            <input type="hidden" name="csrf_token" id="report_csrf_token" value="<?= Session::getCsrfToken() ?>">
            
            <div class="report-form-group">
                <label for="reason" class="report-label">Reason <span class="required">*</span></label>
                <select name="reason" id="reason" class="report-select" required>
                    <option value="">Select a reason</option>
                    <option value="Inappropriate content">Inappropriate content</option>
                    <option value="Spam">Spam</option>
                    <option value="Fraud">Fraud</option>
                    <option value="Harassment">Harassment</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            
            <div class="report-form-group">
                <label for="description" class="report-label">Description <span class="required">*</span></label>
                <textarea 
                    name="description" 
                    id="description" 
                    class="report-textarea" 
                    required 
                    placeholder="Please provide details about the issue..."
                    rows="5"
                ></textarea>
                <small class="report-help-text">Minimum 10 characters required</small>
            </div>
            
            <div class="report-form-actions">
                <button type="submit" class="btn-report-submit" id="submitBtn">
                    <span class="btn-text">Submit Report</span>
                    <span class="btn-loader" style="display:none;">⏳</span>
                </button>
                <button type="button" onclick="closeReportModal()" class="btn-report-cancel">Cancel</button>
            </div>
        </form>
    </div>
</div>

<style>
.report-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(4px);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.3s ease;
    padding: 20px;
    box-sizing: border-box;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from {
        transform: translateY(30px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.report-modal-container {
    background: #fff;
    padding: 0;
    border-radius: 16px;
    max-width: 500px;
    width: 100%;
    position: relative;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    animation: slideUp 0.3s ease;
    max-height: 90vh;
    overflow-y: auto;
}

.report-modal-close {
    position: absolute;
    top: 16px;
    right: 16px;
    background: transparent;
    border: none;
    font-size: 28px;
    color: #666;
    cursor: pointer;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s;
    z-index: 10;
}

.report-modal-close:hover {
    background: #f5f5f5;
    color: #333;
    transform: rotate(90deg);
}

.report-modal-header {
    padding: 32px 32px 24px;
    border-bottom: 1px solid #eee;
}

.report-modal-title {
    font-size: 24px;
    font-weight: 700;
    color: #222;
    margin: 0 0 8px 0;
    letter-spacing: -0.5px;
}

.report-modal-subtitle {
    font-size: 14px;
    color: #666;
    margin: 0;
    line-height: 1.5;
}

.report-message {
    margin: 20px 32px;
    padding: 14px 18px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        transform: translateY(-10px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.report-message.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.report-message.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.report-form {
    padding: 32px;
}

.report-form-group {
    margin-bottom: 24px;
}

.report-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.required {
    color: #e74c3c;
}

.report-select,
.report-textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 15px;
    font-family: inherit;
    transition: all 0.2s;
    box-sizing: border-box;
    background: #fff;
}

.report-select:focus,
.report-textarea:focus {
    outline: none;
    border-color: #0984e3;
    box-shadow: 0 0 0 3px rgba(9, 132, 227, 0.1);
}

.report-textarea {
    resize: vertical;
    min-height: 120px;
    line-height: 1.5;
}

.report-help-text {
    display: block;
    margin-top: 6px;
    font-size: 12px;
    color: #999;
}

.report-form-actions {
    display: flex;
    gap: 12px;
    margin-top: 32px;
}

.btn-report-submit,
.btn-report-cancel {
    flex: 1;
    padding: 14px 24px;
    border: none;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    position: relative;
}

.btn-report-submit {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: #fff;
    box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
}

.btn-report-submit:hover:not(:disabled) {
    background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(231, 76, 60, 0.4);
}

.btn-report-submit:active:not(:disabled) {
    transform: translateY(0);
}

.btn-report-submit:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.btn-report-cancel {
    background: #f5f5f5;
    color: #666;
    border: 2px solid #e0e0e0;
}

.btn-report-cancel:hover {
    background: #e8e8e8;
    border-color: #d0d0d0;
    color: #333;
}

.btn-loader {
    display: inline-block;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Mobile Responsive */
@media (max-width: 600px) {
    .report-modal-container {
        max-width: 100%;
        border-radius: 16px 16px 0 0;
        margin-top: auto;
        max-height: 85vh;
    }
    
    .report-modal-header,
    .report-form {
        padding: 24px 20px;
    }
    
    .report-form-actions {
        flex-direction: column;
    }
    
    .btn-report-submit,
    .btn-report-cancel {
        width: 100%;
    }
}
</style>

<style>
/* Styling for report listing button */
.btn-report {
    background: linear-gradient(135deg, #ff7675 0%, #d63031 100%);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 10px 22px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(214, 48, 49, 0.10);
    transition: all 0.18s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 8px;
}
.btn-report:hover {
    background: linear-gradient(135deg, #d63031 0%, #b71c1c 100%);
    color: #fff;
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 4px 16px rgba(214, 48, 49, 0.18);
}
.btn-report:active {
    background: #b71c1c;
    color: #fff;
    transform: none;
}
.btn-report:focus {
    outline: 2px solid #d63031;
    outline-offset: 2px;
}
</style>

<script>
(function() {
    const BASE_URL = '<?= rtrim(BASE_URL, '/') ?>';
    
    function openReportModal(type, id) {
        const modal = document.getElementById('report-modal');
        const form = document.getElementById('reportForm');
        const message = document.getElementById('report-message');
        
        // Reset form
        form.reset();
        message.style.display = 'none';
        message.className = 'report-message';
        
        // Set hidden values
        document.getElementById('reported_type').value = type;
        document.getElementById('reported_id').value = id;
        
        // Show modal
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        
        // Focus on first input
        setTimeout(() => {
            document.getElementById('reason').focus();
        }, 100);
    }
    
    function closeReportModal() {
        const modal = document.getElementById('report-modal');
        const form = document.getElementById('reportForm');
        const message = document.getElementById('report-message');
        
        modal.style.display = 'none';
        document.body.style.overflow = '';
        form.reset();
        message.style.display = 'none';
        message.className = 'report-message';
    }
    
    // Close on overlay click
    document.getElementById('report-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeReportModal();
        }
    });
    
    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('report-modal');
            if (modal.style.display === 'flex') {
                closeReportModal();
            }
        }
    });
    
    // Form submission
    const form = document.getElementById('reportForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoader = submitBtn.querySelector('.btn-loader');
    const message = document.getElementById('report-message');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const reason = document.getElementById('reason').value;
        const description = document.getElementById('description').value.trim();
        
        // Validation
        if (!reason || !description) {
            showMessage('Please fill in all required fields.', 'error');
            return;
        }
        
        if (description.length < 10) {
            showMessage('Description must be at least 10 characters long.', 'error');
            return;
        }
        
        // Show loading state
        submitBtn.disabled = true;
        btnText.style.display = 'none';
        btnLoader.style.display = 'inline-block';
        message.style.display = 'none';
        
        const formData = new FormData(form);
        
        fetch(BASE_URL + '/report/create', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showMessage('✓ Report submitted successfully! Thank you for helping us maintain a safe community.', 'success');
                form.reset();
                
                // Close modal after 2 seconds
                setTimeout(() => {
                    closeReportModal();
                }, 2000);
            } else {
                showMessage('✗ Error: ' + (data.error || 'Failed to submit report. Please try again.'), 'error');
                submitBtn.disabled = false;
                btnText.style.display = 'inline';
                btnLoader.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('✗ Network error. Please check your connection and try again.', 'error');
            submitBtn.disabled = false;
            btnText.style.display = 'inline';
            btnLoader.style.display = 'none';
        });
    });
    
    function showMessage(text, type) {
        message.textContent = text;
        message.className = 'report-message ' + type;
        message.style.display = 'flex';
        
        // Scroll to message
        message.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
    
    // Make functions globally available
    window.openReportModal = openReportModal;
    window.closeReportModal = closeReportModal;
})();
</script>
