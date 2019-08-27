<?php include("entete.php")?>
    <title>Document</title>
<?php include("header.php")?>
<?php include("menu.php")?>

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
                    <div class="col-6">
                        <form id="form-delete-document" action="/documents/delete" method="post">
                            <input type="hidden" name="individuid" value="<?php if(isset($individuid)){echo $individuid;}?>"/>
                            <input type="hidden" name="documentid" value="<?php if(isset($documentid)){echo $documentid;}?>"/>
                            <input type="button" id="button-submit" value="Effacer le document">
                        </form>
                    </div>
                    <div class="col-6">
                        <input type="button" id="button-print" value="Imprimer le document">
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

        $('#button-submit').jqxButton({width: "100%", height: "25", theme: "energyblue"});
        $('#button-submit').on('click', function(event){
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

        function ImagetoPrint(source)
        {
	        return "<html><head><scri"+"pt>function step1(){\n" +
		        "setTimeout('step2()', 10);}\n" +
		        "function step2(){window.print();window.close();}\n" +
		        "</scri" + "pt></head><body onload='step1()'>\n" +
		        "<img src='" + source + "' /></body></html>";
        }
    </script>

<?php include("footer.php") ?>