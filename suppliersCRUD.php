<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Management</title>
    <link rel="stylesheet" href="Styles/bootstrap.min.css">

</head>
<body>
    <h1 class="text-center">Supplier Management</h1>
    <hr>
    <div class="container">
        <div class="col-6 offset-3">
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="nameTxt" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" name="phoneTxt" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="addressTxt" class="form-control form-control-sm">
                </div>
                <div>
                    <input type="submit" name="saveBtn" value="Save" class="btn btn-info btn-sm col-4 offset-2 my-2">
                    <input type="submit" name="viewBtn" value="View" class="btn btn-info btn-sm col-4">
                </div>
            </form>

        </div>

    </div>
    
</body>
</html>