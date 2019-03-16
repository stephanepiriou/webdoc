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
                            <h5 style="text-align: center">Afficher un type de document</h5 >
                        </div >
                    </div >
                </div >
            </div >
        </div >
        <div class="row" >
            <div class="col" >
                &nbsp;
            </div >
        </div >
        <div class="row" >
            <!--MAIN PANEL-->
            <div id = "main-panel"  class="offset-lg-3 col-lg-6" >
                <div class="container" >
                    <div class="row" >
                        <div class="col-6" >
                            <label class="float-right" > Type de document :</label >
                        </div >
                        <div class="col-6" >
                            <input id ="input-denomination" />
                        </div >
                    </div >
                    <div class="row" >
                        <div class="row" >&nbsp;</div >
                    </div >
                    <div class="row" style = "align-content: center" >
                        <div class="col-4" style="display: table; margin: auto">
                           
                        </div>
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                                <input type="button" value="Effacer" id="button-delete" style="align-content: center" />
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
    $("#input-denomination") . jqxInput({width: 250, height: 30, placeHolder: "Entrez le nom du type d\'individu", disabled: true, theme: "energyblue"});

	$("#button-update-save").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	$("#button-update-save").on("click", function (event) {
		var value = $("#button-update-save").jqxButton("value");
		if(value === "Mettre à jour"){
			$("#button-update-save").jqxButton({value: "Sauver"});
			$("#input-denomination").jqxInput({disabled: false});
        }else{
			$("#button-update-save").jqxButton({value: "Mettre à jour"});
			$("#input-denomination").jqxInput({disabled: true});
        }
	});

	$("#button-delete").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	$("#button-delete").on("click", function (event) {

	});
</script >
</body >
</html >';

?>