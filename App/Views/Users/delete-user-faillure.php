<?php
/**
 * File of the delete-user-faillure.php view
 * @package App\Views\Users
 * @filesource
 */
namespace App\Views\Users;

/**
 * Dummy class
 */
class DeleteUserFaillure{}
?>

<?php include("entete.php")?>
    <title>Effacer un utilisateur</title>
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
                        <h5 style="text-align: center">Effacer un utilisateur</h5>
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
                Un problème est survenu. <br/>
                L&apos;utilisateur n&apos;a pas pu être effacé.<br/>
                Etes-vous sûr que vous n&apos;etes pas le dernier utilisateur ?
                Veuillez recommencer !
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-12" id="footer">

    </div>
    <script type="text/javascript">

    </script>

<?php include("footer.php") ?>