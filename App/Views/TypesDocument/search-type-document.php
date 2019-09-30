<?php
/**
 * File of the search-type-document.php view
 * @package App\Views\TypesDocument
 * @filesource
 */
namespace App\Views\TypesDocument;

/**
 * Dummy class
 */
class SearchTypeDocument{}
?>

<?php include("entete.php")?>
    <title>Chercher un type de document</title>
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
                        <h5 style="text-align: center">Chercher un type de document</h5>
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
           <form id="form-search-types-document" method="post" action="/types-document/list">
               <div class="container">
                   <div class="row">
                       <div class="col-6">
                           <label class="float-right"> Type de document :</label>
                       </div>
                       <div class="col-6">
                           <input id="input-type-document" name="inputTypeDocumentName"/>
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
	    $("#input-type-document") . jqxInput({width: 250, height: 30, placeHolder: "Entrez le nom du type de document", theme: "energyblue"});

	    $("#button-search").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	    $("#button-search").on("click", function (event) {
            $("#form-search-types-document").submit();
	    });
    </script>

<?php include("footer.php") ?>