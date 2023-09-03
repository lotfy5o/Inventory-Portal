<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login...</title>
    <link rel="stylesheet" href="Styles/bootstrap.min.css">
    <script defer src="Scripts/bootstrap.bundle.min.js"></script>
</head>
<body>
   <div class="container">
    <div class="col-8 offset-2">
        <h1 class="text-center">Inventory Portal</h1>
        <hr>
        <h6 class="text-center">An all in one solution for Inventory on Web</h6>

        <div class="col-8 offset-2" style="margin-top: 90px;">
            <!-- the php code inside the action is more secured  -->
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="userTxt" placeholder="e.g. lotfy" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="passTxt" placeholder="min 6 chars" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submitBtn" value="LOGIN" class="btn btn-dark col-12">
                </div>
                <label><?php if (isset($error)){echo $error;}     ?></label>
            </form>
        </div>
    </div>
   </div>


</body>
</html>
<!-- why do I put the php code outside the html  -->
<?php
include "validate.php";
include "connection.php";
$error = "";
// see if the button is clicked or not
// by seeing if the variable submitBtn exists or not
if (isset($_POST["submitBtn"])) {
    // I think this line should be above the line isset($_post["submitBtn])
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // store the data inserted in the input "userTxt" slot inside $username
        $username= validate($_POST["userTxt"]);
        $pass= validate($_POST["passTxt"]);
        // if the username and the pass both aren ot empty
        if (!empty($username) && !empty($pass)){
    
            global $con;
            $query = "CALL st_getLoginDetails('$username', '$pass');";
            
            $result = mysqli_query($con, $query);
            // if the rows are more than one use while loop
            // with the condition ($row = mysqli_fetch_row($result))
            // get a row from the data in the $result
            
            if (mysqli_num_rows($result) > 0) {
                // I don't know the user of the loop since 
                // there would be one row for one user
                // with the unique username and pass 
                while($row = mysqli_fetch_row($result)){
                    // get the next variables from the st_getLoginDetails() code
                    session_start();

                    $roleID = $row[0];
                    $role = $row[1];
                    $name = $row[2];
                    $userID = $row[3];
        
                    if ($role == "admin"){

                        $_SESSION["name"] = $name;
                        header("Location: adminDB.html.php");
                    }


                    // echo "<h4>$roleID</h4>";
                    // echo "<h4>$role</h4>";
                    // echo "<h4>$name</h4>";
                    // echo "<h4>$userID</h4>";



                } 

            } else {
                echo "Invalid username or pass";
            }
            
        } else {
            $error = "Enter username or the pass";
        }
    }



}
?>