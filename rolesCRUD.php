<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles Management</title>
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
        <h2 class="text-center display-4" style="margin-top: 20px;">Role Management</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="roleForm">
            <div class="form-group col-4 offset-4">
                <label for="">Role</label>
                <input type="text" name="roleTxt" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <input type="submit" value="ADD Role" name="roleSubmitBtn" class="btn btn-sm btn-success col-3 offset-3 my-3">
                <input type="submit" value="View Roles" name="roleViewBtn" class="btn btn-sm btn-primary col-3">
                <input type="hidden" name="id" value="1">
                <hr style="visibility: hidden; margin: 0;">
            </div>
        </form>
        <?php
        include "connection.php";
        include "crud.php";
        include "validate.php";
        include "message.php";

        function retriveRoles(){
            global $con;

            // to display all the roles using select statement
            $query = "CALL st_getRoles();";
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
                echo "<th>ID</th><th>Roles</th><th class='text-end'>Actions</th>";
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
                        "<input type='submit' value='EDIT' name='editBtn'     class='btn btn-sm btn-warning mx-2'/>" .
                        "<input type='submit' value='UPDATE' name='updateBtn' class='btn btn-sm btn-success mx-2'/>" .
                        "<input type='submit' value='DELETE' name='deleteBtn' class='btn btn-sm btn-danger'/>" . 
                        "<input type='hidden' name='id' value='1'>" . 
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
        function retriveRoles4Edit(){
            // session_start();
            $role_id = $_SESSION["roleID"];

            global $con;

            $query = "CALL st_getRoles();";
            
            $result = mysqli_query($con, $query);
            while(mysqli_next_result($con)){;}
            
            echo "<div class='col-8 offset-2'>";
            echo "<form action='' method='POST'>";

            echo "<table class='table table-hover'>";
            echo "<tr>";
            echo "<th>ID</th><th>Roles</th><th class='text-end'>Actions</th>";
            echo "</tr>"; 
            
            echo "<form action='' method='POST'>";
            while($row = mysqli_fetch_row($result)) {
                echo "<tr>";
                if ($role_id == $row[0]){
                    
                    
                    echo 
                    "<td><input type='radio' value='$row[0]'   name='idRB' class='custom-radio' checked/></td>" . 
                    "<td><input type='textbox' value='$row[1]' name='roleEditTxt' class='form-control form-control-sm'/></td>" . 
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
            echo "<input type='hidden' name='id' value='1'>";
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
if (isset($_POST["roleSubmitBtn"])){
    $role = validate($_POST["roleTxt"]);
    if (!empty($role)){
        $arr = array($role); // the $arr is the second argument
        // ...to the insert_update_delete function
        $res = insert_update_delete("st_insertRoles", $arr, "$role Added Successfully.");
        successMessage($res);
        retriveRoles();

    }
    else {
        errorMessage("Please Select a Role First.");
        retriveRoles();
    }
}
else if (isset($_POST['roleViewBtn'])){
    retriveRoles();
}
else if (isset($_POST['deleteBtn'])){
    if (isset($_POST['idRB'])){
        $id = $_POST['idRB'];
        $arr = array($id);
        $res = insert_update_delete("st_deleteRoles", $arr, "Role Deleted Successfully.");
        successMessage($res);
        retriveRoles();
    }
    else {
        errorMessage("Please Select a Role First.");
        retriveRoles();
    }
}
else if (isset($_POST['editBtn'])){
    if (isset($_POST['idRB'])){
        // session_start();
        $_SESSION["roleID"] = $_POST['idRB'];
        retriveRoles4Edit();
    }
    else {
        errorMessage("Please Select a Role First.");
        retriveRoles();
    }
}
else if (isset($_POST['updateBtn'])){
    if (isset($_POST['idRB'])){
        $role_id = $_POST["idRB"];
        $role = validate($_POST['roleEditTxt']);
        $arr = array($role_id, $role);
        $res = insert_update_delete("st_updateRoles", $arr, "Record Updated Successfully");
        successMessage($res);
        retriveRoles();

    }
    else {
        errorMessage("Please Select a Role First.");
        retriveRoles();
    }
}
?>