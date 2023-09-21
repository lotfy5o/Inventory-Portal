<?php
include "connection.php";

function getRoles(){
    global $con;
    if ($con){
        $query = "CALL st_getRoles();";
        $result = mysqli_query($con, $query);
        while(mysqli_next_result($con)){;}

        if (mysqli_num_rows($result) > 0) {
            // name = 'roleDD' === role drop down
            echo "<select class='form-select form-select-sm' name='roleDD'";
            while($row = mysqli_fetch_row($result)){
                // the id ($row[0]) || name ($row[1])
                echo "<option value='$row[0]'>$row[1]</option>";
            }
            echo "</select>";
            // mysqli_close($con);
        }
        
    }
    else {
        echo "no";
    }
}

?>