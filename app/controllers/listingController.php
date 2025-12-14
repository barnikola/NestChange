<?php

require_once dirname(__DIR__) . '/core/controller.php';
require_once dirname(__DIR__) . '/helpers/Validator.php';
require_once dirname(__DIR__) . '/middleware/AuthMiddleware.php';

class ListingController extends Controller
{
    private Listing $listingModel;
    private ListingAttribute $attributeModel;
    private Service $serviceModel;

    public function __construct()
    {
        parent::__construct();
        $this->listingModel = $this->model('Listing');
        $this->attributeModel = $this->model('ListingAttribute');
        $this->serviceModel = $this->model('Service');
    }

    /**
     * Display listings search page
     */
    public function index(): void
    {
        $filters = [
            'status' => 'published',
            'location' => $this->getInput('location'),
            'city' => $this->getInput('city'),
            'country' => $this->getInput('country'),
            'room_type' => $this->getInput('room_type'),
            'max_guests' => $this->getInput('guests'),
            'available_from' => $this->getInput('available_from'),
            'attributes' => $this->getInput('attributes'),
            'services' => $this->getInput('services'),
            'sort' => $this->getInput('sort', 'newest'),
        ];
        
        // Remove empty filters
        $filters = array_filter($filters, fn($v) => $v !== null && $v !== '');
        
        // Pagination
        $page = (int)($this->getInput('page', 1));
        $limit = (int)($this->getInput('limit', 20));
        $offset = ($page - 1) * $limit;
        
        $filters['limit'] = $limit;
        $filters['offset'] = $offset;

        $listings = $this->listingModel->search($filters);
        $totalListings = $this->listingModel->countSearch($filters);
        $totalPages = ceil($totalListings / $limit);
        
        $this->data['listings'] = $listings;
        $this->data['filters'] = $filters;
        $this->data['pagination'] = [
            'current_page' => $page,
            'total_pages' => $totalPages,
            'total_items' => $totalListings,
            'limit' => $limit
        ];
        $this->data['attributes'] = $this->attributeModel->getAllGroupedByCategory();
        $this->data['services'] = $this->serviceModel->findAll('name');
        
        $this->view('listings/search', $this->data);
    }


    public function search(): void
    {
        $filters = [
            'status' => 'published',
            'location' => $this->getInput('location'),
            'city' => $this->getInput('city'),
            'country' => $this->getInput('country'),
            'room_type' => $this->getInput('room_type'),
            'max_guests' => $this->getInput('guests'),
            'available_from' => $this->getInput('available_from'),
            'attributes' => $this->getInput('attributes'),
            'services' => $this->getInput('services'),
            'sort' => $this->getInput('sort', 'newest'),
            'limit' => $this->getInput('limit', 20),
            'offset' => $this->getInput('offset', 0),
        ];
        
        $filters = array_filter($filters, fn($v) => $v !== null && $v !== '');
        
        $listings = $this->listingModel->search($filters);
        
        $this->json([
            'success' => true,
            'count' => count($listings),
            'listings' => $listings,
        ]);
    }


    public function show(string $id): void
    {
        $listing = $this->listingModel->getFullListing($id);
        
        if (!$listing) {
            $this->flash('error', 'Listing not found.');
            $this->redirect(BASE_URL . '/listings');
        }
        

        
        $this->data['listing'] = $listing;
        $this->view('listings/listing', $this->data);
    }


    public function create(): void
    {
        AuthMiddleware::requireAuth();
        AuthMiddleware::requireApproved();

        $this->data['csrf_token'] = $this->getCsrfToken();
        $this->data['attributes'] = $this->attributeModel->getAllGroupedByCategory();
        $this->data['services'] = $this->serviceModel->findAll('name');
        
        $this->view('listings/addListing', $this->data);
    }


    public function store(): void
    {
        AuthMiddleware::requireAuth();
        AuthMiddleware::requireApproved();
        
        if (!$this->isPost()) {
            $this->redirect(BASE_URL . '/listings/create');
        }
        
        if (!$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request. Please try again.');
            $this->redirect(BASE_URL . '/listings/create');
        }
        
        $data = $this->allPost();
        
        // Validate input
        $validator = Validator::make($data)
            ->required('title', 'Title is required.')
            ->minLength('title', 5, 'Title must be at least 5 characters.')
            ->maxLength('title', 255, 'Title must not exceed 255 characters.')
            ->required('description', 'Description is required.')
            ->minLength('description', 20, 'Description must be at least 20 characters.')
            ->required('country', 'Country is required.')
            ->required('city', 'City is required.')
            ->required('room_type', 'Room type is required.')
            ->in('room_type', ['room', 'whole_apartment'], 'Invalid room type.')
            ->required('host_role', 'Host role is required.')
            ->in('host_role', ['owner', 'renter'], 'Invalid host role.');
        
        // Validate max_guests if provided
        if (!empty($data['max_guests'])) {
            $validator->integer('max_guests', 'Max guests must be a number.')
                      ->min('max_guests', 1, 'Max guests must be at least 1.');
        }
        
        // Validate coordinates if provided
        if (!empty($data['latitude'])) {
            $validator->numeric('latitude', 'Latitude must be a number.')
                      ->min('latitude', -90, 'Invalid latitude.')
                      ->max('latitude', 90, 'Invalid latitude.');
        }
        
        if (!empty($data['longitude'])) {
            $validator->numeric('longitude', 'Longitude must be a number.')
                      ->min('longitude', -180, 'Invalid longitude.')
                      ->max('longitude', 180, 'Invalid longitude.');
        }
        
        // Validate images
        $validator->file('images', [
            'maxSize' => UPLOAD_MAX_SIZE,
            'mimeTypes' => ALLOWED_IMAGE_TYPES,
        ], 'Invalid image file.');

        // Validate verification document
        if (isset($_FILES['verification_document']) && !empty($_FILES['verification_document']['name'])) {
            $validator->file('verification_document', [
                'maxSize' => 10 * 1024 * 1024,
                'mimeTypes' => ['application/pdf', 'image/jpeg', 'image/png']
            ], 'Invalid verification document. Allowed types: PDF, JPG, PNG.');
        }
        
        if ($validator->fails()) {
            $this->flash('error', $validator->firstError());
            $this->data['old'] = $data;
            $this->data['errors'] = $validator->errors();
            $this->data['csrf_token'] = $this->getCsrfToken();
            $this->data['attributes'] = $this->attributeModel->getAllGroupedByCategory();
            $this->data['services'] = $this->serviceModel->findAll('name');
            $this->view('listings/addListing', $this->data);
            return;
        }
        
        try {
            $this->listingModel->beginTransaction();
            
            // Get user's profile ID
            $profileId = $this->getUserProfileId();
            
            if (!$profileId) {
                throw new Exception('User profile not found. Please complete your profile first.');
            }
            
            // Geocode address
            $coords = $this->geocodeAddress(
                $data['address_line'] ?? '',
                $data['city'],
                $data['country']
            );

            // Create listing
            $listingId = $this->listingModel->createListing([
                'host_profile_id' => $profileId,
                'title' => $data['title'],
                'description' => $data['description'],
                'country' => $data['country'],
                'city' => $data['city'],
                'address_line' => $data['address_line'] ?? null,
                'latitude' => $coords['lat'],
                'longitude' => $coords['lng'],
                'room_type' => $data['room_type'],
                'max_guests' => $data['max_guests'] ?: null,
                'host_role' => $data['host_role'],
                'status' => 'draft',
            ]);
            
            // Handle image uploads
            $this->handleImageUploads($listingId);

            // Handle verification document upload
            if (isset($_FILES['verification_document']) && !empty($_FILES['verification_document']['name'])) {
                $this->handleVerificationUpload($listingId);
            }
            
            // Set attributes
            if (!empty($data['attributes']) && is_array($data['attributes'])) {
                $this->listingModel->setAttributes($listingId, $data['attributes']);
            }
            
            // Set services
            if (!empty($data['services']) && is_array($data['services'])) {
                $this->listingModel->setServices($listingId, $data['services']);
            }
            
            // Add availability if provided
            if (!empty($data['available_from'])) {
                $this->listingModel->addAvailability(
                    $listingId, 
                    $data['available_from'], 
                    $data['available_until'] ?? null
                );
            }
            
            $this->listingModel->commit();
            
            $this->flash('success', 'Listing created successfully! You can now publish it.');
            $this->redirect(BASE_URL . '/listings/' . $listingId);
            
        } catch (Exception $e) {
            $this->listingModel->rollback();
            
            if (APP_DEBUG) {
                $this->flash('error', 'Failed to create listing: ' . $e->getMessage());
            } else {
                $this->flash('error', 'Failed to create listing. Please try again.');
            }
            
            $this->data['old'] = $data;
            $this->data['csrf_token'] = $this->getCsrfToken();
            $this->data['attributes'] = $this->attributeModel->getAllGroupedByCategory();
            $this->data['services'] = $this->serviceModel->findAll('name');
            $this->view('listings/addListing', $this->data);
        }
    }


    public function edit(string $id): void
    {
        AuthMiddleware::requireAuth();
        
        $listing = $this->listingModel->getFullListing($id);
        
        if (!$listing) {
            $this->flash('error', 'Listing not found.');
            $this->redirect(BASE_URL . '/listings');
        }
        
        // Check ownership
        $profileId = $this->getUserProfileId();
        if ($listing['host_profile_id'] !== $profileId && !AuthMiddleware::hasRole('admin')) {
            $this->flash('error', 'You do not have permission to edit this listing.');
            $this->redirect(BASE_URL . '/listings/' . $id);
        }
        
        $this->data['listing'] = $listing;
        $this->data['csrf_token'] = $this->getCsrfToken();
        $this->data['attributes'] = $this->attributeModel->getAllGroupedByCategory();
        $this->data['services'] = $this->serviceModel->findAll('name');
        
        $this->view('listings/edit', $this->data);
    }


    public function update(string $id): void
    {
        AuthMiddleware::requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect(BASE_URL . '/listings/' . $id . '/edit');
        }
        
        if (!$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request. Please try again.');
            $this->redirect(BASE_URL . '/listings/' . $id . '/edit');
        }
        
        $listing = $this->listingModel->find($id);
        
        if (!$listing) {
            $this->flash('error', 'Listing not found.');
            $this->redirect(BASE_URL . '/listings');
        }
        
        // Check ownership
        $profileId = $this->getUserProfileId();
        if ($listing['host_profile_id'] !== $profileId && !AuthMiddleware::hasRole('admin')) {
            $this->flash('error', 'You do not have permission to edit this listing.');
            $this->redirect(BASE_URL . '/listings/' . $id);
        }
        
        $data = $this->allPost();
        
        // Same validation as store...
        $validator = Validator::make($data)
            ->required('title', 'Title is required.')
            ->minLength('title', 5, 'Title must be at least 5 characters.')
            ->maxLength('title', 255, 'Title must not exceed 255 characters.')
            ->required('description', 'Description is required.')
            ->required('country', 'Country is required.')
            ->required('city', 'City is required.')
            ->required('room_type', 'Room type is required.')
            ->in('room_type', ['room', 'whole_apartment'], 'Invalid room type.')
            ->required('host_role', 'Host role is required.')
            ->in('host_role', ['owner', 'renter'], 'Invalid host role.');
        
        if ($validator->fails()) {
            $this->flash('error', $validator->firstError());
            $this->data['listing'] = array_merge($listing, $data);
            $this->data['errors'] = $validator->errors();
            $this->data['csrf_token'] = $this->getCsrfToken();
            $this->data['attributes'] = $this->attributeModel->getAllGroupedByCategory();
            $this->data['services'] = $this->serviceModel->findAll('name');
            $this->view('listings/edit', $this->data);
            return;
        }
        
        try {
            $this->listingModel->beginTransaction();
            
            // Update listing
            $this->listingModel->update($id, [
                'title' => $data['title'],
                'description' => $data['description'],
                'country' => $data['country'],
                'city' => $data['city'],
                'address_line' => $data['address_line'] ?? null,
                'latitude' => $data['latitude'] ?: null,
                'longitude' => $data['longitude'] ?: null,
                'room_type' => $data['room_type'],
                'max_guests' => $data['max_guests'] ?: null,
                'host_role' => $data['host_role'],
            ]);
            
            // Handle new image uploads
            $this->handleImageUploads($id);
            
            // Handle verification document upload
            if (isset($_FILES['verification_document']) && !empty($_FILES['verification_document']['name'])) {
                $this->handleVerificationUpload($id);
            }
            
            // Update attributes
            if (isset($data['attributes'])) {
                $this->listingModel->setAttributes($id, $data['attributes'] ?: []);
            }
            
            // Update services
            if (isset($data['services'])) {
                $this->listingModel->setServices($id, $data['services'] ?: []);
            }
            
            $this->listingModel->commit();
            
            $this->flash('success', 'Listing updated successfully!');
            $this->redirect(BASE_URL . '/listings/' . $id);
            
        } catch (Exception $e) {
            $this->listingModel->rollback();
            
            if (APP_DEBUG) {
                $this->flash('error', 'Failed to update listing: ' . $e->getMessage());
            } else {
                $this->flash('error', 'Failed to update listing. Please try again.');
            }
            
            $this->redirect(BASE_URL . '/listings/' . $id . '/edit');
        }
    }


    public function destroy(string $id): void
    {
        AuthMiddleware::requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect(BASE_URL . '/listings/' . $id);
        }
        
        if (!$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request. Please try again.');
            $this->redirect(BASE_URL . '/listings/' . $id);
        }
        
        $listing = $this->listingModel->find($id);
        
        if (!$listing) {
            $this->flash('error', 'Listing not found.');
            $this->redirect(BASE_URL . '/listings');
        }
        
        // Check ownership
        $profileId = $this->getUserProfileId();
        if ($listing['host_profile_id'] !== $profileId && !AuthMiddleware::hasRole('admin')) {
            $this->flash('error', 'You do not have permission to delete this listing.');
            $this->redirect(BASE_URL . '/listings/' . $id);
        }
        
        $this->listingModel->delete($id);
        
        $this->flash('success', 'Listing deleted successfully.');
        $this->redirect(BASE_URL . '/my-listings');
    }


    public function publish(string $id): void
    {
        AuthMiddleware::requireAuth();
        
        if (!$this->isPost()) {
            $this->redirect(BASE_URL . '/listings/' . $id);
        }
        
        if (!$this->verifyCsrf()) {
            $this->flash('error', 'Invalid request.');
            $this->redirect(BASE_URL . '/listings/' . $id);
        }
        
        $listing = $this->listingModel->find($id);
        
        if (!$listing) {
            $this->flash('error', 'Listing not found.');
            $this->redirect(BASE_URL . '/listings');
        }
        
        // Check ownership
        $profileId = $this->getUserProfileId();
        if ($listing['host_profile_id'] !== $profileId) {
            $this->flash('error', 'You do not have permission to publish this listing.');
            $this->redirect(BASE_URL . '/listings/' . $id);
        }
        
        // Check if listing can be published (has required data)
        $images = $this->listingModel->getImages($id);
        if (empty($images)) {
            $this->flash('error', 'Please add at least one image before publishing.');
            $this->redirect(BASE_URL . '/listings/' . $id . '/edit');
        }
        
        $this->listingModel->publish($id);
        
        $this->flash('success', 'Listing published successfully!');
        $this->redirect(BASE_URL . '/listings/' . $id);
    }


    public function pause(string $id): void
    {
        AuthMiddleware::requireAuth();
        
        if (!$this->isPost() || !$this->verifyCsrf()) {
            $this->redirect(BASE_URL . '/listings/' . $id);
        }
        
        $listing = $this->listingModel->find($id);
        $profileId = $this->getUserProfileId();
        
        if (!$listing || $listing['host_profile_id'] !== $profileId) {
            $this->flash('error', 'Access denied.');
            $this->redirect(BASE_URL . '/listings');
        }
        
        $this->listingModel->pause($id);
        
        $this->flash('success', 'Listing paused.');
        $this->redirect(BASE_URL . '/listings/' . $id);
    }

    /**
     * Get user's listings
     */
    public function myListings(): void
    {
        AuthMiddleware::requireAuth();
        
        $profileId = $this->getUserProfileId();
        $listings = $this->listingModel->getByHostProfile($profileId);
        
        $this->data['listings'] = $listings;
        $this->view('listings/my-listings', $this->data);
    }


    public function deleteImage(string $listingId, string $imageId): void
    {
        AuthMiddleware::requireAuth();
        
        if (!$this->isPost() || !$this->verifyCsrf()) {
            $this->json(['success' => false, 'error' => 'Invalid request.'], 400);
        }
        
        $listing = $this->listingModel->find($listingId);
        $profileId = $this->getUserProfileId();
        
        if (!$listing || $listing['host_profile_id'] !== $profileId) {
            $this->json(['success' => false, 'error' => 'Access denied.'], 403);
        }
        
        $this->listingModel->deleteImage($imageId);
        
        $this->json(['success' => true]);
    }


    private function handleImageUploads(string $listingId): void
    {
        error_log("Starting image upload for listing $listingId");
        if (!isset($_FILES['images']) || empty($_FILES['images']['name'][0])) {
            error_log("No images found in _FILES");
            return;
        }
        
        $files = $_FILES['images'];
        $existingImages = $this->listingModel->getImages($listingId);
        $position = count($existingImages);
        
        $uploadDir = __DIR__ . '/../../public/uploads/images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        for ($i = 0; $i < count($files['name']); $i++) {
            error_log("Processing file " . $files['name'][$i]);
            if ($files['error'][$i] !== UPLOAD_ERR_OK) {
                error_log("Upload error code: " . $files['error'][$i]);
                continue;
            }
            
            // Validate file type
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $files['tmp_name'][$i]);
            finfo_close($finfo);
            
            if (!in_array($mimeType, ALLOWED_IMAGE_TYPES)) {
                error_log("Invalid mime type: $mimeType");
                continue;
            }
            
            // Validate file size
            if ($files['size'][$i] > UPLOAD_MAX_SIZE) {
                error_log("File too large: " . $files['size'][$i]);
                continue;
            }
            
            // Generate unique filename
            $extension = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
            if (!$extension) {
                $extensions = [
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                    'image/webp' => 'webp',
                    'image/gif' => 'gif'
                ];
                $extension = $extensions[$mimeType] ?? 'jpg';
            }
            
            $filename = $listingId . '_' . uniqid() . '.' . $extension;
            $targetPath = $uploadDir . $filename;
            
            if (move_uploaded_file($files['tmp_name'][$i], $targetPath)) {
                // Store image path relative to public folder
                $imagePath = 'uploads/images/' . $filename;
                $this->listingModel->addImage($listingId, $imagePath, $position);
                $position++;
                error_log("File saved to $targetPath");
            } else {
                error_log("Failed to move uploaded file to $targetPath");
            }
        }
    }


    private function getUserProfileId(): ?string
    {
        $user = $this->currentUser();
        if (!$user) {
            return null;
        }
        
        $db = Database::getInstance();
        $profile = $db->fetchOne(
            "SELECT id FROM user_profile WHERE account_id = ?",
            [$user['id']]
        );
        
        return $profile['id'] ?? null;
    }

    private function handleVerificationUpload(string $listingId): void
    {
        if (!isset($_FILES['verification_document']) || $_FILES['verification_document']['error'] !== UPLOAD_ERR_OK) {
            return;
        }

        $file = $_FILES['verification_document'];
        $uploadDir = __DIR__ . '/../../public/uploads/verification_docs/';
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = $listingId . '_verification_' . uniqid() . '.' . $extension;
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $relativePath = 'uploads/verification_docs/' . $filename;
            $listing = $this->listingModel->find($listingId);
            $documentTypeId = null;

            if ($listing && isset($listing['host_role'])) {
                if ($listing['host_role'] === 'owner') {
                    $documentTypeId = 3; // DEED
                } elseif ($listing['host_role'] === 'renter') {
                    $documentTypeId = 5; // LEASE
                }
            }
            
            $this->listingModel->addVerificationDocument($listingId, $relativePath, $documentTypeId);
        } else {
            error_log("Failed to move verification document to $targetPath");
        }
    }

    private function geocodeAddress(string $address, string $city, string $country): array
    {

        $context = stream_context_create([
            "http" => [
                "header" => "User-Agent: NestChange/1.0\r\n"
            ]
        ]);

        $params = [
            'format' => 'json',
            'street' => $address,
            'city' => $city,
            'country' => $country
        ];
        $params = array_filter($params);
        
        $url = "https://nominatim.openstreetmap.org/search?" . http_build_query($params);
        
        $result = @file_get_contents($url, false, $context);
        
        if ($result) {
            $data = json_decode($result, true);
            if (!empty($data[0])) {
                return [
                    'lat' => $data[0]['lat'],
                    'lng' => $data[0]['lon']
                ];
            }
        }
        

        $query = implode(', ', array_filter([$city, $country]));
        $url = "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($query);
        
        $result = @file_get_contents($url, false, $context);
        
        if ($result) {
            $data = json_decode($result, true);
            if (!empty($data[0])) {
                return [
                    'lat' => $data[0]['lat'],
                    'lng' => $data[0]['lon']
                ];
            }
        }

        return ['lat' => null, 'lng' => null];
    }
}
