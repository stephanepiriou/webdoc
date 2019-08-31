<?php include("entete.php")?>
    <title>Chercher un individu</title>
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
                        <h5 style="text-align: center">Chercher un individu</h5>
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
        <div id = "main-panel"  class="offset-lg-3 col-lg-6">
            <form method="post" id="form-search-individu" action="/individus/list">
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                            <div style="display: table; margin: auto">
                                <label class="float-right">Chercher par </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div >
                                <div id="dropdown-search-type" name="dropdownSearchType"> </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <div style="display: table; margin: auto">
                                <b>:</b>
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="display: table; margin: auto">
                                <input id="input-search-term" name="inputSearchTerm"/>
                            </div>
                        </div>
                    </div >

                    <div class="row">
                        <div class="col">&nbsp;
                            <div id="datatable-individu">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="align-content: center">
                        <div class="col">&nbsp;&nbsp;</div>
                    </div>
                    <div class="row">
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
                    <div class="row">
                        <div class="col">&nbsp;&nbsp;</div>
                    </div>
                </div >
            </form>
        </div >
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
	    var typeRechercheSource = [
		    "matricule",
		    "nom"
	    ]
	    $("#dropdown-search-type").jqxDropDownList({source: typeRechercheSource, width: "100%", height: 30, disabled: false,theme: "energyblue"});
        $("#dropdown-search-type").jqxDropDownList('selectIndex', 0 );

	    $("#input-search-term").jqxInput({width: "100%", height: 30, placeHolder: "nom/matricule", theme: "energyblue"});

	    $("#button-search").jqxButton({ width: "150", height: "25", theme: "energyblue"});
	    $("#button-search").on("click", function (event) {
		    $("#form-search-individu").submit();
	    });
    </script>

<?php include("footer.php") ?>