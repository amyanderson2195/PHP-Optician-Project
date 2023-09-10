<!--
    NAME OF SCREEN:     Amend/View Stock Item (Front End)
    PURPOSE OF SCREEN:  Allows the user to amend/view a Stock item.
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
    <title>Amend/View a Stock Item</title>
    <script>
        // ask the user if they are sure they want to update the item
        function confirmAmend(){
            var response = confirm("Are you sure you want to make these changes?");
            if(response){
                // enable all fields
                document.getElementById("stockid").disabled = false;
                document.getElementById("description").disabled = false;
                document.getElementById("category").disabled = false;
                document.getElementById("costprice").disabled = false;
                document.getElementById("retailprice").disabled = false;
                document.getElementById("quantityinstock").disabled = false;
                document.getElementById("reorderquantity").disabled = false;
                document.getElementById("supplierlistbox").disabled = false;
                return true;
            }
            else{
                // keep details in fields
                populate();
                return false;
            }
        }

        // fill in the form information based on the stocklistbox
        function populate(){
            var sel = document.getElementById("stocklistbox");
            var result = sel.options[sel.selectedIndex].value;
            var details = result.split(',');

            // put the relevant contents into the form
            document.getElementById("stockid").value = details[0];
            document.getElementById("description").value = details[1];
            document.getElementById("category").value = details[2];
            document.getElementById("costprice").value = details[3];
            document.getElementById("retailprice").value = details[4];
            document.getElementById("quantityinstock").value = details[5];
            document.getElementById("reorderquantity").value = details[6];
            document.getElementById("supplierlistbox").value = details[7];
        }

        function toggleLock(){
            if(document.getElementById("amendViewButton").value == "Amend Details"){
                document.getElementById("description").disabled = false;
                document.getElementById("category").disabled = false;
                document.getElementById("costprice").disabled = false;
                document.getElementById("retailprice").disabled = false;
                document.getElementById("quantityinstock").disabled = false;
                document.getElementById("reorderquantity").disabled = false;
                document.getElementById("supplierlistbox").disabled = false;
                document.getElementById("amendViewButton").value = "View Details";
            }
            else{
                document.getElementById("description").disabled = true;
                document.getElementById("category").disabled = true;
                document.getElementById("costprice").disabled = true;
                document.getElementById("retailprice").disabled = true;
                document.getElementById("quantityinstock").disabled = true;
                document.getElementById("reorderquantity").disabled = true;
                document.getElementById("supplierlistbox").disabled = true;
                document.getElementById("amendViewButton").value = "Amend Details";
            }
        }

        // disable supplierlistbox when the page loads
        function disable(){
            document.getElementById("supplierlistbox").disabled = true;
        }
    </script>
</head>
<body onload="disable()"> <!-- disable supplierlistbox when the page loads -->
    <div class="container">
        <?php include "../sidebar.html" ?>
        <div id="content">
            <div class="main">
                <div id="top">
                    <h1>Amend/View a Stock Item</h1>
                </div>
                <form action="amendview.php" method="post" onsubmit="return confirmAmend()">
                    <div class="inputbox">
                        <label for="stocklistbox">Please select a Stock Item</label>
                        <?php include "stocklistbox.php" ?>
                    </div>
                    <div class="inputbox">
                        <label for="stockid">Stock Number</label>
                        <input type="text" name="stockid" id="stockid" placeholder="Stock Number" title="Stock Number" disabled>
                    </div>
                    <div class="inputbox">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" placeholder="Description" pattern="[^,]+" title="Commas are disallowed" disabled required>
                    </div>
                    <div class="inputbox">
                        <label for="category">Category</label><br>
                        <select name="category" id="category" disabled>
                            <option value="Frames">Frames</option>
                            <option value="Contact Lenses">Contact Lenses</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="inputbox">
                        <label for="costprice">Cost Price</label><br>
                        <input type="text" name="costprice" id="costprice" placeholder="Cost Price" pattern="[0-9]*\.[0-9]{2}" title="Must be a number with two decimal places" disabled required>
                    </div>
                    <div class="inputbox">
                        <label for="retailprice">Retail Price</label><br>
                        <input type="text" name="retailprice" id="retailprice" placeholder="Retail Price" pattern="[0-9]*\.[0-9]{2}" title="Must be a number with two decimal places" disabled required>
                    </div>
                    <div class="inputbox">
                        <label for="quantityinstock">Quantity in Stock</label><br>
                        <input type="number" name="quantityinstock" id="quantityinstock" placeholder="Quantity in Stock" title="Please enter the quantity in stock" min="0" disabled required>
                    </div>
                    <div class="inputbox">
                    <label for="reorderquantity">Reorder Quantity</label><br>
                        <input type="number" name="reorderquantity" id="reorderquantity" placeholder="Reorder Quantity" title="Please enter the reorder quantity" min="0" disabled required>
                    </div>
                    <div class="inputbox">
                        <label for="supplier">Supplier</label><br>
                        <?php include "supplierlistbox.php" ?>
                    </div>
                    <div class="buttons">
                        <input type="button" value="Amend Details" id="amendViewButton" onclick="toggleLock()">
                        <input type="submit" value="Save Changes">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>