<?php
/**
 * File for Uploader class
 * @package App
 */

namespace App;
Use App\Config;
Use App\Models\Document;
use App\Models\TypeDocument;

/**
 * Class Uploader
 * Upload a file and check condition are met to allow it.
 * @package App
 */
class Uploader
{
    /**
     * @var array $errors Collect errors from download process
     */
    public $errors = [];

    /**
     * @var bool True if upload can process, false if errors present
     */
    private $uploadOk;

    /**
     * @var string Name of the file to be uploaded
     */
    private $file;

    /**
     * @var string Final document name
     */
    private $documentname;

    /**
     * @var int Id referencing the TypeDocument of the file to be uploaded
     */
    private $typedocumentid;

    /**
     * @var int Id of the individu
     */
    private $individuid;

    /**
     * @var string Original file name
     */
    private $targetFile;

    /**
     * @var string Final file name
     */
    private $targetFileName;

    /**
     * @var string Final file path
     */
    private $targetFilePath;

    /**
     * @var string File extension
     */
    private $imageFileType;

    /**
     * Uploader constructor.
     * @param $file string The file the uploader class must upload
     * @param $documentname string The document name
     * @param $typedocumentid int The typeducument id
     * @param $individuid int The individu id
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
     * @return void
     */
    private function checkError(){
	    if(TypeDocument::isThereFirstTypeDocument()) {
		    //Check if file is .jpg, .png, .jpeg, .gif
		    if ($this->imageFileType !== "jpg" && $this->imageFileType !== "png" && $this->imageFileType !== "jpeg" && $this->imageFileType !== "gif") {
			    $this->errors[] = "Désolé. Seuls les fichiers .jpg, .jpeg, .png et .gif sont acceptés.";
			    $this->uploadOk = false;
		    }

		    //Check if document exist in DB
		    if (Document::checkDocumentExist($this->documentname)) {
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
	    }else {
		    $this->errors[] = "Il n'y a pas de type de document à associer à ce document. Veuillez d'abord créer un type de document avant de procéder.";
	    }
    }
}