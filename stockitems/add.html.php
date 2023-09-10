<!--
    NAME OF SCREEN:     Add Stock Item (Front End)
    PURPOSE OF SCREEN:  Allows the user to add a Stock item.
    STUDENT ID:         C00276123
    STUDENT NAME:       Amy Anderson
    DATE WRITTEN:       03/2023
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <!-- use icons from fontawesome -->
    <script src="https://kit.fontawesome.com/e9ccd8bcf3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/styles/styles.css">
    <link rel="stylesheet" type="text/css" href="/styles/stockitems.css">
    <title>Add a Stock Item</title>
    <script>
        // ask the user if they are sure they want to add the item
        function confirmadd(){
            var response;
            response = confirm("Are you sure you want to add this item?");
            if(response){
                return true;
            }
            else{
                return false;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <?php include "../sidebar.html" ?>
        <div id="content">
            <div class="main">
                <div id="top">
                    <h1>Add a Stock Item</h1>
                </div>
                <!-- only submit form if user confirms add -->
                <form action="add.php" method="post" onsubmit="return confirmadd()">
                    <div class="inputbox">
                        <label for="description">Description</label><br>
                        <input type="text" name="description" id="description" placeholder="Description" pattern="[^,]+" title="Commas are disallowed" required>
                    </div>
                    <div class="inputbox">
                        <label for="category">Category</label><br>
                        <select name="category" id="category">
                            <option value="Frames">Frames</option>
                            <option value="Contact Lenses">Contact Lenses</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="inputbox">
                        <label for="costprice">Cost Price</label><br>
                        <input type="text" name="costprice" id="costprice" placeholder="Cost Price" pattern="[0-9]*\.[0-9]{2}" title="Must be a number with two decimal places" required>
                    </div>
                    <div class="inputbox">
                        <label for="retailprice">Retail Price</label><br>
                        <input type="text" name="retailprice" id="retailprice" placeholder="Retail Price" pattern="[0-9]*\.[0-9]{2}" title="Must be a number with two decimal places" required>
                    </div>
                    <div class="inputbox">
                        <label for="quantityinstock">Quantity in Stock</label><br>
                        <input type="number" name="quantityinstock" id="quantityinstock" placeholder="Quantity in Stock" title="Please enter the quantity in stock" min="0" required>
                    </div>
                    <div class="inputbox">
                        <label for="reorderquantity">Reorder Quantity</label><br>
                        <input type="number" name="reorderquantity" id="reorderquantity" placeholder="Reorder Quantity" title="Please enter the reorder quantity" min="0" required>
                    </div>
                    <div class="inputbox">
                        <label for="supplier">Supplier</label><br>
                        <?php include "supplierlistbox.php" ?>
                    </div>
                    <div class="buttons">
                        <input type="submit" name="submit" value="Submit">
                        <input type="reset" name="reset" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>