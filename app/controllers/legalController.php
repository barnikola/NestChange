<?php

require_once __DIR__ . '/../core/controller.php';
require_once __DIR__ . '/../models/legalcontent.php';

class LegalController extends Controller
{
    public function show(string $type)
    {
        $legalModel = new LegalContent();
        $document = $legalModel->getByType($type);

        if (!$document) {
            // Alternatively, show a 404 page
            header("HTTP/1.0 404 Not Found");
            echo "Legal document not found.";
            return;
        }

        $this->view('legal/show', [
            'document' => $document,
            'pageTitle' => $document['title'] . ' - NestChange'
        ]);
    }
}
