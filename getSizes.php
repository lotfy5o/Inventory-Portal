<?php 
include "connection.php";
// I don't get what is this id
if (isset($_REQUEST['id'])){
    
    $id = $_REQUEST['id'];
    $query = "Call st_getSizes($id)";

    $result = mysqli_query($con, $query);

    
    if (mysqli_num_rows($result) > 0){
        echo "<option value='-1'>Choose...</option>";
        
        while ($row = mysqli_fetch_row($result)){
            echo "<option value='$row[0]'>$row[1]</option>";
        }
    }
    else {
        echo "<option value='-1'>Choose...</option>";
    }
}



?>