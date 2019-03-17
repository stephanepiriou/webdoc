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
                            <h5 style="text-align: center">Chercher un type d\'individu</h5 >
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
                            <label class="float-right"> Type de d\'individu :</label>
                        </div>
                        <div class="col-6">
                            <input id ="input-type-individu" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">&nbsp;
                            <div id="datatable-type-individu">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="align-content: center">
                        <div class="col">&nbsp;&nbsp;</div>
                    </div>
                     <div class="row" style = "align-content: center">
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
                </div >
            </div >
        </div >
    </div >
</div >

<div class="col-lg-12" id = "footer" >

</div >
<script type = "text/javascript" >
    $("#input-type-individu") . jqxInput({width: 250, height: 30, placeHolder: "Entrez le nom du type d\'individu", theme: "energyblue"});

    	$("#datatable-type-individu").jqxDataTable({
    	height: 150,
        theme: "energyblue",
		altRows: true,
		sortable: true,
		columns: [
			{ text: "ID", dataField: "id", align: "center", width: 50 },
			{ text: "Type Individu", dataField: "type", align: "center", width: 445 }
		]
    });
	$("#datatable-type-individu").on("rowSelect", function (event) {
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