<?php
/**
 * Menu of the php views
 * @package App\View\Common
 * @filesource
 */

namespace App\Views\Common;

/**
 * Dummy class
 */
class Menu{}
?>
<!-- Menu authentified utilisateur user of the page -->
<div class="container">
    <div class="row">
        <div id="app-menu" class="offset-lg-3 col-lg-6">
            <script type="text/javascript">
	            // Create a jqxMenu
                $(document).ready(function () {

                    $("#jqxMenu").jqxMenu({
                        width: '100%',
                        height: '30px',
                        theme: 'energyblue'
                    });
                    var centerItems = function () {
                        var firstItem = $($("#jqxMenu ul:first").children()[0]);
                        firstItem.css('margin-left', 0);
                        var width = 0;
                        var borderOffset = 2;
                        $.each($("#jqxMenu ul:first").children(), function () {
                            width += $(this).outerWidth(true) + borderOffset;
                        });
                        var menuWidth = $("#jqxMenu").outerWidth();
                        firstItem.css('margin-left', (menuWidth / 2) - (width / 2));
                    };
                    centerItems();
                    $(window).resize(function () {
                        centerItems();
                    });

                    // Window about
                    $("#window-about").jqxWindow({
                        width: 400,
                        height: 70,
                        disabled: false,
                        theme: "energyblue"
                    });

                    $("#window-about").jqxWindow("close");

                    $("#about").on("click", function(event) {
                        $("#window-about").jqxWindow("open");
                    });

                    // Window Permission
                    $("#window-permission").jqxWindow({
                        width: 400,
                        height: 70,
                        disabled: false,
                        theme: "energyblue"
                    });

                    $("#window-permission").jqxWindow("close");

                    $(".no-permission").on("click", function(event) {
                        $("#window-permission").jqxWindow("open");
                    });
                });
            </script>
            <!--About window-->
            <div id="window-about">
                <div>Au sujet de...</div>
                <div>Copyright &copy; 2019 [Stéphane Piriou], MIT License.</div>
            </div>
            <!-- no-permission window-->
            <div id="window-permission">
                <div>Information</div>
                <div>Votre compte ne vous permet pas d&apos;accéder à cette page.</div>
            </div>
            <!--Html menu structure-->
            <div id='jqxMenu'>
                <ul>
                    <li>Connexion
                        <ul>
                            <!--<li><a href="/login/new" style="cursor: alias;color: blue;">Se Connecter</a></li>-->
                            <li><a href="/login/destroy" style="cursor: alias;color: blue;">Déconnecter</a></li>
                        </ul>
                    <li>Individu
                        <ul>
                            <li><a href="/individus/search" style="cursor: alias;color: blue;">Chercher un Individu</a></li>
                            <li><a class="no-permission">Créer un Individu</a></li>
                            <li style="color: rgb(148, 176,202);cursor: default;" >---------------------</li>
                            <li><a href="/types-individu/search" style="cursor: alias;color: blue;">Chercher un Type d'Individu</a></li>
                            <li><a class="no-permission">Créer un Type d'Individu</a></li>
                        </ul>
                    </li>
                    <li>Documents
                        <ul>
                            <li><a href="/types-document/search" style="cursor: alias;color: blue;">Chercher un Type de Document</a></li>
                            <li><a class="no-permission">Créer un Type de Document</a></li>
                        </ul>
                    </li>
                    <li>Collecter
                        <ul>
                            <li><a href="/collect/new" style="cursor: alias;color: blue;">Collecter tous les documents</a></li>
                        </ul>
                    </li>
                    <li>Utilisateurs
                        <ul>
                            <li ><a class="no-permission">Chercher un utilisateur</a></li>
                            <li ><a class="no-permission">Créer un utilisateur</a></li>
                        </ul>
                    </li>
                    <li>Backup
                        <ul>
                            <li><a class="no-permission">Gérer</a></li>
                        </ul>
                    </li>
                    <li>?
                        <ul>
                            <li><a id="about" style="cursor: alias;color: blue;">Au sujet de...</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>