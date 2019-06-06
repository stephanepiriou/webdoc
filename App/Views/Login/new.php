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
        <h1>WEBDOC</h1>
    </div>
    <!-- Begin page content -->
    <div class="container">

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