<?php
/**
 * File of the create-type-document.php view
 * @package App\Views\TypesDocument
 * @filesource
 */
namespace App\Views\TypesDocument;

/**
 * Dummy class
 */
class CreateTypeDocument{}
?>

<?php include("entete.php")?>
    <title>Créer un type de document</title>
<?php include("header.php")?>
<?php include("menu.php")?>

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
            <!--MAIN PANEL -->
            <form id="form-create-type-document" method="post" action="/types-document/create">
                <div class="container">
                    <?php if (!empty($typeDocument->errors)){
                        $errors_message = '<div class="alert alert-danger alert-dismissible fade show"><strong>Errors</strong>
                        <ul>';
                        foreach($typeDocument->errors as $error){
                            $errors_message .= '<li>';
                            $errors_message .= $error;
                            $errors_message .= '</li>';
                        }
                        $errors_message .= '</ul></div>';
                        echo $errors_message;
                    }?>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Nom :</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="input-name" name="name" placeholder="Nom de type de document" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row" style="align-content: center">
                        <div class="col">
                            <div style="display: table; margin: auto">
                                <input type="button" value="Créer type de document" id="button-submit" />
                            </div>
                        </div>
                    </div>
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
	    //////////////
	    // jqWidgets//
	    //////////////
	    $('#input-name').jqxInput({width: '100%', height: 30, theme: "energyblue"});

	    $('#button-submit').jqxButton({ width: '100%', height: "25", theme: "energyblue"});
	    $('#button-submit').click(function(){
		    $('#form-create-type-document').submit();
	    });

	    //
	    // Document type name validator function
	    //
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

	    $(document).ready(function(){
		    $("#form-create-type-document").validate({
			    rules: {
				    name: {
					    required: true,
					    minlength: 5,
					    validAlphaNum: true,
                        remote: '/types-document/validate-name'
				    }
			    },
                messages: {
			        name:{
			            remote: 'Nom déjà prit!'
                    }
                }
		    });
	    });
    </script>

<?php include("footer.php") ?>