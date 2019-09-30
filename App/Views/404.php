<?php
/**
 * File of the 404.php view
 * @package App\Views
 * @filesource
 */
namespace App\Views;

/**
 * Dummy class
 */
class Error404{}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--PAGE TITLE-->
    <title>PAGE NOT FOUND</title>
    <link rel="stylesheet" href="/styles/bootstrap.css" >
    <link rel="stylesheet" href="/styles/jqx.base.css">
    <link rel="stylesheet" href="/styles/jqx.energyblue.css">
    <link rel="stylesheet" href="/styles/custom.css">
    <script type="text/javascript" src="/scripts/jqx-all.js"></script>
    <script type="text/javascript" src="/scripts/menu.js"></script>
</head>
<body>
<div id="wrap">
    <div id="pageheader">
        <h1>WEBDOC</h1>
    </div>
    <!-- Begin page content -->
    <div class="container">
        <div class="row">
            <div class="col">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <!-- DOCUMENT TITLE-->
            <div id="page-title" class="offset-lg-3 col-lg-6">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h5 style="text-align: center">ERROR 404</h5>
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
            <!-- MAIN PANEL -->
            <div id="main-panel"  class="offset-lg-3 col-lg-6">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h6 style="text-align: center"><strong>Sorry, this page doesn't exist</strong></h6>
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
</body>
</html>

<?php
