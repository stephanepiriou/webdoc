<?php


namespace App;

use App\Models\Collect as CollectModel;
use App\Models\Individu;
use App\Models\Document;
use App\Config;
use ZipArchive;

class Collection
{

    /**
     * Informe if download is successfull
     * Return number of bite read in case of success
     * and false in case of faillure
     * @var false | int
     */
    private $success;

    /**
     * Contain list of existing individu in the DB
     * @var array
     */
    private $individus;

    /**
     * The string containing the path of the zipped file containing documents
     * @const string
     */
    const INDIVIDUS_ZIPPED_FILE = Config::ABSOLUTE_UPLOAD_FOLDER . 'Individus.zip';

    /**
     * Collection constructor.
     * Initiate
     * $succes to false
     * $individus with array containing Individu objects
     */
    public function __construct()
    {
        $this->success = false;
        $this->individus = Individu::listIndividus();
        $this->checkUploadFolder();
    }


    /**
     * Create zip file containing all the doc.
     */
    public function createZip()
    {
        $zip = new ZipArchive();
        $s = $zip->open(self::INDIVIDUS_ZIPPED_FILE, ZIPARCHIVE::CREATE);
        foreach ($this->individus as $count => $individu) {
            $individuFolder = '/' . $individu['foldername'] . '/';
            $documents = Document::listArrayByIndividuId($individu['id']);
            foreach ($documents as $count => $document) {
                $fileExtension = strtolower(pathinfo($document['filename'], PATHINFO_EXTENSION));
                $collectedFileName = $document['document_name'] . '.' . $fileExtension;
                $collectedFilePath = $individuFolder . $collectedFileName;
                $encodedFilePath = Config::ABSOLUTE_UPLOAD_FOLDER . $document['filename'];
                $zip->addFile($encodedFilePath, $collectedFilePath);
            }
        }
        $zip->close();
    }

    /**
     * Send the Zip archive te the client
     * @return bool|false|int faillure | le number of bytes send to the client.
     */
    public function send()
    {
        if (file_exists(self::INDIVIDUS_ZIPPED_FILE)) {

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            //header("Content-Type: application/force-download");
            header('Content-Disposition: attachment; filename=' . basename(self::INDIVIDUS_ZIPPED_FILE));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize(self::INDIVIDUS_ZIPPED_FILE));
            $this->success = readfile(self::INDIVIDUS_ZIPPED_FILE);
            return $this->success;
        }
    }

    /**
     * Deleting of the zip archive
     */
    public function deleteZip()
    {
        unlink(self::INDIVIDUS_ZIPPED_FILE);
    }

    /**
     * Check for existance of upload folder
     */
    public function checkUploadFolder(){
        if(!is_dir(Config::ABSOLUTE_UPLOAD_FOLDER)){
            mkdir(Config::ABSOLUTE_UPLOAD_FOLDER, 0777, true);
        }
    }
}