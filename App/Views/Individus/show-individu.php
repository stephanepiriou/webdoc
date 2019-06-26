<?php include("entete.php")?>
    <title>Editer un individu</title>
<?php include("header.php")?>
<?php include("menu.php")?>
<?php
if (isset($individu)){
    $id = $individu->id;
    $matricule = $individu->matricule;
    $firstname = $individu->firstname;
    $lastname = $individu->lastname;
    $adress = $individu->adress;
    $city = $individu->city;
    $postalcode = $individu->postalcode;
    $errors = $individu->errors;
}
?>

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
                        <h5 style="text-align: center">Editer un individu</h5>
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
            <!--MAIN PANEL -->
            <form id="form-show-individu" method="post">
                <div class="container">
                    <?php if (!empty($errors)){
                        $errors_message = '<div class="alert alert-danger alert-dismissible fade show"><strong>Errors</strong>
                            <ul>';
                        foreach($errors as $error){
                            $errors_message .= '<li>';
                            $errors_message .= $error;
                            $errors_message .= '</li>';
                        }
                        $errors_message .= '</ul></div>';
                        echo $errors_message;
                    }?>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Id :</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="input-id" name="id" value="<?php if(isset($id)){echo "$id";}else{echo "";}?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Matricule :</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="input-matricule" name="matricule" value="<?php if(isset($matricule)){echo "$matricule";}else{echo "";}?>" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Type d&apos;individu :</label>
                        </div>
                        <div class="col-6">
                            <div id="dropdown-type-individu" name="typeindividu">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Prénom :</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="input-firstname" name="firstname" value="<?php if(isset($firstname)){echo "$firstname";}else{echo "";}?>" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Nom :</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="input-lastname" name="lastname" value="<?php if(isset($lastname)){echo "$lastname";}else{echo "";}?>" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Adresse :</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="input-adress" name="adress" value="<?php if(isset($adress)){echo "$adress";}else{echo "";}?>" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Ville :</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="input-city" name="city" value="<?php if(isset($city)){echo "$city";}else{echo "";}?>" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Code Postal :</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="input-postal-code" name="postalcode" value="<?php if(isset($postalcode)){echo "$postalcode";}else{echo "";}?>" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row" style = "align-content: center" >
                        <div class="col-6" style="display: table; margin: auto">
                            <div style="display: table; margin: auto">
                                <input type="button" value="Mettre à jour" id="button-update-save" style="align-content: center" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="display: table; margin: auto">
                                <input type="button" value="Effacer" id="button-delete" style="align-content: center" />
                            </div>
                        </div>
                    </div >
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-12" id="footer">

    </div>
    <script type="text/javascript">

        <?php if(isset($jsonListTypesIndividu)){
            echo 'var typeIndividuSource ='.$jsonListTypesIndividu;
        }?>

	    $("#dropdown-type-individu").jqxDropDownList({source: typeIndividuSource, disabled: true, width: 198, height: 30, theme: "energyblue"});
        $("#dropdown-type-individu").jqxDropDownList('selectItem', "<?php if(isset($chosenTypeIndividu)){echo $chosenTypeIndividu;}?>" );
        $('#input-id').jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});
	    $('#input-matricule').jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});
	    $('#input-firstname').jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});
	    $('#input-lastname').jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});
	    $('#input-adress').jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});
	    $('#input-city').jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});
	    $('#input-postal-code').jqxInput({width: 200, height: 30, disabled: true, theme: "energyblue"});

	    $("#button-update-save").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	    $("#button-update-save").on("click", function (event) {
		    var value = $("#button-update-save").val();
		    if(value === "Mettre à jour"){
			    $("#button-update-save").jqxButton({value: "Sauver"});
			    $("#input-matricule").jqxInput({disabled: false});
			    $("#input-firstname").jqxInput({disabled: false});
			    $("#input-lastname").jqxInput({disabled: false});
			    $("#input-adress").jqxInput({disabled: false});
			    $("#input-city").jqxInput({disabled: false});
			    $("#input-postal-code").jqxInput({disabled: false});
			    $("#dropdown-type-individu").jqxDropDownList({disabled: false});
		    }else if (value === "Sauver") {
			    //$("#button-update-save").jqxButton({value: "Mettre à jour"});
			    $("#input-id").jqxInput({disabled: false});
			    $("#form-show-individu").attr("action", "/individus/update");
			    $("#form-show-individu").submit();
		    }
	    });

	    $("#button-delete").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	    $("#button-delete").on("click", function (event) {
		    $("#input-id").jqxInput({disabled: false});
		    $("#form-show-individu").attr("action", "/individus/delete");
		    $("#form-show-individu").submit();
	    });
    </script>

<?php include("footer.php") ?>