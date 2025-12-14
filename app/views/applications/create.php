<?php
$pageTitle = 'Apply for Listing - NestChange';
ob_start();

// Prefill dates from listing calendar selection (query params), fallback to today.
$today = date('Y-m-d');
$rawStart = $_GET['start'] ?? null;
$rawEnd = $_GET['end'] ?? null;

$isValidYmd = static function ($value): bool {
    if (!is_string($value) || $value === '') {
        return false;
    }
    $dt = DateTime::createFromFormat('Y-m-d', $value);
    return $dt !== false && $dt->format('Y-m-d') === $value;
};

$startValue = $isValidYmd($rawStart) ? $rawStart : $today;
$endValue = $isValidYmd($rawEnd) ? $rawEnd : $today;
?>
<style>
        .apply-section {
            padding: 60px 40px;
            background-color: #f5f5f5;
            min-height: calc(100vh - 200px);
            display: flex;
            justify-content: center;
        }

        .apply-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .apply-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .listing-preview {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            border: 1px solid #eee;
        }

        .listing-preview h3 {
            font-size: 16px;
            margin-bottom: 5px;
        }
    </style>

    <div class="apply-section">
        <div class="apply-card">
            <div class="apply-header">
                <h1>Submit Application</h1>
                <p>You are applying to stay at:</p>
            </div>

            <div class="listing-preview">
                <h3>Listing #<?php echo htmlspecialchars($listingId); ?> (Placeholder Title)</h3>
                <p style="font-size: 14px; color:#666;">Beautiful apartment in central location...</p>
            </div>

            <form method="post" action="/listings/<?php echo $listingId; ?>/apply" class="auth-form">
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                
                <div class="form-group">
                    <label class="form-label">Check-in Date</label>
                    <input
                        type="date"
                        name="startdate"
                        class="form-input"
                        required
                        min="<?php echo htmlspecialchars($today); ?>"
                        value="<?php echo htmlspecialchars($startValue); ?>"
                        placeholder="<?php echo htmlspecialchars($today); ?>"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Check-out Date</label>
                    <input
                        type="date"
                        name="enddate"
                        class="form-input"
                        required
                        min="<?php echo htmlspecialchars($today); ?>"
                        value="<?php echo htmlspecialchars($endValue); ?>"
                        placeholder="<?php echo htmlspecialchars($today); ?>"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Message to Host</label>
                    <textarea name="message" class="form-input" rows="5" placeholder="Introduce yourself and explain why you're a good fit..." required></textarea>
                </div>

                <button type="submit" class="btn-submit" style="width: 100%;">Submit Application</button>
            </form>
        </div>
    </div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
