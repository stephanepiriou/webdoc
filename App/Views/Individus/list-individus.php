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
        <div id="main-panel"  class="offset-lg-3 col-lg-6">
            <div class="container">
                <div class="row" style="align-content: center">
                    <div id="grid"></div>
                </div>
            </div >
            <form id="form-show-individus" method="post" action="/individus/show">
                <input id='input-individu-id' name='individuid' type='hidden'>
            </form>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-12" id="footer">

    </div>
    <script type="text/javascript">

        <?php if(isset($individusAsJson)){
            echo 'var data ='.$individusAsJson;
        }?>

		// prepare the data
		var source = {
			datatype: "json",
			datafields: [
				{ name: 'id', type: 'string'},
                { name: 'matricule', type:  'string'},
				{ name: 'firstname', type: 'string'},
				{ name: 'lastname', type: 'string'}
			],
			localdata: data
		};

		var dataAdapter = new $.jqx.dataAdapter(source);

		$("#grid").jqxGrid({
			width: '100%',
			source: dataAdapter,
			autoheight: true,
			enablehover: true,
			theme: 'energyblue',
			selectionmode: 'singlerow',
			columns: [
				{ text: 'Id', datafield: 'id', width: '10%' },
				{ text: 'Matricule', datafield: 'matricule', width: '20%' },
				{ text: 'Nom', datafield: 'lastname', width: '35%'},
				{ text: 'Prénom', datafield: 'firstname', width: '35%'}
			]
		});

		$("#grid").on('rowselect', function (event) {
			$('#input-individu-id').val(event.args.row.id);
			$('#form-show-individus').submit();
		});

    </script>

<?php include("footer.php") ?>