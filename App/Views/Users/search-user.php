<?php
/**
 * File of the search-user.php view
 * @package App\Views\Users
 */
/**
 * Dummy function
 * @return void
 */
function(){}
?>

<?php include("entete.php")?>
    <title>Chercher un utilisateur</title>
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
                        <h5 style="text-align: center">Chercher un utilisateur</h5>
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
            <form id="form-search-user" method="post" action="/users/list">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right"> Email de l&apos;utilisateur :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-user-email" name="inputEmail"/>
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
	    $("#input-user-email") . jqxInput({width: 250, height: 30, placeHolder: "Entrez l'email de l'utilisateur", theme: "energyblue"});

	    $("#button-search").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	    $("#button-search").on("click", function (event) {
		    $("#form-search-user").submit();
	    });
    </script>

<?php include("footer.php") ?>