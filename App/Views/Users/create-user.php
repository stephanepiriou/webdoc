<?php include("entete.php")?>
    <title>Créer un utilisateur</title>
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
                        <h5 style="text-align: center">Créer un utilisateur</h5>
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
            <form method="post" action="/users/create" id="form-create-user">
                <div class="container">
                    <?php if (!empty($user->errors)){
                        $errors_message = '<div class="alert alert-danger alert-dismissible fade show"><strong>Errors</strong>
                        <ul>';
                        foreach($user->errors as $error){
                            $errors_message .= '<li>';
                            $errors_message .= $error;
                            $errors_message .= '</li>';
                        }
                        $errors_message .= '</ul></div>';
                        echo $errors_message;
                    }?>
                    <div class="row">
                        <div class="col">
                            <label class="float-right">Email :</label>
                        </div>
                        <div class="col">
                            <input id="input-email" name="email" placeholder="Email adresse" required autofocus type="email" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="float-right">Nom d'utilisateur :</label>
                        </div>
                        <div class="col">
                            <input type="text" id="input-name" name="name" placeholder="Nom d&apos;utilisateur" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="float-right">Password :</label>
                        </div>
                        <div class="col">
                            <input type="password" id="input-password" name="password" placeholder="Password" />
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
                                <input type="button" value="Créer utilisateur" id="button-submit" />
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

	    $('#input-name').jqxInput({width: 200, height: 30, theme: "energyblue"});

	    $('#input-email').jqxInput({width: 200, height: 30, theme: "energyblue"});

	    $('#input-password').jqxPasswordInput({width: 200, height: 30, theme: "energyblue"});

	    $('#button-submit').jqxButton({ width: "150", height: "25", theme: "energyblue"});
	    $('#button-submit').click(function(){
		    $('#form-create-user').submit();
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
	    $(document).ready(function(){
		    $("#form-create-user").validate({
			    rules: {
				    name: 'required',
				    email: {
					    required: true,
					    email: true,
					    remote: "/account/validate-email"
				    },
				    password: {
					    required: true,
					    minlength: 6,
					    validPassword: true
				    }
			    },
			    messages: {
				    email: {
					    remote: "email already taken"
				    }
			    }
		    });
	    });

    </script>

<?php include("footer.php") ?>