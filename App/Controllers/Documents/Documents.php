<?php

namespace App\Controllers\Documents;

use Core\View;

class Documents extends \Core\Controller
{
    /**
     * Search a document
     *
     * @return void
     * @throws \Exception
     */
    public function searchAction(){
        View::render("Documents/search_document.php", [
            'title' => 'Search a document'
        ]);
    }

    /**
     * Show a document
     *
     * @return void
     * @throws \Exception
     */
    public function showAction(){
        View::render("Documents/show_document.php", [
            'title' => 'Document'
        ]);
    }
}