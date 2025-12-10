<?php

namespace helpers;

class FileUpload
{
    private $uploadDir;
    private $types;
    private $maxSize;
    private $errors = [];

    public function __construct($uploadDir = 'public/uploads', $types = ['jpg', 'png', 'jpeg', 'pdf'], $maxSize = 2 * 1024 * 1024){
        $this->uploadDir = __DIR__ . '/../../'.$uploadDir.'/';
        $this->types = $types;
        $this->maxSize = $maxSize;
        if(!is_dir($this->uploadDir)){
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function getErrors(){
        return $this->errors;
    }

    /**
    * Uploads the file to the server.
    * * @param array $file
    * @return string|bool
    */
    public function upload($file){
        if(!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK){
            $this->errors[] = "File upload error";
            return false;
        }

        if($file['size'] > $this->maxSize){
            $this->errors[] = "File size too big";
            return false;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if(!in_array($ext, $this->types)){
            $this->errors[] = "Invalid file type";
            return false;
        }

        $newFileName = uniqid('', true) . '.' . $ext;

        $destination = $this->uploadDir . $newFileName;
        if(move_uploaded_file($file['tmp_name'], $destination)) {
            return $newFileName;
        }else{
            $this->errors[] = "Failed to upload file";
            return false;
        }
    }
}