<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
</head>
<body>
    <h1>Sign up</h1>
    <?php if (!empty($user->errors)){
                $errors_message = '<p>Errors</p>
                        <ul>';
                foreach($user->errors as $error){
                    $errors_message .= '<li>';
                    $errors_message .= $error;
                    $errors_message .= '</i>';
                }
                $errors_message .= '</ul>';
                echo $errors_message;
            }
    ?>


    <form method="post" action="/signup/create" id="formSignup">
        <div>
            <label for="inputName">Name</label>
            <input type="text" id="inputName" name="name" placeholder="Name" autofocus  required />
        </div>
        <div>
            <label for="inputEmail">Email address</label>
            <input id="inputEmail" name="email" placeholder="Email adresse" required type="email" />
        </div>
        <div>
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" name="password" placeholder="Password" />
        </div>
        <!--
        <div>
            <label for="inputPasswordConfirmation">Email</label>
            <input type="password" id="inputPasswordConfirmation" name="password_confirmation" placeholder="Repeat password" />
        </div>
        -->
        <button type="submit">Signup</button>
    </form>
    <script crossorigin="anonymous" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js" ></script>
    <script src="/js/hideShowPassword.min.js"></script>
    <script>

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

        $('#inputPassword').hideShowPassword({
            show: false,
            innerToggle: 'focus'
        })
    </script>
</body>
</html>
