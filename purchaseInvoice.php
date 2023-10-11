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
    <h2 class="text-center bg-light m-2">Purchase Invoice</h2>
    <hr class="mt-0">
    <div class="container">
        <form action="" method="">
            <div class="row">
                <div class="col-4">
                    <label for="">Date</label>
                    <input type="date" name="datePicker" class="form-control form-control-sm">
                </div>
                <div class="col-4">
                    <label for="">Supplier</label>
                    <?php getList("st_getSuppliers", "suppDD", $con);   ?>
                </div>
                
                <div class="col-4">
                    <label for="">Categories</label>
                    <?php getList("st_getCategories()", "catDD", $con);   ?>
                </div>
                <div class="col-4">
                    <label for="">Sizes</label>
                    <select class="form-control form-control-sm" id="sizeDD">  
                        
                    </select>
                </div>
                    
                <div class="col-4">
                    <label for="">Colors</label>
                    <?php getList("st_getColors()", "colDD", $con);   ?>
                </div>
                <div class="col-4">
                    <label for="">Product</label>
                    <?php getList("st_getProducts()", "proDD", $con);   ?>
                </div>
                <div class="col-4">
                    <label for="">Quantity</label>
                    <input type="text"   name="quantTxt" id="quantTxt" class="form-control form-control-sm">
                </div>
                <div class="col-4">
                    <label for="">Per Piece Price</label>
                    <input type="text"   name="pppTxt"   id="pppTxt"   class="form-control form-control-sm">
                </div>
                <div class="col-4">
                    <label for="">Product Total</label>
                    <input type="text"   name="totTxt"   id="totTxt"   class="form-control form-control-sm" disabled>
                </div>
                <div class="">
                    <input type="button" name="addBtn"   id="addBtn"   class="btn btn-outline-info btn-sm mt-3 col-8 offset-2" value="Add Item">
                </div>
                <div class="">
                    <label for="" id="errorLabel" class="alert alert-danger col-6 offset-3 mt-2">Please Enter all Fields</label>
                </div>
            <table class="table table-borderless table-hover table-striped m-2" id="myTable">
                <thead>
                    <th>#</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Actions</th>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8" class="text-center"><label for="" class="display-2" id="grandLabel">00.00</label></td>
                    </tr>
                </tfoot>
            </table>
                

            </div>
        </form>
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        $("#errorLabel").hide();
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
        var count = 0;
        var grandTotal = 0;
        $("#addBtn").click(function(){
            var product = $("#proDD").find(":selected").text();
            var quntity = $("#quantTxt").val();
            var perPiece = $("#pppTxt").val();
            var total = $("#totTxt").val();
            var cat = $("#catDD").find(":selected").text();
            var col = $("#colDD").find(":selected").text();
            var siz = $("#sizeDD").find(":selected").text();
            var blankCount = 0;

            blankCount += product ==""?blankCount+1:0;
            blankCount += quntity ==""?blankCount+1:0;
            blankCount += perPiece ==""?blankCount+1:0;
            blankCount += total ==""?blankCount+1:0;
            blankCount += cat ==""?blankCount+1:0;
            blankCount += siz ==""?blankCount+1:0;
            
            if (blankCount > 0){
                $("#errorLabel").show(500);
            } 
            else if (blankCount == 0){
                count = count + 1;
                grandTotal += (quntity * perPiece);

                $("#myTable").append(
                    "<tr>"  
                        +"<td>"+count+"</td>"
                        +"<td>"+product+"</td>"
                        +"<td>"+cat+"</td>"
                        +"<td>"+col+"</td>"
                        +"<td>"+siz+"</td>"
                        +"<td>"+quntity+"</td>"
                        +"<td>"+perPiece+"</td>"
                        +"<td id='totalTD'>"+quntity*perPiece+"</td>"
                        +"<td><input type='button' class='btn btn-outline-info btn-sm' value='REMOVE' id='removeBtn'/></td>"
                    +"</tr>"
                        
                        
                );
                $("#errorLabel").hide(500);
                $("#grandLabel").text(grandTotal);

                $("#proTxt").val("");
                $("#quantTxt").val("");
                $("#pppTxt").val("");
                $("#totTxt").val("");
                $("#catDD").val(-1);
                $("#colDD").val(-1);
                $("#sizeDD").val(-1);
                
                // -1 here referes to the value of "Choose..." that appears in ther first select
                // of the dropDown
            }

            
        });
       $(document).on('click', '#removeBtn', function(){
        var totalTD = $("#totalTD").html();
        grandTotal -= totalTD;
        $("#grandLabel").text(grandTotal);
        $(this).closest("tr").remove();

       })
        
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