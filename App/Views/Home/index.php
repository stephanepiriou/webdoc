<?php
/**
 * File of the index.php view
 * @package App\Views\Home
 * @filesource
 */

namespace App\Views\Home;

/**
 * Dummy class
 */
Class Index{}

?>

<?php include("entete.php")?>
    <title>Webdoc Home</title>
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
                        <h5 style="text-align: center">Home</h5>
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
            <?php
                if(isset($message_home)){
                    echo '<div class="alert alert-success alert-dismissible fade show">'.$message_home.'</div>';
                }
            ?>
        </div>
    </div>
    </div>
    </div>

    <div class="col-lg-12" id="footer">

    </div>
    <script type="text/javascript">

    </script>

<?php include("footer.php") ?>