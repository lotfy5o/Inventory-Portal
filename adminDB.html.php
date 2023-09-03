<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="Styles/styles.css" rel="stylesheet" />
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">A <sup>3</sup> I.T Solutions</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Dashboard</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Roles</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Users</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Suppliers</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Products</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="#!">Stock</a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <a class="navbar-nav ms-auto mt-2 mt-lg-0" href="logout.php">
                               <?php session_start(); $name = $_SESSION["name"]; echo "Welcome $name ";   ?>
                               LOGOUT
                            </a>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid">
                
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="Scripts/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="Scripts/code.jquery.com_jquery-3.7.0.min.js"></script>
    </body>
</html>
<?php
// I don't know the purpose of the next code..?..

// session_start();
// if (isset($_SESSION["name"])){

// } else {
//     header("Location:authenticate.hmlt.php");
// }

?>
