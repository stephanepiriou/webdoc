<?php


namespace App;
Use App\Config;

class Uploader2
{
    /**
     * @var array $errors Collect errors from download process
     */
    public $errors = [];

    /**
     * @var Set if
     */
    public $uploadOk;
    private $file;
    private $targetFile;
    private $imageFileType;

    const UPLOAD_DIR_ACCESS_MODE = 0777;
    const UPLOAD_MAX_FILE_SIZE = 10485760;
    const UPLOAD_ALLOWED_MIME_TYPES = [
        'image/jpeg',
        'image/png',
        'image/gif',
    ];


    public function __construct($file){
        $this->file = $file;
        $this->target_file = Config::UPLOAD_FOLDER . basename($this->file['name']);
        $this->imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    }

    public function uploadFile(){
        $this->uploadOk = 1;
        $this->checkError();
        if (empty($this->errors)){
            if (!move_uploaded_file($this->file['tmp_name'] , $this->target_file)){
                $this->errors[] = "Désolé, votre fichier n'a pas pu être uploader pour une raison inconnue !";
                return false;
            }
            return true;
        }else{
            return false;
        }
    }

    private function checkError(){

        //Check if file is .jpg, .png, .jpeg, .gif
        if($this->imageFileType !== "jpg" && $this->imageFileType !== "png" && $this->imageFileType !== "jpeg" && $this->imageFileType !== "gif" ) {
            $this->errors[]= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $this->uploadOk = 0;
        }

        //Check if file already exist
        if (file_exists($this->target_file)) {
            $this->errors[] = "Sorry, file already exists.";
            $this->uploadOk = 0;
        }

        // Check file size
        if ($this->file["size"] > 5000000) {
            $this->errors[] = "Sorry, your file is too large.";
            $this->uploadOk = 0;
        }
    }

}