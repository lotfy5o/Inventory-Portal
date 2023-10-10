<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <h1 class="text-center">Users Management</h1>
    <hr>
    <div class="container">
        <div class="col-6 offset-3">
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="nameTxt" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="emailTxt" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" name="phoneTxt" class="form-control form-control-sm">
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
                    <input type="text" name="usernameTxt" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="text" name="passTxt" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <input type="submit" value="Save" name="saveBtn" class="btn btn-info btn-sm col-4 offset-2 my-4">
                    <input type="submit" value="View" name="viewBtn" class="btn btn-info btn-sm col-4 my-4">
                </div>

                <input type="hidden" name="id" value="2">
            </form>
        </div>
    </div>
    <div class="">
        <?php 
        // I commented the next line since the session already started
        // session_start();
        if (isset($_POST['editBtn'])){
            // $_POST['idRB'] == when you chech the radio the $_post['idRB] is set
          if (isset($_POST['idRB'])){
            $_SESSION['userID'] = $_POST['idRB'];
            retrieve4Edit();
          }
          else {
            echo "<p class='alert alert-danger'>Please Select any User First.</p>";
            retrieve();
          }
        }

        
        
          
        include "connection.php";
        
        // retrieve();
        ?>
    </div>
</body>
</html>

<?php
include "connection.php";
include "validate.php";
include "crud.php";
function retrieve(){
    global $con;
    if ($con){
        $query = "CALL st_getUsers();";
        $result = mysqli_query($con, $query);
        while(mysqli_next_result($con)){;}

        if (mysqli_num_rows($result) > 0){



            echo "<form action='' method='post'class='col-10 offset-1'>";
            // the next line is for the page_id => navigating pages
            echo "<input type='hidden' name='id' value='2'>";

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
                              '<td><input type="submit" name="editBtn" value="Edit" class="btn btn-info btn-sm mx-1" />' . 
                              '<input type="submit" name="updateBtn" value="Update" class="btn btn-info btn-sm mx-1" />' . 
                              '<input type="submit" name="deleteBtn" value="Delete" class="btn btn-info btn-sm mx-1" /></td>' ;
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

function retrieve4Edit(){
    global $con;
    if ($con){
        while(mysqli_next_result($con)){;}
        $query = "CALL st_getUsers();";
        $result = mysqli_query($con, $query);
        while(mysqli_next_result($con)){;}



        if (mysqli_num_rows($result) > 0){

            echo "<form action='' method='post' class='col-10 offset-1'>";
            echo "<input type='hidden' name='id' value='2'>";
            echo "<table class='table table-active col-6'>";
            echo "<thead class='table table-active my-3'>";
                echo "<th>ID</th>" . 
                "<th>Name</th>" . 
                "<th>Email</th>" . 
                "<th>Phone</th>" . 
                "<th>Role</th>" . 
                "<th>Username</th>" .
                "<th>Password</th>" .
                // "<th>RoleID</th>" . 
                "<th class='col-3'>Actions</th>" ;
            echo "</thead>";
                 while ($row = mysqli_fetch_row($result)){
                    // if the id in idRB matches the id in the row of the table
                    if ($_SESSION['userID'] == $row[0]){
                        
                        
                        echo "<tr>";
                            echo    "<td><input type='radio'   value='$row[0]' name='idRB' class='custom-radio' checked/></td>" . 
                                    "<td><input type='textbox' value='$row[1]' name='nameTxt' class='form-control form-control-sm'/></td>" . 
                                    "<td><input type='textbox' value='$row[2]' name='emailTxt' class='form-control form-control-sm'/></td>" . 
                                    "<td><input type='textbox' value='$row[3]' name='phoneTxt' class='form-control form-control-sm'/></td><td>" ;
                                    // if u concatinate the next line and don't use echo statement it will go different.
                                    echo getRoles();
                                    echo "</td>" . 

                                    "<td><input type='textbox' value='$row[4]' name='usernameTxt' class='form-control form-control-sm'/></td>" . 
                                    "<td><input type='textbox' value='$row[5]' name='passTxt'     class='form-control form-control-sm'/></td>" . 

                                    "<td>" . 
                                    "<input type='submit' value='EDIT'   name='editBtn'   class='btn btn-info btn-sm mx-1'/>".
                                    "<input type='submit' value='UPDATE' name='updateBtn' class='btn btn-info btn-sm mx-1'/>".
                                    "<input type='submit' value='DELETE' name='deleteBtn' class='btn btn-info btn-sm mx-1'/>".
                                    "</td>";

                        echo "</tr>";
                    }
                    else {
                        echo "<tr>";
                            echo "<td><input type='radio' name='idRB' value='$row[0]'/></td>" . 
                                "<td>$row[1]</td>" . 
                                "<td>$row[2]</td>" . 
                                "<td>$row[3]</td>" .
                                "<td>$row[7]</td>" . 
                                "<td>$row[4]</td>" . 
                                "<td>$row[5]</td>" . 
                                
                                '<td>' .
                                '<input type="submit" name="editBtn"   value="Edit"   class="btn btn-info btn-sm mx-1" />' . 
                                '<input type="submit" name="updateBtn" value="Update" class="btn btn-info btn-sm mx-1" />' . 
                                '<input type="submit" name="deleteBtn" value="Delete" class="btn btn-info btn-sm mx-1" />' .
                                '</td>';
                              
                                
                        echo "</tr>";
                    }
                                      
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
if (isset($_POST['viewBtn'])){
    retrieve();
}
elseif (isset($_POST['updateBtn'])){
    
        // $_POST['idRB'] == when you chech the radio the $_post['idRB] is set
    if (isset($_POST['idRB'])){
        // include "validate.php";
        // include "crud.php";
        $userID   = $_POST['idRB'];
        $name     = $_POST['nameTxt'];
        $email    = $_POST['emailTxt'];
        $phone    = $_POST['phoneTxt'];
        $roleID   = $_POST['roleDD'];
        $username = $_POST['usernameTxt'];
        $pass     = $_POST['passTxt'];
    
        if (!empty($name) && !empty($email) && !empty($phone) && !empty($roleID) && !empty($username) && !empty($pass)) {
            $userID  = validate($_POST['idRB']);
            $name     = validate($_POST['nameTxt']);
            $email    = validate($_POST['emailTxt']);
            $phone    = validate($_POST['phoneTxt']);
            // roleDD is coming from getRoles.php
            $roleID   = validate($_POST['roleDD']);
            $username = validate($_POST['usernameTxt']);
            $pass     = validate($_POST['passTxt']);
    
            $arr = array($name, $email, $phone, $roleID, $username, $pass, $userID);
            $msg = insert_update_delete("st_updateUsers", $arr, "User Updated Successfully");
            echo "<p class='text-info text-center'>$msg</p>";
        }
        else {
            echo "<p class='text-danger text-center'>Some data are Empty</p>";
        }
        
        }
    else {
        echo "<p class='alert alert-danger'>Please Select any User First.</p>";
        
    }
    retrieve();
}
elseif (isset($_POST['deleteBtn'])){
    if (isset($_POST['idRB'])){
        $id = $_POST['idRB'];
        $arr = array($id);
        $res = insert_update_delete("st_deleteUser", $arr, "User Deleted Successfully.");
        echo "<p class='text-center text-info'>$res</p>";
        retrieve();
    }
    else {
        echo "<p class='text-center text-danger mt-2'>Please Select a User first.</p>";
        retrieve();
    }
}
elseif (isset($_POST['saveBtn'])){
           // $_POST['idRB'] == when you chech the radio the $_post['idRB] is set
            
            // include "validate.php";
            // include "crud.php";
            
            $name     = validate($_POST['nameTxt']);
            $email    = validate($_POST['emailTxt']);
            $phone    = validate($_POST['phoneTxt']);
            // roleDD is coming from getRoles.php
            $roleID   = validate($_POST['roleDD']);
            $username = validate($_POST['usernameTxt']);
            $pass     = validate($_POST['passTxt']);
    
            $arr = array($name, $email, $phone, $roleID, $pass, $username);

        // this next code should be added to the validate function
        $empty = false;
        foreach ($arr as $a){
            if (empty($a)){
                $empty = true;
           
            }
            
        }
        if ($empty){
            echo "<p class='alert alert-danger'>Please Enter Valid Records.</p>";
        }
               
        else {
            $msg = insert_update_delete("st_insertUser", $arr, "User Added Successfully");
            echo "<p class='text-info text-center'>$msg</p>";
            
        }
    retrieve();
}
?>





