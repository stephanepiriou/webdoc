<?php include("entete.php")?>
    <title>Créer un utilisateur</title>
    <script crossorigin="anonymous" type="text/javascript" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js" ></script>
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
            <form action="/users/create" id="form-create-user">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <label class="float-right">Email :</label>
                        </div>
                        <div class="col">
                            <input id="inputEmail" name="email" placeholder="Email adresse" required autofocus type="email" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="float-right">Nom d'utilisateur :</label>
                        </div>
                        <div class="col">
                            <input type="text" id="inputName" name="name" placeholder="Nom d\'utilisateur" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="float-right">Password :</label>
                        </div>
                        <div class="col">
                            <input type="password" id="inputPassword" name="password" placeholder="Password" />
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
                                <input type="button" value="Log in" id="button-submit" />
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
   <!-- <script crossorigin="anonymous" type="text/javascript" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js" ></script>-->
    <script type="text/javascript">

	    $('#inputName').jqxInput({width: 200, height: 30, theme: "energyblue"});

	    $('#inputEmail').jqxInput({width: 200, height: 30, theme: "energyblue"});

	    $('#inputPassword').jqxPasswordInput({width: 200, height: 30, theme: "energyblue"});

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
		    $("#formSignup").validate({
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
				    }/*,
                    password_confirmation: {
                		equalTo: "#inputPassword"
                    }*/
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