<?php
use \App\Auth;
use \App\Flash;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>

    <!--Flash message section-->
    <!-- Note : has to be included once in base template for project ECI -->
    <?php $messages = Flash::getMessage()?>
    <?php if (isset($messages)):?>
        <?php foreach( $messages as $message): ?>
            <div class="alert alert-<?= $message['type'] ?>">
                <?= $message['body'] ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <h1>Welcome</h1>

    <!--Authenticated message section-->
    <?php if(Auth::getUser()): ?>
        Hello <?=$user->name?><br/>
        <a href="/logout">Log out</a>.
    <?php else: ?>
        <a href="/signup/new">Sign up</a> or <a href="/login">Log In</a>
    <?php endif; ?>
    <!--
    <p>Hello <?php echo htmlspecialchars($name); ?>!</p>

    <ul>
        <?php foreach ($colours as $colour): ?>
            <li><?php echo htmlspecialchars($colour); ?></li>
        <?php endforeach; ?>
    </ul>
    -->
</body>
</html>
