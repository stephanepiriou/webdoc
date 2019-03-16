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
            <div id="page-title" class="offset-lg-3 col-lg-6">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h5 style="text-align: center">Créer un type de document</h5>
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
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Dénomination :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-denomination" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="row">&nbsp;</div>
                    </div>
                    <div class="row" style="align-content: center">
                        <div class="col-4">
                        </div>
                        <div class="col-4">
                            <div style="display: block; margin: auto">
                                <input type="button" value="Sauver" id=\'button-save\' style="align-content: center" />
                            </div>
                        </div>
                        <div class="col-4">
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
	$("#input-denomination").jqxInput({width: 250, height: 30, placeHolder: "Entrez le nom du type de document", theme: "energyblue"});

	$("#button-save").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	$("#button-save").on("click", function (event) {
		var denomination = $("#input-denomination").val();
	});
</script>
</body>
</html>';
?>