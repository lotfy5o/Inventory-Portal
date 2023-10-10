<?php

$page_id = 0;
if(isset($_GET["id"])){
    $page_id = $_GET["id"]; // the id = 1 from get
}
else if (isset($_POST["id"])){
    $page_id = $_POST["id"]; // the id = 1 from post
}

?>

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
                    <a class="list-group-item list-group-item-action bg-light" href="#">Dashboard</a>
                    <!-- I added the query parameters (?id=1) so that I can use the Get method -->
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="adminDB.html.php?id=1">Roles</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="adminDB.html.php?id=2">Users</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="adminDB.html.php?id=3">Suppliers</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="adminDB.html.php?id=4">Categories</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="adminDB.html.php?id=5">Sizes</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="adminDB.html.php?id=6">Colors</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="adminDB.html.php?id=8">Customers</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="adminDB.html.php?id=7">Purchase Invoice</a>
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
                    <?php 
                    if ($page_id == 1){
                        include "rolesCRUD.php";
                    } 
                    else if ($page_id == 2){
                        include "usersCRUD.php";
                    }
                    else if ($page_id == 3){
                        include "suppliersCRUD.php";
                    }
                    else if ($page_id == 4){
                        include "categoriesCRUD.php";
                    }
                    else if ($page_id == 5){
                        include "sizesCRUD.php";
                    }
                    else if ($page_id == 6){
                        include "colorsCRUD.php";
                    }
                    else if ($page_id == 7){
                        include "purchaseInvoice.php";
                    }
                    else if ($page_id == 8){
                        include "customerCRUD.php";
                    }
                  
                    ?>
                
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
// // I don't know the purpose of the next code..?..
// if you get to this page not through the login it will redirect you to the authenticate page
// cuz the $_session['name] isn't set yet
// it wil be set if ($role == 'admin') in the authenticate.php

session_start();
if (isset($_SESSION["name"])){

} else {
    header("Location:authenticate.html.php");
}

?>
