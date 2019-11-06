<?php
/**
 * File of the create-individu-success.php view
 * @package App\Views\Individus
 * @filesource
 */

namespace App\Views\Backups;

/**
 * Dummy class
 */
class CreateIndividuSucces{}
?>

    <?php include("entete.php")?>
    <title>Gestion backup</title>
    <?php include("header.php")?>
    <?php
if(isset($_SESSION['current_user'])){$current_user=$_SESSION['current_user'];}else{$current_user='';}
if($current_user != '') {
    if ($current_user->hasRole('utilisateur')) {
        include("menu_utilisateur.php");
    } else if ($current_user->hasRole('encodeur')) {
        include("menu_encodeur.php");
    } else if ($current_user->hasRole('administrateur')) {
        include("menu_administrateur.php");
    }
} else {
    include("menu_anonyme.php");
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
                        <h5 style="text-align: center">Créer un backup des données.</h5>
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
            <div class="container">
                <?php if (isset($message)){
                    $info_message = '<div class="alert alert-info alert-dismissible fade show"><strong>Information</strong><br/>' . $message . '</div>';
                    echo $info_message;
                }?>
                <div class="row">
                    <div class="col">
                        &nbsp;
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div id="grid-list-backup"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        &nbsp;
                    </div>
                </div>
                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <div style="display: table; margin: auto">
                            <form id="form-create-backup">
                                <!--<form id="form-create-backup" action="/backups/create" method="post">-->
                                <input type="button" value="Faire un backup" id="button-create-backup" style="align-content: center" />
                            </form>
                        </div>
                        <!--<div style="display: table; margin: auto">
                            <form id="form-create-backup" action="/backups/restore" method="post">
                                <input type="button" value="Restaurer le backup " id="button-restore-backup" style="align-content: center" />
                            </form>
                        </div>-->
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div id="jqxLoader">
    </div>
    <div class="col-lg-12" id="footer">

    </div>
    <script type="text/javascript" src="/scripts/jquery.form.min.js"></script>
    <script type="text/javascript">

        $("#jqxLoader").jqxLoader({ width: 150, height: 150, theme: "energyblue", text: "Backup en cours...", textPosition: "top"});

        $("#button-create-backup").jqxButton({ width: "100%", height: "25", theme: "energyblue"});
        $("#button-create-backup").on('click', function (event) {
            //$("#form-create-backup").submit();
            $.ajax({
                url: "/backups/create-ajax",
                type: "GET",
                dataType: "json",
                async: true,
                beforeSend: function (){
                    $("#jqxLoader").jqxLoader('open');
                    $("#button-create-backup").jqxButton({disabled: true});
                },
                success: function (data, status, xhr) {
                    var newjsonbackuplist = data[0];
                    var message = data[1];
                    source.localdata = newjsonbackuplist;
                    $("#grid-list-backup").jqxGrid({source: source});

                    alert(message);
                },
                error: function (xhr, status) {
                    alert("Un problème a empêché la création d'un backup !");
                },
                complete: function (xhr, status) {
                    $("#jqxLoader").jqxLoader('close');
                    $("#button-create-backup").jqxButton({disabled: false});
                }
            });

        });

        <?php if(isset($jsonbackuplist)){
            echo 'var jsonbackuplist ='.$jsonbackuplist;
        }?>


        var source = {
            datatype: "json",
            datafields: [
                { name: 'id', type: 'string'},
                { name: 'filename', type: 'string' },
                { name: 'date', type: 'string'}
            ],
            localdata: jsonbackuplist
        };

        var dataAdapter = new $.jqx.dataAdapter(source, {
            downloadComplete: function (data, status, xhr) { },
            loadComplete: function (data) { },
            loadError: function (xhr, status, error) { }
        });

        $("#grid-list-backup").jqxGrid({
            width: '100%',
            source: dataAdapter,
            enablehover: true,
            autoheight: true,
            theme: 'energyblue',
            selectionmode: 'singlerow',
            columns: [
                { text: 'Id', datafield: 'id', width: '10%' },
                { text: 'File name', datafield: 'filename', width: '40%' },
                { text: 'Date', datafield: 'date', width: '50%' }
            ]
        });

//        $("#form-restore-backup").ajaxForm({url: '/backups/restore', type: 'post'})

        //$("#button-restore-backup").jqxButton({ width: "100%", height: "25", theme: "energyblue", disabled: true});
        //$("#button-restore-backup").on('click', function (event) {
        //    $("#form-restore-backup").submit();
        //});
/*
        $('#form-restore-backup').on('submit', function(e) {
            e.preventDefault(); // prevent native submit
            $('#form-restore-backup').ajaxSubmit({
                target: '#myResultsDiv'
            })
        });
*/

    </script>

    <?php include("footer.php") ?>