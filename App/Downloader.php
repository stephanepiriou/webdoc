<?php
/**
 * File for Downloader class
 * @package App
 * @filesource
 */
namespace App;
use ZipArchive;
use App\Config;
/**
 * Downloader class of the application
 * @package App
 *
 */


class Downloader
{

    /**
     * @var string The complete path with the hashed file name
     */
    private $hashedZipPath;
    /**
     * @var The complete path of the original file
     */
    private $originalFilePath;

    /**
     * @var string The "normal" file name
     */
    private $regularFileName;

    /**
     * @var string The Name under which the file is send, i.e. the document name + the file extention
     */
    private $regularFilePath;

    /**
     * Downloader constructor.
     * @param $filename The file name of the document on the disk
     * @param $documentName The name of the document
     */
    public function __construct($filename, $documentName){

        $this->getRegularFileName($filename, $documentName);
        $this->regularFilePath = Config::ABSOLUTE_UPLOAD_FOLDER.'/'.$this->regularFileName;
        $this->originalFilePath = Config::ABSOLUTE_UPLOAD_FOLDER.'/'.$filename;
        copy($this->originalFilePath, $this->regularFilePath);
    }

    /**
     * Get the regular file name under which the file will be send
     * @param $filename the File name of the document
     * @return string hash of the document name
     */
    private function getRegularFileName($filename, $documentName){
        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $this->regularFileName = $documentName . '.' .$fileExtension;
    }

    /**
     * Send the zip containing the file and delete it afterward
     */
    public function send(){
        //echo "send doc";
        if (file_exists($this->regularFilePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($this->regularFilePath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($this->regularFilePath));
            readfile($this->hashedZipPath);
            //exit;
        }
        unlink($this->regularFilePath);
    }
}