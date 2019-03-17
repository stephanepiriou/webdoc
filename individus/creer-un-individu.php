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
                            <h5 style="text-align: center">Afficher un individu</h5>
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
                        <div class="col">&nbsp;
                            <label><b>Individu :</b></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Matricule :</label>
                        </div>
                        <div class="col-6">
                            <input id=\'input-matricule\' />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Type d\'individu :</label>
                        </div>
                        <div class="col-6">
                            <div id=\'dropdown-type-individu\'>
                            </div>
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
                            <label class="float-right">Nom :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Adresse :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-address" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Ville :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-city" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 float-right">
                            <label class="float-right">Code postal :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-postal-code" />
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
	var typeIndividuSource = [
		"Professeur",
		"Educateur",
		"Administration",
		"Elève"
	]
	$("#dropdown-type-individu").jqxDropDownList({source: typeIndividuSource, width: 198, height: 30, theme: "energyblue"});
	$("#input-matricule").jqxInput({width: 200, height: 30, theme: "energyblue"});
	$("#input-surname").jqxInput({width: 200, height: 30, theme: "energyblue"});
	$("#input-name").jqxInput({width: 200, height: 30, theme: "energyblue"});
	$("#input-address").jqxInput({width: 200, height: 30, theme: "energyblue"});
	$("#input-city").jqxInput({width: 200, height: 30, theme: "energyblue"});
	$("#input-postal-code").jqxInput({width: 200, height: 30, theme: "energyblue"});

	$("#button-save").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	$("#button-save").on("click", function (event) {

	});
</script>
</body>
</html>';
?>
?>