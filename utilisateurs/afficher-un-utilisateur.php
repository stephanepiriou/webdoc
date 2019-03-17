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
                            <h5 style="text-align: center">Afficher un utilisateur</h5>
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
                                <input type="button" value="Mettre à jour" id="button-update-save"/>
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                                <input type="button" value="Effacer" id="button-delete" />
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                                <input type="button" value="Create a document" id="button-create-document" />
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
	
	$("#input-name").jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});
	$("#input-surname").jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});
	$("#input-pseudo").jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});
	$("#input-password").jqxPasswordInput({width: 200, height: 30, disabled: true, theme: "energyblue"});

	
	$("#button-update-save").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	$("#button-update-save").on("click", function (event) {
		var value = $("#button-update-save").jqxButton("value");
		if(value === "Mettre à jour"){
			$("#button-update-save").jqxButton({value: "Sauver"});
			$("#input-name").jqxInput({disabled: false});
	        $("#input-surname").jqxInput({disabled: false});
	        $("#input-pseudo").jqxInput({disabled: false});
	        $("#input-password").jqxPasswordInput({disabled: false});
        }else{
			$("#button-update-save").jqxButton({value: "Mettre à jour"});
			$("#input-name").jqxInput({disabled: true});
	        $("#input-surname").jqxInput({disabled: true});
	        $("#input-pseudo").jqxInput({disabled: true});
	        $("#input-password").jqxPasswordInput({disabled: true});
        }
	});

	$("#button-delete").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	$("#button-delete").on("click", function (event) {

	});


	$("#button-create-document").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	$("#button-create-document").on("click", function (event) {

	});
</script>
</body>
</html>';

?>