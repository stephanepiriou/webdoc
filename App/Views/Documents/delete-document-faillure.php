<?php include("entete.php")?>
    <title>Effacer le document</title>
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
                        <h5 style="text-align: center">Effacer le document</h5>
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
            <div class="alert alert-danger alert-dismissible fade show">
                Le document n&apos;a pu être effacé ! Désolé !<br/>
            </div>
            <form id="form-return-to-individu-view" method="post" action="/individus/show">
                <input type="hidden" name="individuid" value="<?php if (isset($individuid)){echo $individuid;} ?>" />
                <div class="container">
                    <div class="row">
                        <input type="button" id="button-submit" value="Retourner à la fiche Individu">
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-12" id="footer">

    </div>
    <script type="text/javascript">
	    $('#button-submit').jqxButton({width: "100%", height: "25", theme: "energyblue"});
	    $('#button-submit').click(function(){
		    $('#form-return-to-individu-view').submit();
	    });
    </script>

<?php include("footer.php") ?>