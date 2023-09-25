<?php include "loadList.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Invoice</title>
    <link rel="stylesheet" href="Styles/bootstrap.min.css">
</head>

<body>
    <h2 class="text-center bg-light mb-0">Purchase Invoice</h2>
    <hr class="mt-0">
    <div class="container">
        <form action="" method="">
            <div class="row">
                <div class="col-3">
                    <label for="">Date</label>
                    <input type="date" name="datePicker" class="form-control form-control-sm">
                </div>
                <div class="col-3">
                    <label for="">Supplier</label>
                    <?php getList("st_getSuppliers", "suppDD");   ?>
                </div>
                <div class="col-3">
                    <label for="">Categories</label>
                    <?php getList("st_getCategories", "catDD");   ?>
                </div>
                <div class="col-3">
                    <label for="">Colors</label>
                    <?php getList("st_getColors", "colDD");   ?>
                </div>
                
                

            </div>
        </form>
    </div>
</body>
</html>