<?php

require_once __DIR__ . '/../helpers/FileUpload.php';
require_once __DIR__ . '/../models/requests.listing.php';

use helpers\FileUpload;

if (isset($_GET['function']) && !empty($_GET['function'])) {
    $action = $_GET['function'];
} else {
    $requestUri = $_SERVER['REQUEST_URI'];
    
    if (strpos($requestUri, 'add') !== false) {
        $action = 'add';
    } else {
        $action = 'index';
    }
}


switch ($action) {
    
    case 'add':
        $alert = false;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $imagePathForDB = null;
            $docPathForDB = null;
            $uploadErrors = [];

            $uploader = new FileUpload();

           if (isset($_FILES['listing_image']) && $_FILES['listing_image']['error'] === 0) {
                $fileName = $uploader->upload($_FILES['listing_image']);
                if ($fileName) {
                    $imagePathForDB = 'uploads/' . $fileName;
                } else {
                    $uploadErrors[] = "Image error: " . implode(", ", $uploader->getErrors());
                }
            }

            if (isset($_FILES['verification_doc']) && $_FILES['verification_doc']['error'] === 0) {
                $docName = $uploader->upload($_FILES['verification_doc']);
                if ($docName) {
                    $docPathForDB = 'uploads/' . $docName;
                } else {
                    $uploadErrors[] = "Document error: " . implode(", ", $uploader->getErrors());
                }
            }

            if (!empty($uploadErrors)) {
                $alert = implode("<br>", $uploadErrors);
            }

            if (!$alert) {

                $data = [
                    'host_user_id'   => $_SESSION['user_id'] ?? 1, 
                    'title'          => $_POST['title'],
                    'description'    => $_POST['description'],
                    'country'        => $_POST['country'],
                    'city'           => $_POST['city'],
                    'address_line'   => $_POST['address_line'],
                    'room_type'      => $_POST['room_type'],
                    'max_guests'     => $_POST['max_guests'],
                    'host_role'      => $_POST['host_role'],
                    'available_date' => $_POST['available_date'],
                    'image_path'     => $imagePathForDB,
                    'doc_path'       => $docPathForDB,
                    'services'       => $_POST['services'] ?? [],
                    'attributes'     => $_POST['attributes'] ?? []
                ];

                if (addListing($db, $data)) {
                    $alert = "Listing is published successfully!";
                    // header("Location: index.php?target=listings"); exit;
                } else {
                    $alert = "Database Error: Listing could not be created.";
                }
            }
        }

        include __DIR__ . '/../views/listings/add.php';
        break;

    default:
        // Other listing functions
        break;
}
