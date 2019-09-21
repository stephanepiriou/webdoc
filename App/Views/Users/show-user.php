<?php include("entete.php")?>
    <title>Editer un utilisateur</title>
<?php include("header.php")?>
<?php include("menu.php")?>

<?php
    if (isset($user)){
        $id = $user->id;
        $email = $user->email;
        $name = $user->name;
        $errors = $user->errors;
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
                        <h5 style="text-align: center">Editer un utilisateur</h5>
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
            <form id="form-show-user" method="post">
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
                            <label class="float-right">Email :</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="input-email" name="email" value="<?php if(isset($email)){echo "$email";}else{echo "";}?>" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Nom :</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="input-name" name="name" value="<?php if(isset($name)){echo "$name";}else{echo "";}?>" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Password :</label>
                        </div>
                        <div class="col-6">
                            <input type="password" id="input-password" name="password" value="" required />
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
	    //////////////
	    // jqWidgets//
	    //////////////
	    $('#input-id').jqxInput({width: '100%', height: 30, disabled: true, theme: "energyblue"});

	    $('#input-name').jqxInput({width: '100%', height: 30, disabled: true, theme: "energyblue"});

	    $('#input-email').jqxInput({width: '100%', height: 30, disabled: true, theme: "energyblue"});

	    $('#input-password').jqxPasswordInput({width: '100%', height: 30, disabled: true, theme: "energyblue"});

	    $("#button-update-save").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	    $("#button-update-save").on("click", function (event) {
		    var value = $("#button-update-save").val();
		    if(value === "Mettre à jour"){
			    $("#button-update-save").jqxButton({value: "Sauver"});
			    $("#input-name").jqxInput({disabled: false});
			    $("#input-password").jqxInput({disabled: false})
		    }else if (value === "Sauver") {
			    //$("#button-update-save").jqxButton({value: "Mettre à jour"});
			    $("#input-id").jqxInput({disabled: false});
			    $("#form-show-user").attr("action", "/users/update");
			    $("#form-show-user").submit();
		    }
	    });

	    $("#button-delete").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	    $("#button-delete").on("click", function (event) {
		    $("#input-id").jqxInput({disabled: false});
		    $("#form-show-user").attr("action", "/users/delete");
		    $("#form-show-user").submit();
	    });

	    //
	    // Password validator function
	    //
	    $.validator.addMethod('validPassword',
		    function(value, element, param){
			    if(value !== ''){
				    if (value.match(/.*[a-z]+.*/i) == null){
					    return false;
				    }
				    if (value.match(/.*\d+.*/) == null){
					    return false;
				    }
			    }
			    return true;
		    },
		    'Must contain at least 1 letter and 1 number'
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
	    $(document).ready(function(){
		    $("#form-show-user").validate({
			    rules: {
				    name: {
				    	required: true,
					    minlength: 3,
                        validAlphaNum: true,
				    },
				    email: {
					    required: true,
					    email: true,
				    },
				    password: {
					    required: true,
					    minlength: 6,
					    validPassword: true
				    }
			    }
		    });
	    });
    </script>

<?php include("footer.php") ?>