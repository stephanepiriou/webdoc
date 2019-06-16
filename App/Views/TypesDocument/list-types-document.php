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
            <div class="container">
                <div class="row" style="align-content: center">
                    <div id="grid"></div>
                </div>
            </div >
            <form id="form-show-types-document" method="post" action="/types-document/show">
                <input id='input-types-document' name='typesDocumentName' type='hidden'>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-12" id="footer">

    </div>
    <script type="text/javascript">

        //var data = [{"id": "1", "name": "carte d'identite"}, {"id": "2", "name": "diplome"}, {"id": "3", "name": "certificat medicale"}]

        <?php if(isset($typesDocumentAsJson)){
            echo 'var data ='.$typesDocumentAsJson;
        }?>

	    // prepare the data
	    var source = {
			    datatype: "json",
			    datafields: [
				    { name: 'id', type: 'string'},
				    { name: 'name', type: 'string'}
			    ],
			    localdata: data
        };

	    var dataAdapter = new $.jqx.dataAdapter(source);

	    $("#grid").jqxGrid({
			    width: '100%',
			    source: dataAdapter,
			    enablehover: true,
                theme: 'energyblue',
			    selectionmode: 'singlerow',
			    columns: [
				    { text: 'Id', datafield: 'id', width: '10%' },
				    { text: 'Name', datafield: 'name', width: '90%' },
			    ]
        });

        $("#grid").on('rowselect', function (event) {
	        $('#input-types-document').val(event.args.row.name);
	        $('#form-show-types-document').submit();
        });

    </script>

<?php include("footer.php") ?>