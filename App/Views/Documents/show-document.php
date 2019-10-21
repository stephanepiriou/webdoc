<?php
/**
 * File of the show-document.php view
 * @package App\Views\Documents
 * @filesource
 */

namespace App\Views\Documents;

/**
 * Dummy class
 */
Class ShowDocument{}
?>

<?php include("entete.php")?>
    <title>Document</title>
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

    <input type="hidden" name="userid" id="user-id" value="<?php if (isset($userid)){echo $userid;}else{echo "";}?>">
    <input type="hidden" name="documentid" id="document-id" value="<?php if (isset($documentid)){echo $documentid;}else{echo "";}?>">
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
                        <h5 style="text-align: center"><?php if(isset($documentname)){echo $documentname;}?></h5>
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
                <div class="row">
                    <div class="col">

                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <img class="img-fluid" src="<?php if(isset($filepath)){echo $filepath;}?>" alt="Le document ne peut pas être affiché !">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        &nbsp;
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <form id="form-delete-document" action="/documents/delete" method="post">
                            <input type="hidden" name="individuid" value="<?php if(isset($individuid)){echo $individuid;}?>"/>
                            <input type="hidden" name="documentid" value="<?php if(isset($documentid)){echo $documentid;}?>"/>
                            <input type="button" id="button-delete-submit" value="Effacer">
                        </form>
                    </div>
                    <div class="col-4">
                        <input type="button" id="button-print" value="Imprimer">
                    </div>
                    <div class="col-4">
                        <form method="post" action="/documents/download" id="form-download-document">
                            <input type="hidden" name="documentid" id="document-id" value="<?php if (isset($documentid)){echo $documentid;}else{echo "";}?>">
                            <input type="button" id="button-download-submit" value="Télécharger">
                        </form>
                    </div>
                </div>
            </div>
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
        $('#button-delete-submit').jqxButton({width: "100%", height: "25", disabled: <?php if($current_user->hasPermission('modification')){echo "false";}else{echo "true";} ?>, theme: "energyblue"});
        $('#button-delete-submit').on('click', function(event){
        	$("#form-delete-document").submit();
        })

        $('#button-print').jqxButton({width: "100%", height: "25", theme: "energyblue"});
        $('#button-print').on('click', function(event){
	        var Pagelink = "about:blank";
	        var pwa = window.open(Pagelink, "_new");
	        pwa.document.open();
	        pwa.document.write(ImagetoPrint("<?php if(isset($serverfilepath)){echo $serverfilepath;}?>"));
	        pwa.document.close();
        })

        //function to show the print interface of the browser in a new windows
        function ImagetoPrint(source)
        {
	        return "<html><head><scri"+"pt>function step1(){\n" +
		        "setTimeout('step2()', 10);}\n" +
		        "function step2(){window.print();window.close();}\n" +
		        "</scri" + "pt></head><body onload='step1()'>\n" +
		        "<img src='" + source + "' /></body></html>";
        }

        $('#button-download-submit').jqxButton({width: "100%", height: "25", theme: "energyblue"});
        $('#button-download-submit').on('click', function(event){
            $('#form-download-document').submit();
        })
    </script>

<?php include("footer.php") ?>