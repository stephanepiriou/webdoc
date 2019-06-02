<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>

    <!-- Get persitent field from submit action -->
    <?php isset($email) ? $email = $email : $email = "";?>
    <?php isset($remember) ? $checked = "checked=\"checked\"" : $checked = "";?>

    <!--Flash message section-->
    <!-- Note : has to be included once in base template for project ECI -->
    <?php use App\Flash; ?>
    <?php $messages = Flash::getMessage()?>
    <?php if (isset($messages)):?>
        <?php foreach( $messages as $message): ?>
            <div class="alert alert-<?= $message['type'] ?>">
                <?= $message['body'] ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <h1>Log in</h1>
    <form action="/login/create" method="post">
        <div>
            <label for="inputEmail">Email address</label>
            <input id="inputEmail" name="email" placeholder="Email adresse" required type="email" value="<?=$email?>"/>
        </div>
        <div>
            <label for="inputPassword">Password</label>
            <input type="password" id="inputPassword" name="password" placeholder="Password" />
        </div>
        <div>
            <label>
                <input type="checkbox" name="remember_me" <?=$checked?>/> Remember me
            </label>
        </div>
        <button type="submit">Log in</button>
    </form>
</body>
</html>