<?php
namespace App\Models;

use Core\Model;
use PDOException;
use PDO;

class Document extends Model
{
    public function save(){

    }

    public function update(){

    }

    public function validate(){

    }

    public function delete(){

    }

    /**
     * Fetch all documents by Individu and deliver it in an INNER JOIN
     */
    public static function listByIndividuId($individuid){
        $sql = 'SELECT documents.id AS document_id, documents.nom AS document_name, typesdocument.name AS type_document_name 
                FROM documents 
                INNER JOIN documents_individus ON documents.id=documents_individus.documentid 
                INNER JOIN individus ON individus.id=documents_individus.individuid INNER JOIN typesdocument on documents.DocumentTypesid = typesdocument.id 
                WHERE individuid=:individuid';
        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':individuid', $individuid, PDO::PARAM_INT);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $jsonList = json_encode($array,JSON_UNESCAPED_UNICODE);
        return $jsonList;
    }
}