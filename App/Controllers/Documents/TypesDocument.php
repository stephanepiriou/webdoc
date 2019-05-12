<?php

namespace App\Controllers\Documents;

use Core\View;

class TypesDocument extends \Core\Controller
{
    /**
     * Search a document type
     *
     * @return void
     * @throws \Exception
     */
    public function searchAction(){
        View::render("Documents/search_type_document.php", [
            'title' => 'Search a document type'
        ]);
    }

    /**
     * Show a document type
     *
     * @return void
     * @throws \Exception
     */
    public function showAction(){
        View::render("Documents/show_type_document.php", [
            'title' => 'Document type'
        ]);
    }
}