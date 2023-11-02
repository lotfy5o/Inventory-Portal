<?php include "loadList.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Invoice</title>
    <link rel="stylesheet" href="Styles/bootstrap.min.css">
    <link rel="stylesheet" href="Styles/alert.css">
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
                    <input type="date" id="datePicker" name="datePicker" class="form-control form-control-sm">
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
                    <label for="">Colors</label>
                    <?php getList("st_getColors()", "colDD", $con);   ?>
                </div>
                <div class="col-4">
                    <label for="">Sizes</label>
                    <select class="form-control form-control-sm" id="sizeDD">  
                        
                    </select>
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
                <div class="col-8 offset-2">
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
            <div class="col-8 offset-2">
                <input type="button" name="saveBtn"   id="saveBtn"   class="btn btn-outline-info btn-sm mt-3 col-8 offset-2" value="Save">
            </div>
            <div class="col-6 offset-3">
              <label for="" id="resLabel" class="alert alert-info text-center container"></label>
            </div>
                

            </div>
        </form>
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        $("#errorLabel").hide();
        $("#resLabel").hide();
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
    var proID = $("#proDD").find(":selected").val();
    var catID = $("#catDD").find(":selected").val();
    var colID = $("#colDD").find(":selected").val();
    var sizID = $("#sizeDD").find(":selected").val();
    var flag = 0;
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

        $("#errorLabel").hide(500);

    //////////////////////////////////////////////////////////////////////////////////////////////////
        // check if there is an exact match for the entered product
        $("#myTable tbody tr").each(function(){
            if (
                $(this).find("td").eq(1).text() == proID &&
                $(this).find("td").eq(3).text() == catID &&
                $(this).find("td").eq(5).text() == colID &&
                $(this).find("td").eq(7).text() == sizID
            ){
                flag = 1;
                // update the quantity and price per piece in the existing row
                $(this).find("td").eq(9).text(quntity);
                $(this).find("td").eq(10).text(perPiece);
                var newQuan = $(this).find("td").eq(9).text();
                var newPrice = $(this).find("td").eq(10).text();
                var newTotal = newQuan * newPrice;
                var oldTotal = $(this).find("td").eq(11).text();
                var diff = newTotal - oldTotal;


                // update the same exact product in the same row
                $(this).find("td").eq(11).text(newTotal);


                grandTotal += diff;
                $("#grandLabel").text(grandTotal);
             
            }
            
        });

        // when I do this block of code the append stops
    //     /////////////////////////////////////////////////////////////////////////////////////////////////////////
    //     var newGrand = 0;
    //     $("#myTable tbody tr").each(function(){
    //         newGrand += parseFloat($(this).find("td".eq(11).text()));
    //     });
    //     $("grandLabel").text(newGrand);
    // /////////////////////////////////////////////////////////////////////////////////////////////////////////


        


        // if there is no exact match, add a new row
        if (flag == 0){
            count = count + 1;
            grandTotal += (quntity * perPiece);

            $("#myTable").append(
                "<tr>"  
                    +"<td>"+count+"</td>"
                    +"<td hidden>"+proID+"</td>" // I hid it so it won't appear to the user, and also to be able to fetch it
                    +"<td>"+product+"</td>"
                    +"<td hidden>"+catID+"</td>"
                    +"<td>"+cat+"</td>"
                    +"<td hidden>"+colID+"</td>"
                    +"<td>"+col+"</td>"
                    +"<td hidden>"+sizID+"</td>"
                    +"<td>"+siz+"</td>"
                    +"<td>"+quntity+"</td>"
                    +"<td>"+perPiece+"</td>"
                    +"<td id='totalTD'>"+quntity*perPiece+"</td>"
                    +"<td><input type='button' class='btn btn-outline-info btn-sm' value='REMOVE' id='removeBtn'/></td>"
                +"</tr>"
            );
            $("#errorLabel").hide(500);
            $("#grandLabel").text(grandTotal);
    }}
});

       $(document).on('click', '#removeBtn', function(){
        
        // this line was => totalTD = $("#totalTD").html(); 
        // incorrect because it uses a static ID selector (#totalTD) to target the total cell in the table. 
        // In an HTML document, each element should have a unique ID within the page, 
        // and the #totalTD selector will always target the first element with that ID. 
        // This is problematic because when you have multiple rows in your table, 
        // each with a total cell, you need to be able to identify the specific cell you want to update or remove.
        var totalTD = $(this).closest('tr').find('[id^="totalTD"]').text();
        grandTotal -= parseFloat(totalTD);
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

        $("#saveBtn").click(function(){
            //////////////////// Purchase Invoice Code ///////////////
            var purchaseArray = [];
            // I picked up the date and the supplier cuz that's the columns of the purchaseInvoice table 
            purchaseArray.push($("#datePicker").val());
            purchaseArray.push($("#suppDD").val());

            /////////////////// Purchase Invoice Details Code ///////////////////
            var purchaseDetails = [];
            $("#myTable tbody tr").each(function(){
                // he talked about multidimension array on 24:00 lec 25
                // 1 => he didn't have the pid_purID of table purchseInvoiceDetails so he wrote anynumber
                // eq(1) => proID => its position inside myTable is the at index 1
                // eq(10) => perPiece, we entered perPiece after the proID cuz that's the next column inside the table of purchaseInvoiceDetials
                purchaseDetails.push([ // get the IDs of the rows of the table myTable and put inside an array
                    // 1, // pid_purID this 1 was added until we get the real data => see the insert.php => $purID
                    $(this).find("td").eq(1).text(),  // pid_proID
                    // (this) represent the current row => ("#myTable tbody ((tr))")
                    // eq(1) represent the first td that shows up, while eq(10) is the tenth td in the table 
                    $(this).find("td").eq(10).text(), // pid_perPiecePrice
                    $(this).find("td").eq(9).text(),  // pid_quantity
                    $(this).find("td").eq(3).text(),  // pid_catID
                    $(this).find("td").eq(7).text(),  // pid_sizeID
                    $(this).find("td").eq(5).text()   // pid_colID
                ]);

            });


            $.ajax({
                url:"insert.php",
                type:"POST",
                data:{purchaseArray:purchaseArray, purchaseDetails:purchaseDetails},
                success:function(obj){
                    $("#resLabel").show(500);
                    $("#resLabel").html(obj);
                }
            });
        });
    });
</script>