<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
</head>
<body>
    <?php
    if (isset($_POST['purchaseArray']) && isset($_POST['purchaseDetails'])){
        $purchaseData = $_POST['purchaseArray'];
        // echo $purchaseData[0] . "    " . $purchaseData[1];
        $purchaseDetails = $_POST['purchaseDetails'];

        echo $purchaseDetails[0][0];
        echo " ";
        echo $purchaseDetails[0][1];
        echo " ";
        echo $purchaseDetails[0][2];
        echo " ";
        echo $purchaseDetails[0][3];
        echo " ";
        echo $purchaseDetails[0][4];
        echo " ";
        echo $purchaseDetails[0][5];
        
        echo "<br>";
        
        echo $purchaseDetails[1][0];
        echo " ";
        echo $purchaseDetails[1][1];
        echo " ";
        echo $purchaseDetails[1][2];
        echo " ";
        echo $purchaseDetails[1][3];
        echo " ";
        echo $purchaseDetails[1][4];
        echo " ";
        echo $purchaseDetails[1][5];
        
              
    }
    else {
        echo "No Record.";
    }
    
    
    ?>
</body>
</html>