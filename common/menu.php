<?php
echo ' <div class="row">
            <div id="app-menu" class="offset-lg-3 col-lg-6">
                <script type="text/javascript">
					$(document).ready(function () {
						// Create a jqxMenu
						$("#jqxMenu").jqxMenu({
							width: \'100%\',
							height: \'30px\',
							theme: \'energyblue\'
						});
						var centerItems = function () {
							var firstItem = $($("#jqxMenu ul:first").children()[0]);
							firstItem.css(\'margin-left\', 0);
							var width = 0;
							var borderOffset = 2;
							$.each($("#jqxMenu ul:first").children(), function () {
								width += $(this).outerWidth(true) + borderOffset;
							});
							var menuWidth = $("#jqxMenu").outerWidth();
							firstItem.css(\'margin-left\', (menuWidth / 2) - (width / 2));
						};
						centerItems();
						$(window).resize(function () {
							centerItems();
						});
					});
                </script>
                <!-- <div id=\'jqxWidget\'> -->
                <div id=\'jqxMenu\'>
                    <ul>
                        <li>Connexion
                            <ul>
                                <li><a href="#">Déconnecter</a></li>
                            </ul>
                        <li>Individu
                            <ul>
                                <li><a href="#">Chercher un Individu</a></li>
                                <li><a href="#">Créer un Individu</a></li>
                                <li><a href="#">Chercher un Type d\'Individu</a></li>
                                <li><a href="#">Créer un Type d\'Individu</a></li>
                            </ul>
                        </li>
                        <li>Documents
                            <ul>
                                <li><a href="#">Chercher un Document</a></li>
                                <li><a href="#">Chercher un Type de Document</a></li>
                                <li><a href="#">Créer un Type de Document</a></li>
                            </ul>
                        </li>
                        <li>Backup
                            <ul>
                                <li><a href="#">Créer un backup</a></li>
                                <li><a href="#">Restaurer un backup</a></li>
                            </ul>
                        </li>
                        <li>Utilisateurs
                            <ul>
                                <li><a href="#">Créer un utilisateur</a></li>
                                <li><a href="#">Chercher un utilisateur</a></li>
                            </ul>
                        </li@   >
                        <li>?
                            <ul>
                                <li><a href="#">Aide</a></li>
                                <li><a href="#">Au sujet de...</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- </div> -->
            </div>
        </div>';
?>