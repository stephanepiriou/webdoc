<?php
/**
 * File of the list-users.php view
 * @package App\Views\Users
 * @filesource
 */
namespace App\Views\Users;

/**
 * Dummy class
 */
class ListUsers{}
?>

<?php include("entete.php")?>
    <title>Chercher un utilisateur</title>
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
            <div class="container">
                <div class="row" style="align-content: center">
                    <div id="grid"></div>
                </div>
            </div >
            <form id="form-show-users" method="post" action="/users/show">
                <input id='input-user-id' name='userId' type='hidden'>
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

        <?php if(isset($emailsAsJson)){
            echo 'var data ='.$emailsAsJson;
        }?>

		// prepare the data
		var source = {
			datatype: "json",
			datafields: [
				{ name: 'id', type: 'string'},
				{ name: 'name', type: 'string'},
                { name: 'email', type: 'string'}
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
				{ text: 'Name', datafield: 'name', width: '40%' },
                { text: 'Email', datafield: 'email', width: '50%'}
			]
		});

		$("#grid").on('rowselect', function (event) {
			$('#input-user-id').val(event.args.row.id);
			$('#form-show-users').submit();
		});

    </script>

<?php include("footer.php") ?>