<!--
    NAME OF SCREEN:     Counter Sales (Front End)
    PURPOSE OF SCREEN:  Allows the user to select what items they want to buy, and in what quantity.
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
    <link rel="stylesheet" type="text/css" href="/styles/countersales.css">
    <title>Counter Sales</title>
    <script>
        // array of active ids
        var activeids = [];

        // checks if a stockid is already selected
        function isActiveId(id){
            var active = false;
            for(var i = 0; i < activeids.length; i++){
                if(id == activeids[i]){
                    active = true;
                }
            }
            return active;
        }

        // ask user to confirm sale
        function confirmsale(){
            var response;
            response = confirm("Are you sure you want to finalise this sale?");
            if(response){
                // enable fields
                document.getElementById('totalsum').disabled = false;
                for(let i = 0; i < activeids.length; i++){
                    document.getElementById('desc'+activeids[i]).disabled = false;
                    document.getElementById('price'+activeids[i]).disabled = false;
                }
                return true;
            }
            else{
                return false;
            }
        }

        // add an item to the table when selected by user
        function additem(){
            var sel = document.getElementById("stocklistbox");
            var result = sel.options[sel.selectedIndex].value;
            result = result.split(",");

            var id = result[0];
            var desc = result[1];
            var price = result[2];
            var instock = result[3];

            // if the selected item isnt already in the table
            if(!isActiveId(result[0])){
                // save the stockid to the list of active ids
                activeids.push(result[0]);
                // create a row in the table
                var table = document.getElementById("saletable");
                var row = table.insertRow(activeids.length);
                // set row id in case we need to delete it later
                row.id = "row"+id;
                // create cells in the row
                var cell1 = row.insertCell();
                var cell2 = row.insertCell();
                var cell3 = row.insertCell();
                // populate cells
                cell1.innerHTML = "<input type='text' name='desc"+id+"' id='desc"+id+"' value='"+desc+"' disabled>";
                cell2.innerHTML = "<input type='number' name='qnt"+id+"' id='qnt"+id+"' title='Please enter the amount you would like to purchase' min='1' max='"+instock+"' value='1' onchange='calcprice("+id+", "+price+")'>";
                cell3.innerHTML = "&euro; <input type='number' name='price"+id+"' id='price"+id+"' disabled>";
                // update total price
                calcprice(id, price);
                // update id tracker
                document.getElementById("idtracker").value += id+",";
            }
            else{
                alert("You already have this item in your cart.");
            }
        }

        // calculate the price of an item based on quantity
        function calcprice(id, retailprice){
            var quantity = document.getElementById("qnt"+id).value;
            // calculate the price of the items and display at 2 decimal places
            document.getElementById("price"+id).disabled = false;
            document.getElementById("price"+id).value = (parseFloat(quantity) * parseFloat(retailprice)).toFixed(2);
            document.getElementById("price"+id).disabled = true;
            calcsum();
        }

        // calculate the total sum
        function calcsum(){
            var sum = parseFloat("00.00");
            for(let i = 0; i < activeids.length; i++){
                // run through all active ids and add up their prices
                sum += parseFloat(document.getElementById("price"+activeids[i]).value);
            }
            // update the total, display at 2 decimal places
            document.getElementById("totalsum").value = sum.toFixed(2);
        }
    </script>
</head>
<body>
    <div class="container">
        <?php include "../sidebar.html" ?>
        <div id="content">
            <div class="main">
                <div id="top">
                    <h1>Counter Sales</h1>
                </div>
                <!-- only submit form if user confirms sale -->
                <form action="countersales.php" method="post" onsubmit="confirmsale()">
                    <div>
                        <label for="stocklistbox">Select Items</label><br>
                        <?php include "stocklistbox.php" ?>
                        <input type="button" name="add" id="add" class="button" value="Add Item" onclick="additem()">
                    </div>
                    <table id="saletable">
                        <tr>
                            <th class="tablehead">Item Description</th>
                            <th class="tablehead">Quantity</th>
                            <th class="tablehead">Price</th>
                        </tr>
                        <tr>
                            <th colspan="2" class="totalprice">Total Price</th>
                            <td class="totalprice">&euro; <input type='number' name='totalsum' id='totalsum' value='00.00' disabled></td>
                        </tr>
                    </table>
                    <!-- hidden form field that keeps track of item ids that have been entered -->
                    <input type="text" name="idtracker" id="idtracker" title="Please select an item." hidden required>
                    <input type="submit" class="button" value="Finalise Sale">
                </form>
            </div>
        </div>
    </div>
</body>
</html>