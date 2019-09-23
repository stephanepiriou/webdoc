<?php
/**
 * File for Documents class
 * @package App\Controllers
 */
namespace App\Controllers;

use App\Config;
use Core\View;
use App\Models\Document;
use App\Models\TypeDocument;
use App\Uploader;

/**
 * Class Documents
 * Control the Document domain of the application
 * @package App\Controllers
 */
class Documents extends Authenticated
{
    /**
     * Load the view proposing the creation of a document
     * @return void
     * @throws \Exception
     */
    public function newAction(){
        //echo APPROOT;
        $individuid = $_POST['individuid'];
        $individufirstname = $_POST['individufirstname'];
        $individulastname = $_POST['individulastname'];
        $jsonListTypesDocument = TypeDocument::getListAsJson();
        View::render('Documents/upload-document.php',[
            'individuid' => $individuid,
            'individufirstname' => $individufirstname,
            'individulastname' => $individulastname,
            'jsonListTypesDocument' => $jsonListTypesDocument
        ]);
    }

    /**
     * Upload and create a document from the view /documents/new.
     * Redirect to /documents/new in case of faillure with proper error handling
     * @return void
     * @throws \Exception
     */
    public function uploadAction(){
        $individuid = $_POST['individuid'];
        $individulastname = $_POST['individulastname'];
        $individufirstname = $_POST['individufirstname'];
        $typedocument = $_POST['typedocument'];
        $file = $_FILES["fileToUpload"];
        $typedocumentid = TypeDocument::getIndexFromName($typedocument);
        $documentname = $typedocument.' de '.$individufirstname.' '.$individulastname;
        $upload = new Uploader($file, $documentname, $typedocumentid, $individuid);

        if($upload->uploadFile()){
            View::render('Documents/upload-document-success.php', [
                'individuid' => $individuid,
                'individulastname' => $individulastname,
                'individufirstname' => $individufirstname,
                'documentname' => $documentname
            ]);
        }else{
            $jsonListTypesDocument = TypeDocument::getListAsJson();
            View::render('Documents/upload-document.php',[
                'individuid' => $individuid,
                'individufirstname' => $individufirstname,
                'individulastname' => $individulastname,
                'chosentypedocument' => $typedocument,
                'jsonListTypesDocument' => $jsonListTypesDocument,
                'upload' => $upload
            ]);
        }

    }

    /**
     * Show an existing document under /documents/show
     * @return void
     * @throws \Exception
     */
    public function showAction(){
        $individuid = $_POST['individuid'];
        $documentid = $_POST['documentid'];
        $documentname = Document::getDocumentName($documentid);
        $filename = Document::getFileName($documentid);
        $filepath = Config::RELATIVE_UPLOAD_FOLDER . $filename;
        $serverfilepath = Config::SERVER_URL . $filepath;
        $absolutefilepath = Config::ABSOLUTE_UPLOAD_FOLDER . $filename;
        echo $serverfilepath;

        View::render('Documents/show-document.php',[
            'individuid' => $individuid,
            'documentname' => $documentname,
            'filepath' => $filepath,
            'serverfilepath' => $serverfilepath,
            //'filename' => $filename,
            'documentid' => $documentid,
        ]);
    }

    /**
     * Call Document::delete and redirect according to result
     * @return void
     * @throws \Exception
     */
    public function deleteAction(){
        $documentid = $_POST['documentid'];
        $individuid = $_POST['individuid'];
        if(Document::delete($documentid) === true){
            View::render('Documents/delete-document-success.php', [
                'individuid' => $individuid
                ]);
        }else{
            View::render('Documents/delete-document-faillure.php', [
                'individuid' => $individuid
            ]);
        }

    }
}