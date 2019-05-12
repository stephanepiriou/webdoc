<?php


namespace App\Controllers\Individus;

use Core\View;

class TypesIndividu extends \Core\Controller
{
    /**
     * Search an individu type
     *
     * @return void
     * @throws \Exception
     */
    public function searchAction(){
        View::render("Individus/search_type_individu.php", [
            'title' => 'Search an individu type'
        ]);
    }

    /**
     * Show an individu type
     *
     * @return void
     * @throws \Exception
     */
    public function showAction(){
        View::render("Individus/show_type_individu.php", [
            'title' => 'Individu'
        ]);
    }
}