<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Management</title>
    <link rel="stylesheet" href="Styles/bootstrap.min.css">
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
    <h1 class="text-center">Supplier Management</h1>
    <hr>
    <div class="container">
        <div class="col-6 offset-3">
            <form action="" method="post">
                <input type='hidden' value='3'>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="nameTxt" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" name="phoneTxt" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="addressTxt" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="">Opening Balance</label>
                    <input type="text" name="obTxt" class="form-control form-control-sm">
                </div>
                <div>
                    <input type="submit" name="saveBtn" value="Save" class="btn btn-primary btn-sm col-4 offset-2 my-2">
                    <input type="submit" name="viewBtn" value="View" class="btn btn-primary btn-sm col-4">
                </div>
            </form>

        </div>

    </div>
    <div>
        <?php
        // if (isset($_POST['editBtn'])){
        //     if (isset($_POST['idRB'])){
        //         session_start();
        //         $_SESSION['supp_id'] = $_POST['idRB'];
        //         retrieve4Edit();
        //     }
        //     else {
        //         echo "<p class='alert alert-danger text-center'>Please Select a Supplier</p>";
        //     }
        // }


        ?>
    </div>
</body>
</html>
<?php
include "connection.php";
include "validate.php";
include "crud.php";
include "loadList.php";

if (isset($_POST['saveBtn'])){
    $name    = $_POST['nameTxt'];
    $phone   = $_POST['phoneTxt'];
    $address = $_POST['addressTxt'];
    $ob      = $_POST['obTxt'];
    
    if (!empty($name) && !empty($phone) && !empty($address) && !empty($ob)){
        // I didn't do !empty($ob) cuz I won't be able to add a supplier with a balance of zero
        // the prog will consider it to be empty and will return "data is missing".
        $name = validate($name);
        $phone = validate($phone);
        $address = validate($address);
        $ob = validate($ob);
        $bal = 0;
        $arr = array($name, $phone, $address);
        insert_update_delete("st_insertSupplier", $arr, "$name added Successfully");
               
        
        if ($ob > 0){
            // $dt = getdate(); getdate returns an array which will colide with the arr I am making
            
            $debit = $ob;
            $credit = 0;
            
            
        }
        else if ($ob < 0){
            
            $debit = 0;
            $credit = abs($ob);
        }
        else if ($ob == 0){
            $debit = 0;
            $credit = 0;
            
        }

        $dt = gmdate("y-m-d"); // 21-Feb-2020
        $descr = "Opening Balance";
        $bal = $bal + $debit - $credit;
        $supID = getLastID("st_getLastSupplierID()", $con);
        $arr2 = array($dt, $supID, $descr, $debit, $credit, $bal);
        $msg = insert_update_delete("st_insertSupplierLedger", $arr2, "$name added Successfully");
        echo "<p class='text-info text-center'>$msg</p>";

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
        $_SESSION['suppID'] = $_POST['idRB'];
        retrieve4Edit();
    }
    else {
        echo "<div class='container col-6'>";
        echo "<p class='alert alert-danger text-center'>Please Select a Supplier</p>";
        echo "</div>";
        retrieve();
    }
        
}
else if (isset($_POST['updateBtn'])){
    if (isset($_POST['idRB'])){
        // $name    = $_POST['name'];
        // $phone   = $_POST['phone'];
        // $address = $_POST['address'];
        // when I did the 3 line above this error happens:
        // Warning: Undefined array key "name"
        if (!empty($name) && !empty($phone) && !empty($address)){
            $name    = validate($_POST['name']);
            $phone   = validate($_POST['phone']);
            $address = validate($_POST['address']);
            $supp_id = validate($_POST['idRB']);
            $arr = array($name, $phone, $address, $supp_id);
            $msg = insert_update_delete("st_updateSuppliers", $arr, "Supplier Upadated Successfully");
            echo "<p class='text-info text-center'>$msg</p>";
        }
        else {
            
            echo "<p class='text-danger text-center'>Some Data are Empty</p>";
        }

    }
    else {
        echo "<div class='container col-6'>";
        echo "<p class='alert alert-danger text-center'>Please Select a Supplier</p>";
        echo "</div>";
    }
    retrieve();

}
else if (isset($_POST['deleteBtn'])){
    if (isset($_POST['idRB'])){
        $id = $_POST['idRB'];
        $arr = array($id);
        $msg = insert_update_delete("st_deleteSuppliers", $arr, "Supplier Deleted Successfully");
        echo "<p class='text-info text-center'>$msg</p>";
    }
    else {
        echo "<div class='container col-6'>";
        echo "<p class='alert alert-danger text-center'>Please Select a Supplier</p>";
        echo "</div>";
 
    }
    retrieve();


}

function retrieve (){
    global $con;
    if ($con){

        $query = "CALL st_getSuppliers();";
        $result = mysqli_query($con, $query);
        while(mysqli_next_result($con)){;}

        if (mysqli_num_rows($result) > 0){
            echo "<div class='col-8 offset-2'>";
            echo "<table class='table table-bordered table-hover'>";
            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='id' value='3'>";
        
            echo "<thead>";
            echo "<th>ID</th>" . 
                 "<th>Name</th>" . 
                 "<th>Phone</th>" . 
                 "<th>Address</th>" .
                 "<th>Opening Balance</th>" .
                 "<th>Actions</th>" ;
            echo "</thead>";     
            while ($row = mysqli_fetch_row($result)){
                echo "<tr>";
                echo "<td><input type='radio' name='idRB' value='$row[0]'/></td>";
                echo "<td>$row[1]</td>";
                echo "<td>$row[2]</td>";
                echo "<td>$row[3]</td>";
                echo "<td>$row[4]</td>";
                echo "<td>" . 
                     "<input type='submit' name='editBtn'   value='Edit'   class='btn btn-info btn-sm' />" . 
                     "<input type='submit' name='updateBtn' value='Update' class='btn btn-success btn-sm mx-1' />" . 
                     "<input type='submit' name='deleteBtn' value='Delete' class='btn btn-warning btn-sm' />" ; 
                echo "</td>";
                echo "</tr>";
        
            }
        
            echo "</form>";
            echo "</table>";
            echo "</div>";
        }
        else {
            echo "<p class='text-primary text-center'>No Supplier Available</p>";
        }
    
    }
    else {
        echo "No";
    }
}
function retrieve4Edit (){
    global $con;
    if ($con){

        $query = "CALL st_getSuppliers();";
        $result = mysqli_query($con, $query);
        while(mysqli_next_result($con)){;}

        if (mysqli_num_rows($result) > 0){
            echo "<div class='col-8 offset-2'>";
            echo "<table class='table table-bordered table-hover'>";
            echo "<form action='' method='post'>";
            echo "<input type='hidden' name='id' value='3'>";
        
            echo "<thead>";
            echo "<th>ID</th>" . 
                 "<th>Name</th>" . 
                 "<th>Phone</th>" . 
                 "<th>Address</th>" .
                 "<th>Opening Balance</th>" .
                 "<th class='col-3'>Actions</th>" ;
            echo "</thead>";     
            while ($row = mysqli_fetch_row($result)){
                if ($_SESSION['suppID'] == $row[0]){

                    echo "<tr>";
                    echo "<td><input type='radio'   name='idRB'    value='$row[0]' class='custom-radio' checked/></td>";
                    echo "<td><input type='textbox' name='name'    value='$row[1]' class='form-control form-control-sm'/></td>";
                    echo "<td><input type='textbox' name='phone'   value='$row[2]' class='form-control form-control-sm'/></td>";
                    echo "<td><input type='textbox' name='address' value='$row[3]' class='form-control form-control-sm'/></td>";
                    echo "<td><input type='textbox' name='ob'      value='$row[4]' class='form-control form-control-sm' disabled/></td>";
                    echo "<td>" . 
                         "<input type='submit' name='editBtn'   value='Edit'   class='btn btn-info btn-sm' />" . 
                         "<input type='submit' name='updateBtn' value='Update' class='btn btn-success btn-sm mx-1' />" . 
                         "<input type='submit' name='deleteBtn' value='Delete' class='btn btn-warning btn-sm' />" ; 
                    echo "</td>";
                    echo "</tr>";
                }
                else {
                    echo "<tr>";
                    echo "<td><input type='radio' name='idRB' value='$row[0]'/></td>";
                    echo "<td>$row[1]</td>";
                    echo "<td>$row[2]</td>";
                    echo "<td>$row[3]</td>";
                    echo "<td>$row[4]</td>";
                    echo "<td>" . 
                         "<input type='submit' name='editBtn'   value='Edit'   class='btn btn-info btn-sm' />" . 
                         "<input type='submit' name='updateBtn' value='Update' class='btn btn-success btn-sm mx-1' />" . 
                         "<input type='submit' name='deleteBtn' value='Delete' class='btn btn-warning btn-sm' />" ; 
                    echo "</td>";
                    
                    echo "</tr>";
                }
        
            }

        
            echo "</form>";
            echo "</table>";
            echo "</div>";
        }
        else {
            echo "<div class='container col-6'>";
            echo "<p class='alert-info text-center'>No Supplier Available</p>";
            echo "</div>";
        }
    
    }
    else {
        echo "No";
    }
}
// retrieve();

?>