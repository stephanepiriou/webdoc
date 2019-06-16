<?php include("entete.php")?>
    <title>Chercher un type d&aposindividu</title>
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
            <div class="container">
                <div class="row" style="align-content: center">
                    <div id="grid-list-types-individu"></div>
                </div>
            </div >
            <form id="form-show-types-individu" method="post" action="/types-individu/show">
                <input id='input-types-individu' name='typesIndividuName' type='hidden'>
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

        <?php if(isset($typesIndividuAsJson)){
            echo 'var data ='.$typesIndividuAsJson;
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

		$("#grid-list-types-individu").jqxGrid({
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

		$("#grid-list-types-individu").on('rowselect', function (event) {
			$('#input-types-individu').val(event.args.row.name);
			$('#form-show-types-individu').submit();
		});

    </script>

<?php include("footer.php") ?>