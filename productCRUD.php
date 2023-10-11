<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="Styles/bootstrap.min.css">
    
    <script defer src="Scripts/bootstrap.bundle.min.js"></script>
    <style>
        .alert {
        margin-bottom: 1px;
        height: 30px;
        line-height:30px;
        padding:0px 15px;
        }
    </style>
</head>
<body>
  
<div class="container">
    <div class="col-8 offset-2">
        <h2 class="text-center display-4" style="margin-top: 20px;">Product Management</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="productForm">
            <div class="form-group col-4 offset-4">
                <label for="">Product</label>
                <input type="text" name="proTxt" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <input type="submit" value="ADD Product" name="proSubmitBtn" class="btn btn-sm btn-success col-3 offset-3 my-3">
                <input type="submit" value="View Product" name="proViewBtn" class="btn btn-sm btn-primary col-3">
                <input type="hidden" name="id" value="9">
                <hr style="visibility: hidden; margin: 0;">
            </div>
        </form>
        <?php
        include "connection.php";
        include "crud.php";
        include "validate.php";
        include "message.php";

        function retrive(){
            global $con;

            // to display all the roles using select statement
            $query = "CALL st_getProducts();";
            // by the way the $result variable just stores wether
            // or not the query issued by mysqli_query() was successful.
            //  reference book=> head first php page 86
            $result = mysqli_query($con, $query);
            while(mysqli_next_result($con)){;}
            if (mysqli_num_rows($result) > 0){

                // I didn't include this next div cuz the table looked bad.
                // the problem was the retrieveRoles() call right after the fun.
                echo "<div class='col-8 offset-2'>";
                // now after the conn is success 
                // we gona make tables head => id, roles
                echo "<table class='table table-hover table-responsive-sm'>";
                echo "<tr>";
                echo "<th>ID</th><th>Products</th><th class='text-end'>Actions</th>";
                echo "</tr>"; 
                // if I didn't add the form the edit, update and delete btns 
                // won't do anything.
                echo "<form action='' method='POST'>";
                // we gona fetch the data of the tables from the database
                while($row = mysqli_fetch_row($result)) {
                    echo "<tr>";
                    // echo "<td>" . $row[0] . "</td>" .
                    //      "<td>" . $row[1] . "</td>";
                    echo "<td><input type='radio' value='$row[0]'
                    name='idRB' class='custom-radio'/></td>" . 
                    "<td>$row[1]</td>" . 
                    "<td class='text-end'>" . 
                        "<input type='submit' value='EDIT'   name='editBtn'     class='btn btn-sm btn-warning mx-2'/>" .
                        "<input type='submit' value='UPDATE' name='updateBtn' class='btn btn-sm btn-success mx-2'/>" .
                        "<input type='submit' value='DELETE' name='deleteBtn' class='btn btn-sm btn-danger'/>" . 
                        "<input type='hidden' name='id' value='9'>" . 
                    "</td>";
                    
        
                    echo "</tr>";
                    
                    
                }
                echo "</table>";
                echo "</form>";
                echo "</div>";
            }
            else {
                errorMessage("No Record Available");
            }

        }
        function retrive4Edit(){
            // session_start();
            $pro_id = $_SESSION["proID"];

            global $con;

            $query = "CALL st_getProducts();";
            
            $result = mysqli_query($con, $query);
            while(mysqli_next_result($con)){;}
            
            echo "<div class='col-8 offset-2'>";
            echo "<form action='' method='POST'>";

            echo "<table class='table table-hover'>";
            echo "<tr>";
            echo "<th>ID</th><th>Products</th><th class='text-end'>Actions</th>";
            echo "</tr>"; 
            
            echo "<form action='' method='POST'>";
            while($row = mysqli_fetch_row($result)) {
                echo "<tr>";
                if ($pro_id == $row[0]){
                    
                    
                    echo 
                    "<td><input type='radio' value='$row[0]'   name='idRB' class='custom-radio' checked/></td>" . 
                    "<td><input type='textbox' value='$row[1]' name='proEditTxt' class='form-control form-control-sm'/></td>" . 
                    "<td class='text-end'>" . 
                    "<input type='submit' value='EDIT'   name='editBtn'   class='btn btn-sm btn-warning mx-2'/>".
                    "<input type='submit' value='UPDATE' name='updateBtn' class='btn btn-sm btn-success mx-2'/>".
                    "<input type='submit' value='DELETE' name='deleteBtn' class='btn btn-sm btn-danger'/>" . 
                    "</td>";
                    
                }
                else {
                    echo 
                    "<td><input type='radio' value='$row[0]' name='idRB' class='custom-radio' /></td>" . 
                    "<td>$row[1]</td>" . 
                    "<td class='text-end'>" . 
                    "<input type='submit' value='EDIT'   name='editBtn'   class='btn btn-sm btn-warning mx-2'/>".
                    "<input type='submit' value='UPDATE' name='updateBtn' class='btn btn-sm btn-success mx-2'/>".
                    "<input type='submit' value='DELETE' name='deleteBtn' class='btn btn-sm btn-danger'/>" . 
                    "</td>";
                    
                   
                    
                }
    
                echo "</tr>";
                
                
            }
            echo "</table>";
            echo "<input type='hidden' name='id' value='9'>";
            echo "</form>";
            echo "</div>";
            echo "</form>";


        }
        // retriveRoles();
        ?>

    </div>

</div>
</body>
</html>

<?php
// if u use the next 3 lines again it will give a notice in the page: 
    // u can't redclare the insert_update_delete function

// include "connection.php";
// include "crud.php";
// include "validate.php";
if (isset($_POST["proSubmitBtn"])){
    $product = validate($_POST["proTxt"]);
    if (!empty($product)){
        $arr = array($product); // the $arr is the second argument
        // ...to the insert_update_delete function
        $res = insert_update_delete("st_insertProduct", $arr, "$product Added Successfully.");
        successMessage($res);
        retrive();

    }
    else {
        errorMessage("Please Select a Product First.");
        retrive();
    }
}
else if (isset($_POST['proViewBtn'])){
    retrive();
}
else if (isset($_POST['deleteBtn'])){
    if (isset($_POST['idRB'])){
        $id = $_POST['idRB'];
        $arr = array($id);
        $res = insert_update_delete("st_deleteProduct", $arr, "Product Deleted Successfully.");
        successMessage($res);
        retrive();
    }
    else {
        errorMessage("Please Select a Product First.");
        retrive();
    }
}
else if (isset($_POST['editBtn'])){
    if (isset($_POST['idRB'])){
        // session_start();
        $_SESSION["proID"] = $_POST['idRB'];
        retrive4Edit();
    }
    else {
        errorMessage("Please Select a Product First.");
        retrive();
    }
}
else if (isset($_POST['updateBtn'])){
    if (isset($_POST['idRB'])){
        $pro_id = $_POST["idRB"];
        $product = validate($_POST['proEditTxt']);
        $arr = array($product, $pro_id);
        $res = insert_update_delete("st_updateProduct", $arr, "Record Updated Successfully");
        successMessage($res);
        retrive();

    }
    else {
        errorMessage("Please Select a Product First.");
        retrive();
    }
}
?>