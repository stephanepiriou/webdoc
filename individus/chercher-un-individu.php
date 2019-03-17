<?php
include('../common/header.php');
include('../common/menu.php');

echo '
        <div class="row">
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
                            <h5 style="text-align: center">Chercher un Individu</h5 >
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
            <!--MAIN PANEL-->
            <div id = "main-panel"  class="offset-lg-3 col-lg-6">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            
                        </div>
                        <div class="col-6">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div style="display: table; margin: auto">
                                <label class="float-right">Chercher par </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div >
                                <div id="dropdown-type-recherche"> </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <div style="display: table; margin: auto">
                               <b>:</b>
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                                <input id="input-nom-matricule"/>
                            </div>
                        </div>
                    </div >
                    
                    <div class="row">
                        <div class="col">&nbsp;
                            <div id="datatable-individu">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="align-content: center">
                        <div class="col">&nbsp;&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                        </div>
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                                <input type="button" value="Chercher" id="button-chercher" style="align-content: center" />
                            </div>
                        </div>
                        <div class="col-4">
                        </div>
                    </div >
                    <div class="row">
                        <div class="col">&nbsp;&nbsp;</div>
                    </div>
                </div >
            </div >
        </div >
    </div >
</div >

<div class="col-lg-12" id = "footer" >

</div >
<script type = "text/javascript" >
    var typeRechercheSource = [
    	"matricule",
    	"nom"
    ]
    $("#dropdown-type-recherche").jqxDropDownList({source: typeRechercheSource, width: "100%", height: 30, disabled: false,theme: "energyblue"});

    $("#input-nom-matricule") . jqxInput({width: "100%", height: 30, placeHolder: "nom/matricule", theme: "energyblue"});

    	$("#datatable-individu").jqxDataTable({
    	height: 150,
        theme: "energyblue",
		altRows: true,
		sortable: true,
		columns: [
			{ text: "ID", dataField: "id", align: "center", width: 50 },
			{ text: "Type Individu", dataField: "type", align: "center", width: 445 }
		]
    });
	$("#datatable-individu").on("rowSelect", function (event) {
        // event arguments
        var args = event.args;
        // row index
        var index = args.index;
        // row data
        var rowData = args.row;
        // row key
        var rowKey = args.key;
    });
    
	$("#button-chercher").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	$("#button-chercher").on("click", function (event) {
		
	});
</script >
</body >
</html >';

?>