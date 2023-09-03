<?php

include "connection.php";

function insert_update_delete ($proc, $arr){
    global $con;
    $query = "CALL " . $proc . "(";
    foreach ($arr as $a){
        //there will be a prob when writing numeric data
        // $query .= "'" . $a . "'" . ",";
        
        // he said that with single quotes
        // it converts non numeric data into numeric data
        $query .= "'" . $a . "'" . ",";
    }
    // this line for deleting the last comma and
    // adding the closing parenthesis
    $query = substr_replace($query, ")", -1);

    while(mysqli_next_result($con)){;}

    if (mysqli_query($con, $query)){
        echo "Inserted";
    } else {
        echo "Not Inseted";
    }

}