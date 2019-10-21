<?php
/**
 * File of the search-document.php view
 * @package App\Views\Documents
 * @filesource
 */

namespace App\Views\Documents;

/**
 * Dummy class
 */
Class SearchDocument{}
?>

<?php include("entete.php")?>
<title>TEMPLATE TITLE</title>
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
                    <h5 style="text-align: center">TEMPLATE HEADER</h5>
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
                TEMPLATE MAIN PANEL
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

</script>

<?php include("footer.php") ?>


