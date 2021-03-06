<?php
/**
 * File of the search-type-individu.php view
 * @package App\Views\TypesIndividu
 * @filesource
 */
namespace App\Views\TypesIndividu;

/**
 * Dummy class
 */
class SearchTypeIndividu{}
?>

<?php include("entete.php")?>
    <title>Chercher un type d&apos;individu</title>
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
                        <h5 style="text-align: center">Chercher un type d&apos;individu</h5>
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
            <form id="form-search-types-individu" method="post" action="/types-individu/list">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right"> Type d&apos;individu :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-type-individu" name="inputTypeIndividuName"/>
                        </div>
                    </div>
                    <div class="row" style="align-content: center">
                        <div class="col">&nbsp;<div id="grid-types-document"></div></div>
                    </div>
                    <div class="row" style = "align-content: center">
                        <div class="col-4">
                        </div>
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                                <input type="button" value="Chercher" id="button-search" style="align-content: center" />
                            </div>
                        </div>
                        <div class="col-4">
                        </div>
                    </div >
                </div >
            </form>
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
	    $("#input-type-individu").jqxInput({width: '100%', height: 30, placeHolder: "Entrez le nom du type d'individu", theme: "energyblue"});

	    $("#button-search").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	    $("#button-search").on("click", function (event) {
		    $("#form-search-types-individu").submit();
	    });
    </script>

<?php include("footer.php") ?>