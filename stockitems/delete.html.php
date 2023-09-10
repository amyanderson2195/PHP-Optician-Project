<!--
    NAME OF SCREEN:     Delete Stock Item (Front End)
    PURPOSE OF SCREEN:  Allows the user to delete a Stock item.
    STUDENT ID:         C00276123
    STUDENT NAME:       Amy Anderson
    DATE WRITTEN:       03/2023
-->
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <!-- use icons from fontawesome -->
    <script src="https://kit.fontawesome.com/e9ccd8bcf3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/styles/styles.css">
    <link rel="stylesheet" type="text/css" href="/styles/stockitems.css">
    <title>Delete a Stock Item</title>
    <script>
        // check that the item is not in stock
        function notinstock(){
            var sel = document.getElementById("stocklistbox");
            var result = sel.options[sel.selectedIndex].value;
            var details = result.split(',');

            // if quantityinstock is greater than zero
            if(details[5] > 0){
                alert("You cannot delete an item that is currently in stock.");
                return false;
            }
            else{
                return confirmdelete();
            }
        }

        // ask the user if they are sure they want to delete the item
        function confirmdelete(){
            var response;
            response = confirm("Are you sure you want to delete this item?");
            if(response){
                // enable all fields
                document.getElementById("stockid").disabled = false;
                document.getElementById("description").disabled = false;
                document.getElementById("costprice").disabled = false;
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
            document.getElementById("costprice").value = details[3];
            document.getElementById("supplierlistbox").value = details[7];
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
                    <h1>Delete a Stock Item</h1>
                </div>
                <!-- only submit the form if not in stock and user confirms deletion -->
                <form action="delete.php" method="post" onsubmit="return notinstock()">
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
                        <input type="text" name="description" id="description" placeholder="Description" title="Stock Item Description" disabled>
                    </div>
                    <div class="inputbox">
                        <label for="costprice">Cost Price</label>
                        <input type="number" name="costprice" id="costprice" placeholder="Cost Price" title="Stock Item Cost Price" disabled>
                    </div>
                    <div class="inputbox">
                        <label for="supplierlistbox">Supplier</label>
                        <?php include "supplierlistbox.php" ?>
                    </div>
                    <div class="buttons">
                        <input type="submit" value="Delete Selected Item">
                    </div>
                </form>
                <?php
                    // display deletion message if we've set session variables in delete.php
                    if(ISSET($_SESSION['stockid'])){
                        echo "<h1>Record ".$_SESSION['stockid'].": ".$_SESSION['description']." has been deleted.</h1>";
                    }

                    if(ISSET($_SESSION['undelivered'])){
                        echo "<h1 style='color: red'>Item not deleted: There are outstanding orders.</h1>";
                    }
                    session_destroy();
                ?>
            </div>
        </div>
    </div>
</body>
</html>