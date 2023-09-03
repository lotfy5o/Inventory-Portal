<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles Management</title>
    <link rel="stylesheet" href="Styles/bootstrap.min.css">
    
    <script defer src="Scripts/bootstrap.bundle.min.js"></script>
</head>
<body>
  
<div class="container">
    <div class="col-8 offset-2">
        <h2 class="text-center">Role Management</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="roleForm">
            <div class="form-group">
                <label for="">Role</label>
                <input type="text" name="roleTxt" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="ADD Role" name="roleSubmitBtn" class="btn btn-dark col-4 offset-2">
                <input type="submit" value="View Roles" name="roleViewBtn" class="btn btn-dark col-4">
                <hr style="visibility: hidden; margin: 0;">
            </div>
        </form>
        <?php
        include "connection.php";
        include "crud.php";
        include "validate.php";
        function retriveRoles(){
            global $con;

            // to display all the roles using select statement
            $query = "CALL st_getRoles();";
            // by the way the $result variable just stores wether
            // or not the query issued by mysqli_query() was successful.
            //  reference book=> head first php page 86
            $result = mysqli_query($con, $query);
            while(mysqli_next_result($con)){;}
            // echo "<div class='col-8 offset-2'>";
            // now after the conn is success 
            // we gona make tables head => id, roles
            echo "<table class='table table-hover'>";
            echo "<tr>";
            echo "<th>ID</th><th>Roles</th>";
            echo "</tr>"; 
            // we gona fetch the data of the tables from the database
            while($row = mysqli_fetch_row($result)) {
                echo "<tr>";
                // echo "<td>" . $row[0] . "</td>" .
                //      "<td>" . $row[1] . "</td>";
                echo "<td><input type='radio' value='$row[0]'
                 name='idRB' class='custom-radio'/></td>" . 
                "<td>$row[1]</td>";
    
                echo "</tr>";
                
                
            }
            echo "</table>";
            // echo "</div>";

        }
        retriveRoles();
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
        insert_update_delete("st_insertRoles", $arr);
        // retriveRoles();

    }
}
else if (isset($_POST['roleViewBtn'])){
    retriveRoles();
}
?>