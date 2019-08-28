<?php


namespace App;
Use App\Config;
Use App\Models\Document;

class Uploader
{
    /**
     * @var array $errors Collect errors from download process
     */
    public $errors = [];

    /**
     * @var Set if
     */
    private $uploadOk;
    private $file;
    private $documentname;
    private $typedocumentid;
    private $individuid;
    private $targetFile;
    private $targetFileName;
    private $targetFilePath;
    private $imageFileType;

    const UPLOAD_DIR_ACCESS_MODE = 0777;
    const UPLOAD_MAX_FILE_SIZE = 10485760;
    const UPLOAD_ALLOWED_MIME_TYPES = [
        'image/jpeg',
        'image/png',
        'image/gif',
    ];

    /**
     * Uploader constructor.
     * @param $file The file the uploader class must upload
     */
    public function __construct($file, $documentname, $typedocumentid, $individuid){
        $this->file = $file;
        $this->documentname = $documentname;
        $this->typedocumentid = $typedocumentid;
        $this->individuid = $individuid;
        //$this->target_file = Config::UPLOAD_FOLDER . $documentname;
        $this->targetFile = basename($this->file['name']);
        $this->imageFileType = strtolower(pathinfo($this->targetFile, PATHINFO_EXTENSION));

        $this->targetFileName = $documentname . '.' . $this->imageFileType;
        $this->targetFilePath = Config::ABSOLUTE_UPLOAD_FOLDER . $this->targetFileName;

        $this->uploadOk = true;
    }

    /**
     * Upload the document
     * @return bool True if document is uploaded false otherwise.
     */
    public function uploadFile(){
        $this->checkError();
        if($this->uploadOk) {
            if (!move_uploaded_file($this->file['tmp_name'], $this->targetFilePath)) {
                $this->errors[] = "Désolé, votre fichier n'a pas pu être uploader pour une raison inconnue !";
                return false;
            } else {
                Document::save($this->documentname, $this->typedocumentid, $this->individuid, $this->targetFileName);
                return true;
            }
        }else{
            return false;
        }
    }

    /**
     * Check for condition preventing the upload of the document
     * and reference an $errors string array for later indication
     * in the corresponding view.
     */
    private function checkError(){

        //Check if file is .jpg, .png, .jpeg, .gif
        if($this->imageFileType !== "jpg" && $this->imageFileType !== "png" && $this->imageFileType !== "jpeg" && $this->imageFileType !== "gif" ) {
            $this->errors[]= "Désolé. Seuls les fichiers .jpg, .jpeg, .png et .gif sont acceptés.";
            $this->uploadOk = false;
        }

        //Check if document exist in DB
        if (Document::checkDocument($this->documentname)){
            $this->errors[] = "Désolé, ce document existe déjà dans la base de donnée.";
            $this->uploadOk = false;
        }

        //Check if file already exist
        if (file_exists($this->targetFilePath)) {
            $this->errors[] = "Désolé. Ce fichier existe déjà.";
            $this->uploadOk = false;
        }

        // Check file size
        if ($this->file["size"] > 5000000) {
            $this->errors[] = "Désolé. La taille du fichier est limité à 5Mo.";
            $this->uploadOk = false;
        }
    }
}