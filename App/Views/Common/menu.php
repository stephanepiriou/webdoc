<!-- Menu of the page -->
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
            <!--About window-->
            <div id="window-about">
                <div>Au sujet de...</div>
                <div>Copyright &copy; 2019 [Stéphane Piriou], MIT License.</div>
            </div>
            <!--Html menu structure-->
            <div id='jqxMenu'>
                <ul>
                    <li>Connexion
                        <ul>
                            <li><a href="/login/new">Se Connecter</a></li>
                            <li><a href="/login/destroy">Déconnecter</a></li>
                        </ul>
                    <li>Individu
                        <ul>
                            <li><a href="/individus/search">Chercher un Individu</a></li>
                            <li><a href="/individus/new">Créer un Individu</a></li>
                            <li style="color: rgb(148, 176,202);">---------------------</li>
                            <li><a href="/types-individu/search">Chercher un Type d'Individu</a></li>
                            <li><a href="/types-individu/new">Créer un Type d'Individu</a></li>
                        </ul>
                    </li>
                    <li>Documents
                        <ul>
                            <li><a href="/types-document/search">Chercher un Type de Document</a></li>
                            <li><a href="/types-document/new">Créer un Type de Document</a></li>
                        </ul>
                    </li>
                    <li>Utilisateurs
                        <ul>
                            <li><a href="/users/search">Chercher un utilisateur</a></li>
                            <li><a href="/users/new">Créer un utilisateur</a></li>
                        </ul>
                    </li>
                    <li>?
                        <ul>
                            <li><a id="about" >Au sujet de...</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>