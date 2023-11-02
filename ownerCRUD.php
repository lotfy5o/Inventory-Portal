<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owners Management</title>
    <link rel="stylesheet" href="Styles/bootstrap.min.css">
    
    <script defer src="Scripts/bootstrap.bundle.min.js"></script>
    <style>
        .alert {
        margin bottom: 1px;
        height: 30px;
        line-height:30px;
        padding:0px 15px;
        }
    </style>
</head>
<body>
  
<div class="container">
    <div class="col-8 offset-2">
        <h2 class="text-center display-4" style="margin-top: 20px;">Owner Management</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="ownerForm">
            <div class="form-group col-4 offset-4">
                <label for="">Name</label>
                <input type="text" name="nameTxt" class="form-control form-control-sm">
            </div>
            <div class="form-group col-4 offset-4">
                <label for="">Phone</label>
                <input type="text" name="phoneTxt" class="form-control form-control-sm">
            </div>
            <div class="form-group col-4 offset-4">
                <label for="">Address</label>
                <input type="text" name="addrTxt" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <input type="submit" value="ADD Owner" name="ownerSubmitBtn" class="btn btn-sm btn-success col-3 offset-3 my-3">
                <input type="submit" value="View Owners" name="ownerViewBtn" class="btn btn-sm btn-primary col-3">
                <input type="hidden" name="id" value="1">
                <hr style="visibility: hidden; margin: 0;">
            </div>
        </form>
        <?php
        include "connection.php";
        include "crud.php";
        include "validate.php";
        include "message.php";

        function retriveOwners(){
            global $con;

            // to display all the owners using select statement
            $query = "CALL st_getOwner();";
            $result = mysqli_query($con, $query);
            while(mysqli_next_result($con)){;}
            if (mysqli_num_rows($result) > 0){

                echo "<div class='col-8 offset-2'>";
                echo "<table class='table table-hover table-responsive-sm'>";
                echo "<tr>";
                echo "<th>ID</th><th>Owner</th><th>Phone</th><th>Address</th><th class='text-end'>Actions</th>";
                echo "</tr>"; 
                echo "<form action='' method='POST'>";
                while($row = mysqli_fetch_row($result)) {
                    echo "<tr>";
                    echo "<td><input type='radio' value='$row[0]'
                    name='idRB' class='custom-radio'/></td>" . 
                    "<td>$row[1]</td>" . 
                    "<td>$row[2]</td>" . 
                    "<td>$row[3]</td>" . 
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

        function retriveOwners4Edit(){
            $owner_id = $_SESSION["ownerID"];

            global $con;

            $query = "CALL st_getOwner();";
            
            $result = mysqli_query($con, $query);
            while(mysqli_next_result($con)){;}
            
            echo "<div class='col-8 offset-2'>";
            echo "<form action='' method='POST'>";

            echo "<table class='table table-hover'>";
            echo "<tr>";
            echo "<th>ID</th><th>Owner</th><th>Phone</th><th>Address</th><th class='text-end'>Actions</th>";
            echo "</tr>"; 
            
            echo "<form action='' method='POST'>";
            while($row = mysqli_fetch_row($result)) {
                echo "<tr>";
                if ($owner_id == $row[0]){
                    echo 
                    "<td><input type='radio' value='$row[0]'   name='idRB' class='custom-radio' checked/></td>" . 
                    "<td><input type='textbox' value='$row[1]' name='nameTxt' class='form-control form-control-sm'/></td>" . 
                    "<td><input type='textbox' value='$row[2]' name='phoneTxt' class='form-control form-control-sm'/></td>" . 
                    "<td><input type='textbox' value='$row[3]' name='addrTxt' class='form-control form-control-sm'/></td>" . 
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

        ?>

    </div>

</div>
</body>
</html>

<?php
if (isset($_POST["ownerSubmitBtn"])){
    $name = validate($_POST["nameTxt"]);
    $phone = validate($_POST["phoneTxt"]);
    $addr = validate($_POST["addrTxt"]);
    if (!empty($name) && !empty($phone) && !empty($addr) ){
        $arr = array($name, $phone, $addr);
        $res = insert_update_delete("st_insertOwner", $arr, "$name Added Successfully.");
        successMessage($res);
        retriveOwners();
    }
    else {
        errorMessage("Please Select an Owner First.");
        retriveOwners();
    }
}
else if (isset($_POST['ownerViewBtn'])){
    retriveOwners();
}
else if (isset($_POST['deleteBtn'])){
    if (isset($_POST['idRB'])){
        $id = $_POST['idRB'];
        $arr = array($id);
        $res = insert_update_delete("st_deleteOwner", $arr, "Owner Deleted Successfully.");
        successMessage($res);
        retriveOwners();
    }
    else {
        errorMessage("Please Select an Owner First.");
        retriveOwners();
    }
}
else if (isset($_POST['editBtn'])){
    if (isset($_POST['idRB'])){
        $_SESSION["ownerID"] = $_POST['idRB'];
        retriveOwners4Edit();
    }
    else {
        errorMessage("Please Select an Owner First.");
        retriveOwners();
    }
}
else if (isset($_POST['updateBtn'])){
    if (isset($_POST['idRB'])){
        $owner_id = $_POST["idRB"];
        $name = validate($_POST["nameTxt"]);
        $phone = validate($_POST["phoneTxt"]);
        $addr = validate($_POST["addrTxt"]);
        $arr = array($name, $phone, $addr, $owner_id);
        $res = insert_update_delete("st_updateOwner", $arr, "Record Updated Successfully");
        successMessage($res);
        retriveOwners();
    }
    else {
        errorMessage("Please Select an Owner First.");
        retriveOwners();
    }
}
?>
