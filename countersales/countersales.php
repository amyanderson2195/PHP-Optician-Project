<!--
    NAME OF SCREEN:     Counter Sales (Back End)
    PURPOSE OF SCREEN:  Processes information given by the user and updates the Sale, Stock and Sales Item tables.
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
    <title>Counter Sales</title>
</head>
<body>
    <div class="container">
        <?php include "../sidebar.html" ?>
        <div id="content">
            <div class="main">
                <div id="top">
                    <h1>Counter Sales</h1>
                </div>
                <?php
                    include "../db.inc.php";
                    date_default_timezone_set("UTC");
                    $date = (date("Y-m-d"));

                    // GENERATE PRIMARY KEY FOR SALE TABLE
                    $sql = "SELECT * FROM optician.sale ORDER BY saleId DESC";
                    if(!($result = mysqli_query($con, $sql))){
                        die("Error in SQL Query: ".mysqli_error($con));
                    }
                    if(($rowcount = mysqli_affected_rows($con)) == -1){ // returning -1 means there is an error, anything else is the number of rows
                        die("Error in SQL Query: ".mysqli_error($con));
                    }
                    if($rowcount == 0){
                        $saleid = 1;
                    }
                    else{
                        if(!($row = mysqli_fetch_array($result))){
                            die("Error in SQL Query: ".mysqli_error($con));
                        }
                        $saleid = $row['saleId'] + 1;
                    }

                    // ADD ENTRY TO SALE TABLE
                    $sql = "INSERT INTO optician.sale (saleId, date, totalCost) VALUES ('$saleid', '$date', '$_POST[totalsum]')";
                    if(!($result = mysqli_query($con, $sql))){
                        die("Error in SQL Query: ".mysqli_error($con));
                    }

                    $itemids = explode(',', $_POST['idtracker']);

                    // variable used to build the table that appears on this page
                    $stocktable ="
                    <table>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>";
                    // loop through each of the ids
                    for($i = 0; $i < (count($itemids)-1); $i++){
                        // get the quantity in stock of the current item
                        $sql = "SELECT quantityInStock FROM optician.stock WHERE stockId = '$itemids[$i]'";

                        if(!($result = mysqli_query($con, $sql))){
                            die("Error in SQL Query: ".mysqli_error($con));
                        }
                        if(!($row = mysqli_fetch_array($result))){
                            die("Error in SQL Query: ".mysqli_error($con));
                        }

                        // subtract purchased quantity from quantity in stock
                        $quantitypurchased = $_POST['qnt'.$itemids[$i]];
                        $newquantity = $row['quantityInStock'] - $quantitypurchased;

                        // UPDATE STOCK TABLE
                        $sql = "UPDATE optician.stock SET quantityInStock = $newquantity WHERE stockId = ".$itemids[$i];
                        if(!($result = mysqli_query($con, $sql))){
                            die("Error in SQL Query: ".mysqli_error($con));
                        }
                        // ADD ENTRY INTO SALES ITEM TABLE
                        $sql = "INSERT INTO optician.sales_item (salesId, stockId, quantity) VALUES ('$saleid', '$itemids[$i]', '$quantitypurchased')";
                        if(!($result = mysqli_query($con, $sql))){
                            die("Error in SQL Query: ".mysqli_error($con));
                        }

                        // add details to output, to echo once we're done
                        $stocktable .= "
                            <tr>
                                <td>".$_POST['desc'.$itemids[$i]]."</td>
                                <td>$quantitypurchased</td>
                                <td>&euro;".$_POST['price'.$itemids[$i]]."</td>
                            </tr>";
                    }

                    // add total sum to output
                    $stocktable .= "
                        <tr>
                            <th colspan='2'>Total Price</th>
                            <td>&euro;".$_POST['totalsum']."</td>
                        </tr>
                    </table>";

                    echo "<br>Sale successful.<br>";

                    // display the output
                    echo "Sale ID: ".$saleid."<br>".$stocktable;
                    mysqli_close($con);
                ?>

                <!-- allow the user to return to the form -->
                <form action="countersales.html.php" method="post">
                    <br>
                    <input type="submit" value="Make Another Sale">
                </form>
            </div>
        </div>
    </div>
</body>
</html>