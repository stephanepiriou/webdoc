<?php
namespace App\Controllers;

use App\Models\TypeDocument;

use Core\View;

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
            //header('Location: http://' . $_SERVER['HTTP_HOST'] . '/signup/success', true, 303);
            //exit;

        } else {

            View::render('TypesDocument/create-type-document.php', [
                'type_document' => $typeDocument
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

    public function showAction(){

    }

    public function updateAction(){

    }

    public function deleteAction(){

    }
}