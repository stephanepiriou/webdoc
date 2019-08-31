<?php include("entete.php")?>
    <title>Nouveau document</title>
<?php include("header.php")?>
<?php include("menu.php")?>
<?php if(isset($upload)){
    $errors = $upload->errors;
}?>

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
                        <h5 style="text-align: center">Nouveau document</h5>
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
            <form id="form-upload-document" method="post" action="/documents/upload" enctype="multipart/form-data">
                <input type="hidden" id="individu-id" name="individuid" value="<?php if(isset($individuid)){echo $individuid;}else{echo "";}?>">
                <div class="container">
                    <!--Error messages-->
                    <?php if (isset($errors)){
                        $errors_message = '<div class="alert alert-danger alert-dismissible fade show"><strong>Errors</strong>
                            <ul>';
                        foreach($errors as $error){
                            $errors_message .= '<li>';
                            $errors_message .= $error;
                            $errors_message .= '</li>';
                        }
                        $errors_message .= '</ul></div>';
                        echo $errors_message;
                    }?>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Nom de l&apos;individu :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-individu-lastname" name="individulastname" type="text" value="<?php if(isset($individulastname)){echo $individulastname;}else{echo "";}?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Prenom de l&apos;individu :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-individu-firstname" name="individufirstname" type="text" value="<?php if(isset($individufirstname)){echo $individufirstname;}else{echo "";}?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Nom du document :</label>
                        </div>
                        <div class="col-6">
                            <input id="input-document-name" name="inputdocumentname" type="text"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="float-right">Type de document :</label>
                        </div>
                        <div class="col-6">
                            <div id="dropdown-type-document" name="typedocument">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">

                            <label class="float-right">Fichier :</label>
                        </div>
                        <div class="col-6">
                            <input type="file" name="fileToUpload" id="file-to-upload">
                            <!--<div id="fileUpload"></div>-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row" style = "align-content: center">
                        <div class="col-12">
                            <div>
                                <input type="button" value="Upload un document" id="button-submit" />
                            </div>
                        </div>
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

	    //////////////
	    // jqWidgets//
	    //////////////
        <?php if(isset($jsonListTypesDocument)){
            echo 'var typeDocumentSource ='.$jsonListTypesDocument.';';
        }?>

        $('#input-individu-firstname').jqxInput({width:'100%', height:30, disabled:true, theme:'energyblue'});

        $('#input-individu-lastname').jqxInput({width:'100%', height:30, disabled:true, theme:'energyblue'});

        $('#input-document-name').jqxInput({width:'100%', height:30, disabled:true, theme:'energyblue'})

        $("#dropdown-type-document").jqxDropDownList({source: typeDocumentSource, width: '100%', height: 30, theme: "energyblue"});
        $("#dropdown-type-document").jqxDropDownList('selectIndex', 0 );
        var selectedDocumentType = $('#dropdown-type-document').jqxDropDownList('getSelectedItem').label;
        var documentName = selectedDocumentType + ' de ' + $('#input-individu-firstname').val() + ' ' + $('#input-individu-lastname').val();
        $('#input-document-name').val(documentName);

        $("#dropdown-type-document").on('change', function (event) {
           var selectedDocumentType = $('#dropdown-type-document').jqxDropDownList('getSelectedItem').label;
           var documentName = selectedDocumentType + ' de ' + $('#input-individu-firstname').val() + ' ' + $('#input-individu-lastname').val();
           $('#input-document-name').val(documentName);
        });

        $('#file-to-upload').jqxButton({width:'100%', height:30, theme:'energyblue'});

        $('#button-submit').jqxButton({width: "100%", height: "25", theme: "energyblue"});
        $('#button-submit').click(function(){
        	$("#input-individu-lastname").jqxInput({disabled:false});
        	$("#input-individu-firstname").jqxInput({disabled:false});
	        $('#form-upload-document').submit();
        });

    </script>

<?php include("footer.php") ?>