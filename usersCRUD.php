<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Styles/bootstrap.min.css">

</head>
<body>
    <h1 class="text-center">Users Management</h1>
    <hr>
    <div class="container">
        <div class="col-6 offset-3">
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="nameTxt" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="emailTxt" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" name="phoneTxt" class="form-control">
                </div>
                <div class="form-control">
                    <label for="">Roles</label>
                    <?php
                    include "getRoles.php";
                    
                    getRoles();
                    
                    ?>
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="usernameTxt" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="text" name="passTxt" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="Save" name="saveBtn" class="btn btn-info col-4 offset-2 my-4">
                    <input type="submit" value="View" name="viewBtn" class="btn btn-info col-4 my-4">
                </div>

            </form>
        </div>
    </div>
    <div class="">
        <?php 
        session_start();
        if (isset($_POST['editBtn'])){
          if (isset($_POST['idRB'])){
            $_SESSION['userID'] = $_POST['idRB'];
          }
          else {
            echo "<p class='alert alert-danger'>Please Select any User First.</p>";
          }
        }

        ?>
        
        <?php  
        include "connection.php";
        
        retrieve();
        ?>
    </div>
</body>
</html>

<?php
include "connection.php";
function retrieve(){
    global $con;
    if ($con){
        $query = "CALL st_getUsers();";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0){



            echo "<form action='' method='post'>";
            echo "<table class='table table-active'>";
            echo "<thead class='table table-active my-3'>";
                echo "<th>ID</th>" . 
                "<th>Name</th>" . 
                "<th>Email</th>" . 
                "<th>Phone</th>" . 
                "<th>Role</th>" . 
                "<th>RoleID</th>" . 
                "<th>Username</th>" .
                "<th>Password</th>" .
                "<th class=''>Actions</th>" ;
            echo "</thead>";
                 while ($row = mysqli_fetch_row($result)){
                     echo "<tr>";
                         echo "<td><input type='radio' name='idRB' value='$row[0]'/></td>" . 
                              "<td>$row[1]</td>" . 
                              "<td>$row[2]</td>" . 
                              "<td>$row[3]</td>" . 
                              "<td>$row[7]</td>" . 
                              "<td>$row[6]</td>" . 
                              "<td>$row[4]</td>" .
                              "<td>$row[5]</td>" .
                              '<td><input type="submit" name="editBtn" value="Edit" class="btn btn-info mx-1" />' . 
                              '<input type="submit" name="updateBtn" value="Update" class="btn btn-info mx-1" />' . 
                              '<input type="submit" name="DeleteBtn" value="Delete" class="btn btn-info mx-1" /></td>' ;
                     echo "</tr>";
                     
                    }
            echo "</table>";        
            echo "</form>";
            
        }
        else {
            echo "No Record Are Available";
        }
    }
    else {
        echo "No";
    }
}

?>



