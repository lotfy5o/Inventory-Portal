<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories Management</title>
    <link rel="stylesheet" href="Styles/bootstrap.min.css">

</head>
<body>
    <h1 class="text-center">Categories Management</h1>
    <hr>
    <div class="container">
        <div class="col-6 offset-3">
            <form action="" method="post">
                <input type='hidden' value='4'>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="nameTxt" class="form-control form-control-sm">
                </div>
                
                <div>
                    <input type="submit" name="saveBtn" value="Save" class="btn btn-secondary btn-sm col-4 offset-2 my-2">
                    <input type="submit" name="viewBtn" value="View" class="btn btn-secondary btn-sm col-4">
                </div>
            </form>

        </div>

    </div>
    
</body>
</html>
<?php
include "connection.php";
include "validate.php";
include "crud.php";
if (isset($_POST['saveBtn'])){
    $name    = $_POST['nameTxt'];
   
    
    if (!empty($name)){
        $name = validate($name);
        

        $arr = array($name);
        $msg = insert_update_delete("st_insertCategories", $arr, "Category added Successfully");
        echo "<p class='text-success text-center'>$msg</p>";
    }
    else {
        echo "<p class='text-danger text-center'>The form is messing data</p>";
    }
    retrieve();

}
else if (isset($_POST['viewBtn'])){
    retrieve();
}

else if (isset($_POST['editBtn'])){
     
    if (isset($_POST['idRB'])){
        session_start();
        $_SESSION['catID'] = $_POST['idRB'];
        retrieve4Edit();
    }
    else {
        echo "<p class='alert alert-danger text-center'>Please Select a Supplier</p>";
        retrieve();
    }
        
}
else if (isset($_POST['updateBtn'])){
    if (isset($_POST['idRB'])){
        $name    = $_POST['name'];
        
        if (!empty($name)){
            $name    = validate($_POST['name']);
            
            $cat_id = validate($_POST['idRB']);
            $arr = array($name, $cat_id);
            $msg = insert_update_delete("st_updateCategories", $arr, "Category Upadated Successfully");
            echo "<p class='text-success text-center'>$msg</p>";
        }
        else {
            
            echo "<p class='text-danger text-center'>Some Data are Empty</p>";
        }

    }
    else {
        echo "<p class='alert alert-danger text-center'>Please Select a Category</p>";
    }
    retrieve();

}
else if (isset($_POST['deleteBtn'])){
    if (isset($_POST['idRB'])){
        $id = $_POST['idRB'];
        $arr = array($id);
        $msg = insert_update_delete("st_deleteCategories", $arr, "Category Deleted Successfully");
        echo "<p class='text-success text-center'>$msg</p>";
    }
    else {
        echo "<p class='alert alert-danger text-center'>Please Select a Category</p>";
 
    }
    retrieve();


}

function retrieve (){
    global $con;
    if ($con){

        $query = "CALL st_getCategories();";
        $result = mysqli_query($con, $query);
        while(mysqli_next_result($con)){;}

        if (mysqli_num_rows($result) > 0){
            echo "<div class='col-6 offset-3'>";
            echo "<table class='table table-bordered table-hover'>";
            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='id' value='4'>";
        
            echo "<thead>";
            echo "<th>ID</th>" . 
                 "<th>Name</th>" . 
                 "<th>Actions</th>" ;
            echo "</thead>";     
            while ($row = mysqli_fetch_row($result)){
                echo "<tr>";
                echo "<td><input type='radio' name='idRB' value='$row[0]'/></td>";
                echo "<td>$row[1]</td>";
                echo "<td>" . 
                     "<input type='submit' name='editBtn'   value='Edit'   class='btn btn-success btn-sm' />" . 
                     "<input type='submit' name='updateBtn' value='Update' class='btn btn-success btn-sm mx-1' />" . 
                     "<input type='submit' name='deleteBtn' value='Delete' class='btn btn-success btn-sm' />" ; 
                echo "</td>";
                echo "</tr>";
        
            }
        
            echo "</form>";
            echo "</table>";
            echo "</div>";
        }
        else {
            echo "<p class='text-primary text-center'>No Categories are Available</p>";
        }
    
    }
    else {
        echo "No";
    }
}
function retrieve4Edit (){
    global $con;
    if ($con){

        $query = "CALL st_getCategories();";
        $result = mysqli_query($con, $query);
        while(mysqli_next_result($con)){;}

        if (mysqli_num_rows($result) > 0){
            echo "<div class='col-6 offset-3'>";
            echo "<table class='table table-bordered table-hover'>";
            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='id' value='4'>";
        
            echo "<thead>";
            echo "<th>ID</th>" . 
                 "<th>Name</th>" . 
                 "<th>Actions</th>" ;
            echo "</thead>";     
            while ($row = mysqli_fetch_row($result)){
                if ($_SESSION['catID'] == $row[0]){

                    echo "<tr>";
                    echo "<td><input type='radio' name='idRB'         value='$row[0]' checked/></td>";
                    echo "<td><input type='textbox' name='name'    value='$row[1]' class='form-control form-control-sm'/></td>";
                    echo "<td>" . 
                         "<input type='submit' name='editBtn'   value='Edit'   class='btn btn-success btn-sm' />" . 
                         "<input type='submit' name='updateBtn' value='Update' class='btn btn-success btn-sm mx-1' />" . 
                         "<input type='submit' name='deleteBtn' value='Delete' class='btn btn-success btn-sm' />" ; 
                    echo "</td>";
                    echo "</tr>";
                }
                else {
                    echo "<tr>";
                    echo "<td><input type='radio' name='idRB' value='$row[0]' checked/></td>";
                    echo "<td>$row[1]</td>";
                    echo "<td>" . 
                         "<input type='submit' name='editBtn'   value='Edit'   class='btn btn-success btn-sm' />" . 
                         "<input type='submit' name='updateBtn' value='Update' class='btn btn-success btn-sm mx-1' />" . 
                         "<input type='submit' name='deleteBtn' value='Delete' class='btn btn-success btn-sm' />" ; 
                    echo "</td>";
                    echo "</tr>";

                }
        
            }

        
            echo "</form>";
            echo "</table>";
            echo "</div>";
        }
        else {
            echo "<p class='alert-info text-center'>No Supplier Available</p>";
        }
    
    }
    else {
        echo "No";
    }
}
// retrieve();

?>