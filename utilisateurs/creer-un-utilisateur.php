<?php
include('../common/header.php');
include('../common/menu.php');


echo '
        <div class="row">
            <div class="col">&nbsp;
                &nbsp;
            </div>
        </div>
        <div class="row">
            <!-- TITLE PAGE-->
            <div id="page-title" class="offset-lg-3 col-lg-6">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h5 style="text-align: center">Créer un utilisateur</h5>
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
            <!-- MAIN PANEL-->
            <div id="main-panel"  class="offset-lg-3 col-lg-6">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Nom :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Prénom :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-surname" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Pseudo :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-pseudo" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Password :</label>
                        </div>
                        <div class="col-6">
                            <input type="password" id="input-password" />
                        </div>
                    </div>
                    <div class="row" style="align-content: center">
                        <div class="col">&nbsp;&nbsp;</div>
                    </div>
                    <div class="row" style="align-content: center">
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                               
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                                <input type="button" value="Sauver" id="button-save"/>
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12" id="footer">

</div>
<script type="text/javascript">
	
	$("#input-name").jqxInput({width: 200, height: 30, theme: "energyblue"});
	$("#input-surname").jqxInput({width: 200, height: 30, theme: "energyblue"});
	$("#input-pseudo").jqxInput({width: 200, height: 30, theme: "energyblue"});
	$("#input-password").jqxPasswordInput({width: 200, height: 30, theme: "energyblue"});

	$("#button-save").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	$("#button-save").on("click", function (event) {
        var name = $("#input-name").val();
        var surname = $("#input-surname").val();
        var pseudo = $("#input-pseudo").val();
        var password = $("#input-password").val();
        alert(password);
	});
</script>
</body>
</html>';
?>