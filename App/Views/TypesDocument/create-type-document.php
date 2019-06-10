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
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Nom :</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="inputName" name="name" placeholder="Nom de type de document" required />
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

	    $('#inputName').jqxInput({width: 200, height: 30, theme: "energyblue"});

	    $('#button-submit').jqxButton({ width: "150", height: "25", theme: "energyblue"});
	    $('#button-submit').click(function(){
		    $('#form-create-type-document').submit();
	    });

	    //
	    // Document type name validator function
	    //
	    $.validator.addMethod('validTypeDocumentName',
		    function(value, element, param){
			    if(value !== ''){
				    if (value.match(/.*[a-z]+.*/i) == null){
					    return false;
				    }
			    }
			    return true;
		    },
		    'Must contain at least 1 letter'
	    );

	    $(document).ready(function(){
		    $("#form-create-type-document").validate({
			    rules: {
				    name: {
					    required: true,
					    minlength: 5,
					    validTypeDocumentName: true
				    }
			    }
		    });
	    });
    </script>

<?php include("footer.php") ?>