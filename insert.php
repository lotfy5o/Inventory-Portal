<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
</head>
<body>
    <?php
    include "connection.php";
    include "crud.php";

    if (isset($_POST['purchaseArray']) && isset($_POST['purchaseDetails'])){
        $piArray = $_POST['purchaseArray'];

        // (1) insert data of the purchaseInvoice => date, supplier
        insert_update_delete("st_insertPurchaseInvoice", $piArray, "");


        
        $query = "Call st_getLastPurchaseID()";
        $res = mysqli_query($con, $query);
        // I won't need while since its one row
        $row = mysqli_fetch_row($res);
        $purID = $row[0];

        $pidArray = $_POST['purchaseDetails'];
        // this variable to check if the querty st_insertPuchaseInvoiceDetails was successfull
        $count = 0;
        for ($i = 0; $i < count($pidArray); $i++){
            mysqli_next_result($con);
            // mutli-array with the i represents the rows of #myTable and 0 represent the column of proID
            $pro  = $pidArray[$i][0]; 
            $pp   = $pidArray[$i][1]; 
            $quan = $pidArray[$i][2]; 
            $cat  = $pidArray[$i][3]; 
            $size = $pidArray[$i][4]; 
            $col  = $pidArray[$i][5]; 

            $query = "CALL st_insertPurchaseInvoiceDetails($purID, $pro, $pp, $quan, $cat, $size, $col);";
            $query = $query . "CALL st_insertStock($pro, $quan, $purID, $cat, $size, $col);"; // notice the semicolon thats a string
            $query = $query . "CALL st_insertProductPrice($pro, $pp, $cat, $size, $col);";
            // the first $query is for pid and the second is for the stock table
            if (mysqli_multi_query($con, $query)){
                while(mysqli_next_result($con)){;} // if I didn't add this line => command out of sync

                $count += 1;
            }
        }
        if ($count > 0){
            echo "$count" . " Record Added Successfully" . mysqli_error($con);
        }
        else {
            echo "Unable to Add Purchase Details";
        }

        
        
              
    }
    else {
        echo "No Record.";
    }
    
    
    ?>
</body>
</html>