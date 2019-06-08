<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--  PAGE TITLE   -->
    <title>Login</title>
    <link rel="stylesheet" href="/styles/bootstrap.css" >
    <link rel="stylesheet" href="/styles/jqx.base.css">
    <link rel="stylesheet" href="/styles/jqx.energyblue.css">
    <link rel="stylesheet" href="/styles/custom.css">
    <script type="text/javascript" src="/scripts/jqx-all.js"></script>
    <script type="text/javascript" src="/scripts/menu.js"></script>
</head>
<body>
 <!-- Get persitent field from submit action -->
    <?php isset($email) ? $email = $email : $email = "";?>
    <?php isset($remember) ? $checked = "checked=\"checked\"" : $checked = "";?>

 <!--Flash message section-->
 <!-- Note : has to be included once in base template for project ECI -->
 <?php use App\Flash; ?>
 <?php $messages = Flash::getMessage()?>
 <?php if (isset($messages)):?>
     <?php foreach( $messages as $message): ?>
         <div class="alert alert-<?= $message['type'] ?>">
             <?= $message['body'] ?>
         </div>
     <?php endforeach; ?>
 <?php endif; ?>


<div id="wrap">
    <div id="pageheader">
        <h1><strong>webdoc</strong></h1>
    </div>
    <!-- Begin page content -->
    <div class="container">
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
        <div class=""row>
            <div class="col">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <!-- TITLE PAGE-->
            <div id="page-title" class="offset-lg-3 col-lg-6">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h5 style="text-align: center">Log In</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div id="main-panel"  class="offset-lg-3 col-lg-6">
                <form id="form-login" action="/login/create" method="post">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <label class="float-right">Email :</label>
                            </div>
                            <div class="col-6">
                                <input id="inputEmail" name="email" placeholder="Email adresse" required type="email" value="<?=$email?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="float-right">Password :</label>
                            </div>
                            <div class="col-6">
                                <input type="password" id="inputPassword" name="password" placeholder="Password" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label class="float-right">Remember me :</label>
                            </div>
                            <div class="col-6">
                                <!--<input id="remember_me" type="checkbox" name="remember_me" <?=$checked?>/>-->
                                <div id="remember_me" name="remember_me"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row" style="align-content: center">
                            <div class="col">
                                <div style="display: table; margin: auto">
                                    <input type="button" value="Log in" id="button-submit" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 <div class="col-lg-12" id="footer">
 </div>

<script type="text/javascript">
	$(document).ready(function () {

	});

	$('#inputEmail').jqxInput({width: 200, height: 30, theme: "energyblue"});

	$('#inputPassword').jqxPasswordInput({ width: 200, height: 30, theme: "energyblue"});

	$('#remember_me').jqxCheckBox({ width: 25, height: 25, theme:"energyblue" });

	$("#button-submit").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	$('#button-submit').click(function(){
		$('#form-login').submit();
    });
</script>
</body>
</html>

<?php

?>