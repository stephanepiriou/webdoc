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
                    <div class="row">
                        <div class="col">&nbsp;
                            <label><b>Documents :</b></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">&nbsp;
                            <div id="documentsDataTable">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row" style="align-content: center">
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                                <input type="button" value="Mettre à jour" id=\'button-update-save\' style="align-content: center" />
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                                <input type="button" value="Effacer" id=\'button-delete\' style="align-content: center" />
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                                <input type="button" value="Create a document" id=\'button-create-document\' style="align-content: center" />
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
	$("#dropdown-type-individu").jqxDropDownList({source: typeIndividuSource, width: 198, height: 30, disabled: true,theme: "energyblue"});
	$("#input-matricule").jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});
	$("#input-surname").jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});
	$("#input-name").jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});
	$("#input-address").jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});
	$("#input-city").jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});
	$("#input-postal-code").jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});

	//DataTable containing list of Document
	$("#documentsDataTable").jqxDataTable({
        theme: "energyblue",
		altRows: true,
		sortable: true,
		columns: [
			{ text: "ID", dataField: "id", align: "center", width: 20 },
			{ text: "Nom", dataField: "nom", align: "center", width: 180 },
			{ text: "Type Document", dataField: "type", align: "center", width: 180 },
			{ text: "Path", dataField: "path", width: 117, align: "center", cellsAlign: "right", cellsFormat: "c2" }
		]
    });
	$("#documentsDataTable").on(\'rowSelect\', function (event) {
        // event arguments
        var args = event.args;
        // row index
        var index = args.index;
        // row data
        var rowData = args.row;
        // row key
        var rowKey = args.key;
    });

	$("#button-update-save").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	$("#button-update-save").on("click", function (event) {
		var value = $("#button-update-save").jqxButton("value");
		if(value === "Mettre à jour"){
			$("#button-update-save").jqxButton({value: "Sauver"});
			$("#dropdown-type-individu").jqxDropDownList({disabled: false});
			$("#input-matricule").jqxInput({disabled: false});
			$("#input-name").jqxInput({disabled: false});
			$("#input-surname").jqxInput({disabled: false});
			$("#input-address").jqxInput({disabled: false});
			$("#input-city").jqxInput({disabled: false});
			$("#input-postal-code").jqxInput({disabled: false});
        }else{
			$("#button-update-save").jqxButton({value: "Mettre à jour"});
			$("#dropdown-type-individu").jqxDropDownList({disabled: true});
			$("#input-matricule").jqxInput({disabled: true});
			$("#input-name").jqxInput({disabled: true});
			$("#input-surname").jqxInput({disabled: true});
			$("#input-address").jqxInput({disabled: true});
			$("#input-city").jqxInput({disabled: true});
			$("#input-postal-code").jqxInput({disabled: true});
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