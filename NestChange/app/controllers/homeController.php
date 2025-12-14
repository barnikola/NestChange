<?php

class HomeController extends Controller
{
    public function index(): void
    {
        $listingModel = $this->model('Listing');
        
        // Get 6 recent published listings
        $listings = $listingModel->getRecent(6);
        
        $this->view('home/index', [
            'listings' => $listings,
            'pageTitle' => 'NestChange - Home'
        ]);
    }
}
