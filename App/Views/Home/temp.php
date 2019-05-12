<?php $title = "Titre Page" ?>

<?php $titlepage = 'Title Page 2'; ?>

<?php $mainpanel = '<button id="thebutton">Click</button>' ?>

<?php $bottomscript = '$("#thebutton").click(function(){alert("coucou");});' ?>

<?php require(dirname(__DIR__).'/template.php'); ?>