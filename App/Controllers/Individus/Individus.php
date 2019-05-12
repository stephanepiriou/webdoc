<?php

namespace App\Controllers\Individus;

use Core\View;

class Individus extends \Core\Controller
{
    /**
     * Search an individu
     *
     * @return void
     * @throws \Exception
     */
    public function searchAction(){
        View::render("Individus/search_individu.php", [
            'title' => 'Search an individu'
        ]);
    }

    /**
     * Show an individu
     *
     * @return void
     * @throws \Exception
     */
    public function showAction(){
        View::render("Individus/show_individu.php", [
            'title' => 'Individu'
        ]);
    }
}