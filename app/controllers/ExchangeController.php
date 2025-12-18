<?php

require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/middleware/AuthMiddleware.php';

class ExchangeController extends Controller
{
    /**
     * Display user's exchanges
     */
    public function myExchanges(): void
    {
        AuthMiddleware::requireAuth();
        
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
