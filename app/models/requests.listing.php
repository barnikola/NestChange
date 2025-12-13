<?php

function generateUUID() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

function addListing($db, $data) {
    try {
        // 1. İşlemi Başlat (Zincirleme kaza olmasın diye)
        $db->beginTransaction();

        $listingID = generateUUID(); 

        $sqlListing = "INSERT INTO listing (
                           id, host_user_id, title, description, country, city, address_line, 
                           room_type, max_guests, host_role, status, created_at
                       ) VALUES (
                           :id, :host_user_id, :title, :description, :country, :city, :address_line, 
                           :room_type, :max_guests, :host_role, 'published', NOW()
                       )";
        
        $stmt = $db->prepare($sqlListing);
        $stmt->execute([
            ':id'           => $listingID,
            ':host_user_id' => $data['host_user_id'],
            ':title'        => $data['title'],
            ':description'  => $data['description'],
            ':country'      => $data['country'],
            ':city'         => $data['city'],
            ':address_line' => $data['address_line'],
            ':room_type'    => $data['room_type'],
            ':max_guests'   => $data['max_guests'],
            ':host_role'    => $data['host_role'] // <-- Bu eksikti, ekledik
        ]);

        if (!empty($data['image_path'])) {
            $imageID = generateUUID();
            
            $sqlImage = "INSERT INTO listing_image (id, listing_id, image, position, created_at) 
                         VALUES (:id, :listing_id, :image, 0, NOW())";
            
            $stmtImg = $db->prepare($sqlImage);
            $stmtImg->execute([
                ':id' => $imageID,
                ':listing_id' => $listingID,
                ':image' => $data['image_path']
            ]);
        }

        if (!empty($data['doc_path'])) {
            $docID = generateUUID();
            
            $sqlDoc = "INSERT INTO listing_verification_document (
                           id, listing_id, document_type_id, document, status, created_at
                       ) VALUES (
                           :id, :listing_id, 1, :document, 'pending', NOW()
                       )";
            
            $stmtDoc = $db->prepare($sqlDoc);
            $stmtDoc->execute([
                ':id' => $docID,
                ':listing_id' => $listingID,
                ':document' => $data['doc_path']
            ]);
        }

        if (!empty($data['available_date'])) {
            $availID = generateUUID();
            
            $sqlAvail = "INSERT INTO listing_availability (id, listing_id, available, created_at) 
                         VALUES (:id, :listing_id, :available, NOW())";
            
            $stmtAvail = $db->prepare($sqlAvail);
            $stmtAvail->execute([
                ':id' => $availID,
                ':listing_id' => $listingID,
                ':available' => $data['available_date']
            ]);
        }

        if (!empty($data['attributes']) && is_array($data['attributes'])) {
            $sqlAttr = "INSERT INTO listing_attribute (listing_id, attribute_id) VALUES (:lid, :aid)";
            $stmtAttr = $db->prepare($sqlAttr);
            
            foreach ($data['attributes'] as $attrID) {
                $stmtAttr->execute([
                    ':lid' => $listingID,
                    ':aid' => $attrID
                ]);
            }
        }

        if (!empty($data['services']) && is_array($data['services'])) {
            $sqlServ = "INSERT INTO listing_service (listing_id, service_id) VALUES (:lid, :sid)";
            $stmtServ = $db->prepare($sqlServ);
            
            foreach ($data['services'] as $serviceID) {
                $stmtServ->execute([
                    ':lid' => $listingID,
                    ':sid' => $serviceID
                ]);
            }
        }

        $db->commit();
        return true;

    } catch (PDOException $e) {
        $db->rollBack();
        return false;
    }
}