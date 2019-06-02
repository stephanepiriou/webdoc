<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Items</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
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
    <h1>Items</h1>
    <p>Here is the index of Items</p>
</body>
</html>