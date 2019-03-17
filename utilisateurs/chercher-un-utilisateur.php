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
                            <h5 style="text-align: center">Chercher un utilisateur</h5 >
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
                            <label class="float-right"> Pseudo :</label>
                        </div>
                        <div class="col-6">
                            <input id ="input-pseudo" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                        </div>
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                                <input type="button" value="Chercher" id="button-chercher"/>
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
    $("#input-pseudo") . jqxInput({width: 230, height: 30, placeHolder: "Entrez le pseudo d\'un utilisateur", theme: "energyblue"});
    
	$("#button-chercher").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	$("#button-chercher").on("click", function (event) {
		
	});
</script >
</body >
</html >';
?>