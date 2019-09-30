<?php
/**
 * File of the show-individu.php view
 * @package App\Views\Individus
 * @filesource
 */
namespace App\Views\Individus;

/**
 * Dummy class
 */
class ShowIndividu{}
?>

<?php include("entete.php")?>
    <title>Editer un individu</title>
<?php include("header.php")?>
<?php include("menu.php")?>
<?php if (isset($individu)){
    $id = $individu->id;
    $matricule = $individu->matricule;
    $firstname = $individu->firstname;
    $lastname = $individu->lastname;
    $adress = $individu->adress;
    $city = $individu->city;
    $postalcode = $individu->postalcode;
    $errors = $individu->errors;
    $typeindividuid = $individu->typeindividuid;
};?>

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
                           <input type="hidden" id="input-type-individu-id" name="typeindividuid" value="<?php if(isset($typeindividuid)){echo "$typeindividuid";}else{echo "";}?>">
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
                        <div class="col-6">
                            <div>
                                <input type="button" value="Mettre à jour" id="button-update-save" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div >
                                <input type="button" value="Effacer" id="button-delete" />
                            </div>
                        </div>
                    </div >
                    <div class="row">
                        <div class="col">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col"><h6 style="text-align: center;">Documents</h6></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div id="grid-documents"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">&nbsp;</div>
                    </div>
                    <div class="row" style = "align-content: center" >
                        <?php
                        if(isset($typedocumentexist)){
                            if(!$typedocumentexist){
                                echo "<div class=\"alert alert-warning alert-dismissible fade show\"> 
                                          Il n'existe pas de type de document dans la base de données. Veuillez d'abord créer un type de document.
                                      </div>";
                            }
                        }
                        ?>
                        <div class="col">
                            <div>
                                <input type="button" value="Ajouter Document" id="button-ajouter-document" />
                            </div>
                        </div>
                    </div >
                </div>
            </form>
            <form id="form-show-document" method="post" action="/documents/show">
                <input id='individu-id' name='individuid' type='hidden' value="<?php if(isset($id)){echo "$id";}else{echo "";}?>">
                <input id='input-document-id' name='documentid' type='hidden'>
                <!--<input id='user-id' name='userid' type='hidden' value="<?php //if(isset($id)){echo "$id";}else{echo "";}?>">-->
            </form>
            <form id="form-new-document" method="post" action="/documents/new">
                <input id='individu-id' name='individuid' type='hidden' value="<?php if(isset($id)){echo "$id";}else{echo "";}?>">
                <input id="individu-matricule" name="individumatricule" type="hidden" value="<?php if(isset($matricule)){echo "$matricule";}else{echo "";}?>">
                <input id='individu-first-name' name='individufirstname' type="hidden" value="<?php if(isset($firstname)){echo "$firstname";}else{ "";}?>">
                <input id='individu-last-name' name='individulastname' type="hidden" value="<?php if(isset($lastname)){echo "$lastname";}else{ "";}?>">

            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-12" id="footer">

    </div>
    <script type="text/javascript">

	    //////////////
	    // jqWidgets//
	    //////////////
        <?php if (isset($jsonListDocument)) {
                echo 'var documentsDataSource =' . $jsonListDocument.';';
            };?>


        <?php if(isset($jsonListTypesIndividu)){
                echo 'var typeIndividuDataSource ='.$jsonListTypesIndividu .';';
            };?>

	    $("#dropdown-type-individu").jqxDropDownList({source: typeIndividuDataSource, disabled: true, width: 198, height: 30, theme: "energyblue"});
        $("#dropdown-type-individu").jqxDropDownList('selectItem', "<?php if(isset($chosenTypeIndividu)){echo $chosenTypeIndividu;}?>" );
        $('#input-id').jqxInput({width: '100%', height: 30, disabled: true, theme: "energyblue"});
	    $('#input-matricule').jqxInput({width: '100%', height: 30, disabled: true, theme: "energyblue"});
	    $('#input-firstname').jqxInput({width: '100%', height: 30, disabled: true, theme: "energyblue"});
	    $('#input-lastname').jqxInput({width: '100%', height: 30, disabled: true, theme: "energyblue"});
	    $('#input-adress').jqxInput({width: '100%', height: 30, disabled: true, theme: "energyblue"});
	    $('#input-city').jqxInput({width: '100%', height: 30, disabled: true, theme: "energyblue"});
	    $('#input-postal-code').jqxInput({width: '100%', height: 30, disabled: true, theme: "energyblue"});

	    $("#button-update-save").jqxButton({ width: "100%", height: "25", theme: "energyblue"});
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

	    $("#button-delete").jqxButton({ width: "100%", height: "25", theme: "energyblue"});
	    $("#button-delete").on("click", function (event) {
		    $("#input-id").jqxInput({disabled: false});
		    $("#form-show-individu").attr("action", "/individus/delete");
		    $("#form-show-individu").submit();
	    });

        // prepare the data
        var source = {
	        datatype: "json",
	        datafields: [
		        { name: 'document_id', type: 'string'},
		        { name: 'document_name', type: 'string'},
		        { name: 'type_document_name', type: 'string'}
	        ],
	        localdata: documentsDataSource
        };

        var dataAdapter = new $.jqx.dataAdapter(source);

        $("#grid-documents").jqxGrid({
	        width: '100%',
	        source: dataAdapter,
	        autoheight: true,
	        enablehover: true,
	        theme: 'energyblue',
	        selectionmode: 'singlerow',
	        columns: [
		        { text: 'Id', datafield: 'document_id', width: '10%' },
		        { text: 'Nom document', datafield: 'document_name', width: '50%' },
		        { text: 'Type de document', datafield: 'type_document_name', width: '40%' },
	        ]
        });

        $("#grid-documents").on('rowselect', function (event) {
	        $('#input-document-id').val(event.args.row.document_id);
	        $('#form-show-document').submit();
        });

        $("#button-ajouter-document").jqxButton({ width: "100%", height: "25", theme: "energyblue", disabled: <?php if(isset($typedocumentexist)){echo $typedocumentexist ? "false" : "true" ;}?>});
        $("#button-ajouter-document").on("click", function (event) {
	        $('#form-new-document').submit();
        });

        //////////////////////////
        //Jquery field validator//
        //////////////////////////
	    $.validator.addMethod('validAlpha',
		    function(value, element, param){
			    if(value !== ''){
				    if (value.match(/^[A-Za-zéèëêïîôöûüäâ\- ]*$/) == null){
					    return false;
				    }
			    }
			    return true;
		    },
		    'Ne doit contenir que des lettres, des tirets et des espaces !'
	    );

	    $.validator.addMethod('validAlphaNum',
		    function(value, element, param){
			    if(value !== ''){
				    if (value.match(/^[0-9A-Za-zéèëêïîôöûüäâ\- ]*$/) == null){
					    return false;
				    }
			    }
			    return true;
		    },
		    'Ne doit contenir que des chiffres et des lettres (A-Z & a-z) des tirets et des espaces!'
	    );

	    $.validator.addMethod('validNum',
		    function(value, element, param){
			    if(value !== ''){
				    if (value.match(/^[0-9]*$/) == null){
					    return false;
				    }
			    }
			    return true;
		    },
		    'Ne doit contenir que des chiffres !'
	    );

        $(document).ready(function(){
	        $("#form-show-individu").validate({
		        rules: {
			        matricule: {
				        required: true,
				        minlength: 3,
				        validAlphaNum: true
			        },
			        firstname: {
				        required: true,
				        minlength: 2,
				        validAlpha: true
			        },
			        lastname: {
				        required: true,
				        minlength: 2,
				        validAlpha: true
			        },
			        adress: {
				        required: true,
				        minlength: 7,
				        validAlphaNum: true
			        },
			        city: {
				        required: true,
				        minlength: 2,
				        validAlpha: true
			        },
			        postalcode: {
				        required: true,
				        minlength: 4,
				        maxlength: 4,
				        validNum: true
			        }
		        }
	        });
        });
    </script>

<?php include("footer.php") ?>