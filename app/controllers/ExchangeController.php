<?php

require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/middleware/AuthMiddleware.php';
require_once dirname(__DIR__) . '/models/exchange.php';

class ExchangeController extends Controller
{
    private Exchange $exchangeModel;

    public function __construct()
    {
        parent::__construct();
        $this->exchangeModel = $this->model('Exchange');
    }

    /**
     * Display user's exchanges
     */
    public function myExchanges(): void
    {
        AuthMiddleware::requireAuth();

        $user = AuthMiddleware::user();
        $profileId = $user['profile_id'] ?? null;
        $exchanges = [];

        if ($user && $profileId) {
            $bookings = $this->exchangeModel->getExchangesForUser((int)$user['id'], $profileId);

            // Only show bookings that have started or finished (exchange lifecycle)
            $exchanges = array_values(array_filter(
                $bookings,
                fn($exchange) => $exchange['is_exchange'] === true
            ));
        }

        $this->data['exchanges'] = $exchanges;
        $this->view('listings/my_exchanges', $this->data);
    }

    /**
     * Display exchange details
     */
    public function exchangeDetails(): void
    {
        AuthMiddleware::requireAuth();
        
        $this->view('listings/exchange_details', $this->data);
    }
}
