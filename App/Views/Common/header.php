<!-- Header of the page -->
<?php header('Content-type: text/html; charset=utf-8'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="/styles/bootstrap.css" >
<link rel="stylesheet" href="/styles/jqx.base.css">
<link rel="stylesheet" href="/styles/jqx.energyblue.css">
<link rel="stylesheet" href="/styles/custom.css">
<script type="text/javascript" src="/scripts/bootstrap.min.js"></script>
<script type="text/javascript" src="/scripts/jquery.js"></script>
<script type="text/javascript" src="/scripts/jquery.validate.min.js"></script>
<script type="text/javascript" src="/scripts/jqx-all.js"></script>
<script type="text/javascript" src="/scripts/menu.js"></script>
</head>
<body>
<!--Flash message section for login, signin and logout method-->
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
<div id="wrap">
    <div id="pageheader">
        <h1>webdoc</h1>
    </div>