<div class=""row>
    <div class="col">
        &nbsp;
    </div>
</div>
<div class="row">
    <div id="app-menu" class="offset-lg-3 col-lg-6">
        <script type="text/javascript">
			$(document).ready(function () {
				// Create a jqxMenu
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

			});
        </script>

        <div id="window-about">
            <div>Au sujet de...</div>
            <div>Copyright (c) 2019 [Stéphane Piriou], MIT License.</div>
        </div>
        <div id='jqxMenu'>
            <ul>
                <li>Connexion
                    <ul>
                        <li><a href="logout">Déconnecter</a></li>
                    </ul>
                <li>Individu
                    <ul>
                        <li><a href="../individus/chercher-type-individu.php">Chercher un Individu</a></li>
                        <li><a href="../individus/creer-un-individu.php">Créer un Individu</a></li>
                        <li style="color: rgb(148, 176,202);">---------------------</li>
                        <li><a href="../individus/chercher-type-individu.php">Chercher un Type d'Individu</a></li>
                        <li><a href="../individus/creer-un-individu.php">Créer un Type d'Individu</a></li>
                    </ul>
                </li>
                <li>Documents
                    <ul>
                        <li><a href="../documents/chercher-un-document.php">Chercher un Document</a></li>
                        <li style="color: rgb(148, 176,202);">---------------------</li>
                        <li><a href="../documents/chercher-type-document.php">Chercher un Type de Document</a></li>
                        <li><a href="../documents/creer-type-document.php">Créer un Type de Document</a></li>
                    </ul>
                </li>
                <li>Backup
                    <ul>
                        <li><a href="../backup/creer-un-backup.php">Créer un backup</a></li>
                        <li><a href="../backup/restaurer-un-backup.php">Restaurer un backup</a></li>
                    </ul>
                </li>
                <li>Utilisateurs
                    <ul>
                        <li><a href="../utilisateurs/creer-un-utilisateur.php">Créer un utilisateur</a></li>
                        <li><a href="../utilisateurs/chercher-un-utilisateur.php">Chercher un utilisateur</a></li>
                    </ul>
                </li@   >
                <li>?
                    <ul>
                        <li><a href="../aide/aide.php">Aide</a></li>
                        <li><a id="about" >Au sujet de...</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>