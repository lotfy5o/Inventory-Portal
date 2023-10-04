<?php
// it's the same as the file "getRoles.php" but here
// we did a universal fucntion 
include "connection.php";

function getList($pro, $selectName, $con){
    global $con;
    if ($con){
        $query = "CALL $pro;";
        $result = mysqli_query($con, $query);
        while(mysqli_next_result($con)){;}

        if (mysqli_num_rows($result) > 0) {
            echo "<select class='form-select form-select-sm' name='$selectName' id='$selectName'>";
            // if I deleted the next line the drop down menu will only pick the last 
            // in the table and not showing the "Choose.." between the option tag
            // answer= I forgot o put ">" in the end of the select
            echo "<option value='-1' selected>Choose...</option>";
            while($row = mysqli_fetch_row($result)){
                echo "<option value='$row[0]'>$row[1]</option>";
            }

            echo "</select>";
        }
        else {
            echo "<select class='form-control form-control-sm'><option>...</option></select>";
        }
        
    }
    else {
        echo "no";
    }
}

?>