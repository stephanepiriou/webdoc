<?php
/**
 * File for Downloader class
 * @package App
 * @filesource
 */
namespace App;
use ZipArchive;
use App\Config;
use Core\Logger;
/**
 * Downloader class of the application
 * @package App
 *
 */


class Downloader
{

    /**
     * Tell if download is successful.
     * Return the number of bites read in case of success
     * or false in case of faillure
     * @var integer | false
     */
    private $success;

    /**
     * The complete path of the original file
     * @var string
     */
    private $originalFilePath;

    /**
     * The "normal" file name
     * @var string
     */
    private $regularFileName;

    /**
     * The Name under which the file is send, i.e. the document name + the file extention
     * @var string
     */
    private $regularFilePath;

    /**
     * Downloader constructor.
     * @param $filename The file name of the document on the disk
     * @param $documentName The name of the document
     */
    public function __construct($filename, $documentName){
        $this->success = false;
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
            $this->success = readfile($this->regularFilePath);
            unlink($this->regularFilePath);
        }
    }

    /**
     * Return if download process is a success
     * @return bool|false|int
     */
    public function isDownloadSuccess(){
        return $this->success;
    }
}