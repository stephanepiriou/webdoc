<?php include("entete.php")?>
    <title>Créer un individu</title>
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
                        <h5 style="text-align: center">Créer un individu</h5>
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
            <form id="form-create-individu" method="post" action="/individus/create">
                <div class="container">
                    <?php if (!empty($individu->errors)){
                        $errors_message = '<div class="alert alert-danger alert-dismissible fade show"><strong>Errors</strong>
                        <ul>';
                        foreach($individu->errors as $error){
                            $errors_message .= '<li>';
                            $errors_message .= $error;
                            $errors_message .= '</li>';
                        }
                        $errors_message .= '</ul></div>';
                        echo $errors_message;
                    }?>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Matricule :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-matricule" name="matricule" placeholder="Matricule"/>
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
                            <input id="input-surname" name="firstname" placeholder="Prénom"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Nom :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-name" name="lastname" placeholder="Nom"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Adresse :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-address" name="adress" placeholder="Adresse"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Ville :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-city" name="city" placeholder="Ville"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 float-right">
                            <label class="float-right">Code postal :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-postal-code" name="postalcode" placeholder="Code postal"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row" style="align-content: center">
                        <div class="col-4">

                        </div>
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                                <input type="button" value="Créer un individu" id="button-submit" />
                            </div>
                        </div>
                        <div class="col-4">

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

       <?php if(isset($jsonListTypesIndividu)){
           echo 'var typeIndividuSource ='.$jsonListTypesIndividu;
       }?>

	    $("#dropdown-type-individu").jqxDropDownList({source: typeIndividuSource, width: 198, height: 30, theme: "energyblue"});
	    $("#input-matricule").jqxInput({width: 200, height: 30, theme: "energyblue"});
	    $("#input-surname").jqxInput({width: 200, height: 30, theme: "energyblue"});
	    $("#input-name").jqxInput({width: 200, height: 30, theme: "energyblue"});
	    $("#input-address").jqxInput({width: 200, height: 30, theme: "energyblue"});
	    $("#input-city").jqxInput({width: 200, height: 30, theme: "energyblue"});
	    $("#input-postal-code").jqxInput({width: 200, height: 30, theme: "energyblue"});

	    $('#button-submit').jqxButton({ width: "150", height: "25", theme: "energyblue"});
	    $('#button-submit').click(function(){
		    $('#form-create-individu').submit();
	    });

       $.validator.addMethod('validAlpha',
	       function(value, element, param){
		       if(value !== ''){
			       if (value.match(/.*[A-Za-z]+.*/i) == null){
				       return false;
			       }
		       }
		       return true;
	       },
	       'Ne doit contenir que des lettres'
       );

       $.validator.addMethod('validAlphaNum',
	       function(value, element, param){
		       if(value !== ''){
			       if (value.match(/.*[A-Za-z0-1]+.*/i) == null){
				       return false;
			       }
		       }
		       return true;
	       },
	       'Ne doit contenir que des chiffres et des lettres'
       );

       $.validator.addMethod('validNum',
	       function(value, element, param){
		       if(value !== ''){
			       if (value.match(/.*[0-9]+.*/i) == null){
				       return false;
			       }
		       }
		       return true;
	       },
	       'Ne doit contenir que des chiffres'
       );

       $(document).ready(function(){
	       $("#form-create-type-individu").validate({
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