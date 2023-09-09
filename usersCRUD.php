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

            </form>
        </div>
    </div>
</body>
</html>
<?php
?>

