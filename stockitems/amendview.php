<!--
    NAME OF SCREEN:     Amend/View Stock Item (Back End)
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
    <title>Amend/View a Stock Item</title>
</head>
<body>
    <div class="container">
        <?php include "../sidebar.html" ?>
        <div id="content">
            <div class="main">
                <div id="top">
                    <h1>Amend/View a Stock Item</h1>
                </div>
                <?php
                include "../db.inc.php";

                // UPDATE THE SELECTED ITEM
                $sql = "UPDATE optician.stock SET
                description = '$_POST[description]',
                category = '$_POST[category]',
                costPrice = '$_POST[costprice]',
                retailPrice = '$_POST[retailprice]',
                quantityInStock = '$_POST[quantityinstock]',
                reorderQuantity = '$_POST[reorderquantity]',
                supplierId = '$_POST[supplierlistbox]'
                WHERE stockId = '$_POST[stockid]'";
                if(!mysqli_query($con,$sql)){
                    die(mysqli_error($con));
                }
                // check that a change has occurred
                if(mysqli_affected_rows($con) != 0){
                    echo mysqli_affected_rows($con)." record(s) updated <br>";
                    echo "Stock Item ID ".$_POST['stockid'].", ".$_POST['description']." has been updated.";
                }
                else{
                    echo "No records were changed.";
                }

                echo "<form action='amendview.html.php' method='post'>
                <input type='submit' value='Return to Amend/View Page'>
                </form>";

                ?>
            </div>
        </div>
    </div>
</body>
</html>