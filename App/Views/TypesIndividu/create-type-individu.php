<?php include("entete.php")?>
    <title>Créer un Type d&apos;individu</title>
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
                        <h5 style="text-align: center">Créer un type d&apos;individu</h5>
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
            <form id="form-create-type-individu" method="post" action="/types-individu/create">
                <div class="container">
                    <?php if (!empty($typeIndividu->errors)){
                        $errors_message = '<div class="alert alert-danger alert-dismissible fade show"><strong>Errors</strong>
                        <ul>';
                        foreach($typeIndividu->errors as $error){
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
                            <input type="text" id="inputName" name="name" placeholder="Nom de type d&apos;individu" required />
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
                                <input type="button" value="Créer type d&apos;individu" id="button-submit" />
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

	    $('#inputName').jqxInput({width: 200, height: 30, theme: "energyblue"});

	    $('#button-submit').jqxButton({ width: "150", height: "25", theme: "energyblue"});
	    $('#button-submit').click(function(){
		    $('#form-create-type-individu').submit();
	    });

	    //
	    // Document type name validator function
	    //
	    $.validator.addMethod('validAlphaNum',
		    function(value, element, param){
			    if(value !== ''){
				    if (value.match(/.*[a-zA-Z0-9]+.*/i) == null){
					    return false;
				    }
			    }
			    return true;
		    },
		    'Ne doit contenir que des chiffres et des lettres'
	    );

	    $(document).ready(function(){
		    $("#form-create-type-individu").validate({
			    rules: {
				    name: {
				    	required: true,
                        minlength: 3,
					    validAlphaNum: true
				    }
			    }
		    });
	    });
    </script>

<?php include("footer.php") ?>