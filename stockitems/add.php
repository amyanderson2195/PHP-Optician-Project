<!--
    NAME OF SCREEN:     Add Stock Item (Back End)
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
        <title>Add a Stock Item</title>
    </head>
    <body>
        <div class="container">
            <?php include "../sidebar.html" ?>
            <div id="content">
                <div class="main">
                    <div id="top">
                        <h1>Add a Stock Item</h1>
                    </div>
                    <?php
                    include "../db.inc.php";

                    // get the current content of the Stock table in descending order of stockId
                    $sql = "SELECT * FROM optician.stock ORDER BY stockId DESC";
                    if(!($result = mysqli_query($con, $sql))){
                        die("Error in SQL Query: ".mysqli_error($con));
                    }

                    if(($rowcount = mysqli_affected_rows($con)) == -1){ // returning -1 means there is an error. anything else is the number of rows
                        die("Error in SQL Query: ".mysqli_error($con));
                    }

                    // if the table is empty, use 1 as the stock id
                    if($rowcount == 0){
                        $stockid = 1;
                    }
                    else{ // otherwise, add one to the current highest stockId number
                        if(!($row = mysqli_fetch_array($result))){
                            die("Error in SQL Query: ".mysqli_error($con));
                        }

                        $stockid = $row['stockId'] + 1;
                    }

                    // ADD ITEM TO STOCK TABLE
                    $sql = "INSERT INTO optician.stock (stockId,description,category,costPrice,retailPrice,quantityInStock,reorderQuantity,supplierId,deleted) VALUES ('$stockid','$_POST[description]','$_POST[category]','$_POST[costprice]','$_POST[retailprice]','$_POST[quantityinstock]','$_POST[reorderquantity]','$_POST[supplierlistbox]',0)";
                    if(!mysqli_query($con, $sql)){
                        die("Error in SQL Query: ".mysqli_error($con));
                    }

                    echo "<br>Record added.<br>";
                    echo
                    "Stock ID: ".$stockid."<br>
                    Description: ".$_POST['description']."<br>
                    Category: ".$_POST['category']."<br>
                    Cost Price: ".$_POST['costprice']."<br>
                    Retail Price: ".$_POST['retailprice']."<br>
                    Quantity in Stock: ".$_POST['quantityinstock']."<br>
                    Reorder Quantity: ".$_POST['reorderquantity']."<br>
                    Supplier ID: ".$_POST['supplierlistbox'];

                    mysqli_close($con);

                    ?>

                    <form action="add.html.php" method="post">
                        <br>
                        <input type="submit" value="Add Another Stock Item">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>