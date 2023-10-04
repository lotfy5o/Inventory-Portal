<?php include "loadList.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Invoice</title>
    <link rel="stylesheet" href="Styles/bootstrap.min.css">
    <script src="Scripts/code.jquery.com_jquery-3.7.0.min.js"></script>
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
                    <?php getList("st_getSuppliers", "suppDD", $con);   ?>
                </div>
                
                <div class="col-3">
                    <label for="">Categories</label>
                    <?php getList("st_getCategories()", "catDD", $con);   ?>
                </div>
                <div class="col-3">
                    <label for="">Sizes</label>
                    <select class="form-control form-control-sm" id="sizeDD">  
                        
                    </select>
                </div>
                    
                <div class="col-3">
                    <label for="">Colors</label>
                    <?php getList("st_getColors", "colDD", $con);   ?>
                </div>
                <div class="col-3">
                    <label for="">Product Name</label>
                    <input type="text"   name="proTxt"   id="proTxt"   class="form-control form-control-sm">
                </div>
                <div class="col-3">
                    <label for="">Quantity</label>
                    <input type="text"   name="quantTxt" id="quantTxt" class="form-control form-control-sm">
                </div>
                <div class="col-3">
                    <label for="">Per Piece Price</label>
                    <input type="text"   name="pppTxt"   id="pppTxt"   class="form-control form-control-sm">
                </div>
                <div class="col-3">
                    <label for="">Product Total</label>
                    <input type="text"   name="totTxt"   id="totTxt"   class="form-control form-control-sm" disabled>
                </div>
                <div class="col-3">
                    <input type="button" name="addBtn"   id="addBtn"   class="btn btn-info btn-sm mt-4 col-4" value="Add Item">
                </div>
            <table class="table table-borderless table-hover table-striped m-2" id="myTable">
                <thead>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </thead>
                <tbody>

                </tbody>
            </table>
                

            </div>
        </form>
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        // the problem was the getList it passes the selectName(catDD) in the name attribute
        // when it should be in the id attribute.
        $("#catDD").on('change',(function(){
            // the value of the drop down is the id
            // if you remember that in loadlist.php => the gitList fun <option value = $row[0]>
            var id = $(this).find(":selected").val();
            var dataStr = "id=" + id;
            // dataStr = "id=1"
            $.ajax({
                url:"getSizes.php",
                data:dataStr,
                cache:false,
                // the obj is the data returned from the server
                success:function(obj){
                    $("#sizeDD").html(obj);

                }

            });
        }));
        $("#addBtn").click(function(){
            var product = $("#proTxt").val();
            var quntity = $("#quantTxt").val();
            var perPiece = $("#pppTxt").val();
            var total = $("#totTxt").val();
            var cat = $("#catDD").find(":selected").text();
            var col = $("#colDD").find(":selected").text();
            var siz = $("#sizeDD").find(":selected").text();

            $("#myTable").append(
                "<tr>"  
                +"<td>"+product+"</td>"
                +"<td>"+cat+"</td>"
                +"<td>"+col+"</td>"
                +"<td>"+siz+"</td>"
                +"<td>"+quntity+"</td>"
                +"<td>"+perPiece+"</td>"
                +"<td>"+quntity*perPiece+"</td>"
                +"</tr>"
            );
            
        });
        
        // there a problem in this blur:
        // if I enter quantity = 1, price = 100, and then reEnter another quan
        // the total doesn't update
        $("#pppTxt").on('blur',(function(){
            var quant = $("#quantTxt").val();
            var ppp = $("#pppTxt").val();
            if (quant != "" && ppp != ""){
                var res = quant* ppp;
                $("#totTxt").val(res);
            }
        }));
    });
</script>