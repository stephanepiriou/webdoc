<?php


namespace App;

use App\Command;
use App\Config;
use App\FtpClient\FtpException;
use App\Models\Backup AS BackupModel;
use App\FtpClient\FtpClient;

/**
 * Class Backup
 * Create a backup from the Uploaded Document folder as well as a sqldump of the database,
 * compress them in a tar.gz archive file and upload it on a remote FTP server.
 * Clean after that the temporary backup folder.
 * @package App
 */
class Backup
{
    const REMOTE_BACKUP_FOLDER = '~/files/';

    const ZIP_FOLDER = 'zip/';

    /**
     * @var string $backupfilename whole archive package comprising upload folder and database dump
     */
    private $backupfilename;

    /**
     * @var string $backupUploadFolderArchive upload folder archive file name
     */
    private $backupUploadFolderArchive;

    /**
     * @var string $databaseDump;
     */
    private $databaseDump;

    /**
     * Backup constructor.
     */
    public function __construct()
    {
        $this->backupfilename = 'backup.tar.gz';
        $this->backupUploadFolderArchive = 'backupuploadfolder.tar.gz';
        $this->databaseDump = 'databasedump.sql';
        $this->checkBackupFolder();
    }

    public function createBackup(){

        $exitcode = $this->backupUploadFolder();
        $exitcode += $this->backupDB();
        $exitcode += $this->zipBackup();

        try {
            $this->upladBackupToRemoteFTP();
        } catch (FtpException $ftpException) {
            $exitcode += 1;
        }
        $this->cleanBackupFolder();
        $idOldBackup = BackupModel::getLastIteration();
        BackupModel::createBackup($this->backupfilename);
        BackupModel::delateBackup($idOldBackup);

        if($exitcode) {
            return false;
        } else {
            return true;
        }
    }



    public function restoreBackup(){
        $exitcode = 0;
        try {
            $this->downloadBackupFromRemoteFTP();
        } catch (FtpException $ftpException) {
            $exitcode += 1;
        }

        if($exitcode) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Backup Upload Folder
     */
    private function backupUploadFolder(){
        // Shell command to compress upload folder
        $archiveUploadFolderCommandShell = new Command(array(
            'command' => 'tar',
            'procOptions' => array(
                'bypass_shell' => true,
            ),
        ));
        $archiveUploadFolderCommandShell->addArg('-zcv', '');
        $archiveUploadFolderCommandShell->addArg('--file', Config::ABSOLUTE_BACKUP_FOLDER . self::ZIP_FOLDER . $this->backupUploadFolderArchive);
        $archiveUploadFolderCommandShell->addArg('--directory', Config::ABSOLUTE_UPLOAD_FOLDER);
        $archiveUploadFolderCommandShell->addArg('.', '');
        $exitcode = $archiveUploadFolderCommandShell->execute();
    }


    /**
     * Backup database in dump SQL file
     * @return mixed
     */
    private function backupDB(){
        // Créate SQL dump of the database
        $dumpDatabaseCommandShell = new Command(array(
            'command' => 'mysqldump',
            'procOptions' => array(
                'bypass_shell' => true,
            ),
        ));
        //$dumpDatabaseCommandShell->addArg('--opt', '');
        $dumpDatabaseCommandShell->addArg('--user=', Config::DB_USER);
        $dumpDatabaseCommandShell->addArg('--password=', Config::DB_PASSWORD);
        $dumpDatabaseCommandShell->addArg( '--databases', Config::DB_NAME);
        $dumpDatabaseCommandShell->addArg('>', Config::ABSOLUTE_BACKUP_FOLDER . self::ZIP_FOLDER . $this->databaseDump);
        $dumpDatabaseCommandShell->execute();
    }

    private function zipBackup(){
        $archiveUploadFolderCommandShell = new Command(array(
            'command' => 'tar',
            'procOptions' => array(
                'bypass_shell' => true,
            ),
        ));
        $archiveUploadFolderCommandShell->addArg('-zcv', '');
        $archiveUploadFolderCommandShell->addArg('--file', Config::ABSOLUTE_BACKUP_FOLDER. $this->backupfilename);
        $archiveUploadFolderCommandShell->addArg('--directory', Config::ABSOLUTE_BACKUP_FOLDER . self::ZIP_FOLDER);
        $archiveUploadFolderCommandShell->addArg('.', '');
        $archiveUploadFolderCommandShell->execute();
    }



    /**
     * Upload gzipped backup to remote ftp server
     * @throws FtpException
     */
    public function upladBackupToRemoteFTP(){
        $ftp = new FtpClient();
        $ftp->setPhpLimit('5000MB');
        try {
            $ftp->connect(Config::REMOTE_FTP_HOST);
            $ftp->login(Config::REMOTE_FTP_USER, Config::REMOTE_FTP_PASSWORD);
            $ftp->chdir('/home/ftpuser/ftp/files/');
            $ftp->cleanDir('/home/ftpuser/ftp/files/');
            //$ftp->put($this->backupfilename, Config::ABSOLUTE_BACKUP_FOLDER. $this->backupfilename);
            $ftp->putFromPath(Config::ABSOLUTE_BACKUP_FOLDER.$this->backupfilename);
        }catch (FtpException $ftpException){

        }

        $ftp->close();
    }

    /**
     * Download gzipped backup from remote ftp server
     * @throws FtpException
     */
    private function downloadBackupFromRemoteFTP(){
        $ftp = new FtpClient();
        $ftp->setPhpLimit('5000MB');
        try {
            $ftp->connect(Config::REMOTE_FTP_HOST);
            $ftp->login(Config::REMOTE_FTP_USER, Config::REMOTE_FTP_PASSWORD);
            $ftp->chdir('/home/ftpuser/ftp/files/');

        } catch (FTPException $ftpExceptione){

        }
        $ftp->close();
    }

    /**
     * Check existence of and create required folder to create
     */
    private function checkBackupFolder(){
        if(!is_dir(Config::ABSOLUTE_BACKUP_FOLDER)){
            mkdir(Config::ABSOLUTE_BACKUP_FOLDER, 0777, true);
        }
        if(!is_dir(Config::ABSOLUTE_BACKUP_FOLDER.self::ZIP_FOLDER)){
            mkdir(Config::ABSOLUTE_BACKUP_FOLDER.self::ZIP_FOLDER, 0777, true);
        }
    }

    /**
     * Delete Backup folder and its content
     */
    private function cleanBackupFolder(){
        //$this->deleteFiles(Config::ABSOLUTE_BACKUP_FOLDER . self::ZIP_FOLDER);
        $this->deleteFiles(Config::ABSOLUTE_BACKUP_FOLDER);
    }

    /**
     * Delete recursively Files and directory in specified directory
     * @param $target string the directory and its content to delete
     */
    private function deleteFiles($target) {
        if(is_dir($target)){
            $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
            foreach( $files as $file ){
                $this->deleteFiles( $file );
            }
            rmdir( $target );
        } elseif(is_file($target)) {
            unlink( $target );
        }
    }
}