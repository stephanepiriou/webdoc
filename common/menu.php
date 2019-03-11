<?php
echo '<div id="menu" class="offset-lg-3 col-lg-6">
           <script type="text/javascript">
                $(document).ready(function () {
                    // Create a jqxMenu
                    $("#jqxMenu").jqxMenu({ width: \'100%\', height: \'30px\'});
                    var centerItems = function () {
                        var firstItem = $($("#jqxMenu ul:first").children()[0]);
                        firstItem.css(\'margin-left\', 0);
                        var width = 0;
                        var borderOffset = 2;
                        $.each($("#jqxMenu ul:first").children(), function () {
                          width += $(this).outerWidth(true) + borderOffset;
                        });
                        var menuWidth = $("#jqxMenu").outerWidth();
                        firstItem.css(\'margin-left\', (menuWidth / 2 ) - (width / 2));
                    }
                    centerItems();
                    $(window).resize(function () {
                        centerItems();
                    });
                });
            </script>
            <div id=\'jqxWidget\'>
                <div id=\'jqxMenu\'>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>professeurs
                            <ul>
                                <li><a href="#">Chercher Un professeur</a></li>
                                <li><a href="#">Créer un professeur</a></li>
                                <li><a href="#">Our Vision</a></li>
                            </ul>
                        </li>
                        <li>Eleves
                            <ul>
                                <li><a href="#">Chercher un élève</a></li>
                                <li><a href="#">Créer un éleve</a></li>
                                <li><a href="#">Featured</a></li>
                             </ul>
                            </li>
                        <li>Documents
                            <ul>
                                <li><a href="#">Chercher un ddocument</a></li>
                                <li><a href="#">Used</a></li>
                                <li><a href="#">Featured</a></li>
                             </ul>
                        </li>
                        <li>?
                            <ul>
                                <li><a href="#">help</a></li>
                                <li><a href="#">about</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>';
?>