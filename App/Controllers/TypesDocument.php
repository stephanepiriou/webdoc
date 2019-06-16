<?php
namespace App\Controllers;

use App\Models\TypeDocument;

use Core\View;
use function substr;
use function var_dump;

class TypesDocument extends Authenticated
{
    public function newAction(){
        View::render('TypesDocument/create-type-document.php');
    }

    /**
     * Handle creation of a document type
     * @throws \Exception
     */
    public function createAction(){
        $typeDocument = new TypeDocument($_POST);

        if ($typeDocument->save()) {
            $this->redirect('/types-document/create-type-document-success');
        } else {
            View::render('TypesDocument/create-type-document.php', [
                'typeDocument' => $typeDocument
            ]);
        }
    }

    /**
     *
     */
    public function createTypeDocumentSuccessAction()
    {
        View::render('TypesDocument/create-type-document-success.php');
    }

    public function searchAction(){
        View::render('TypesDocument/search-type-document.php');
    }

    public function listAction(){
        $subTypeDocumentName = substr($_POST['inputTypeDocumentName'], 0, 3);
        $typesDocumentAsJson = TypeDocument::getListSubAsJson($subTypeDocumentName);
        View::render('TypesDocument/list-types-document.php', [
            'typesDocumentAsJson' => $typesDocumentAsJson
        ]);
    }

    public function showAction(){
        $typeDocumentName = $_POST['typesDocumentName'];
        var_dump($typeDocumentName);
        View::render('TypesDocument/show-type-document.php');
    }

    public function updateAction(){

    }

    public function deleteAction(){

    }
}