<!--
    NAME OF SCREEN:     Stock List Box (Stock Items Version)
    PURPOSE OF SCREEN:  Allows the user to select items from the Stock table. Tailored specifically for the Stock Items screens.
    STUDENT ID:         C00276123
    STUDENT NAME:       Amy Anderson
    DATE WRITTEN:       03/2023
-->
<?php
    include "../db.inc.php";

    // get all stock items that haven't been deleted
    $sql = "SELECT * FROM optician.stock WHERE deleted = 0";
    if(!$result = mysqli_query($con, $sql)){
        die("Error in Querying Database: ".mysqli_error($con));
    }

    echo "<select name='stocklistbox' id='stocklistbox' onclick='populate()'>";

    // run through all stock items and add them as options
    while($row = mysqli_fetch_array($result)){
        $stockId = $row['stockId'];
        $description = $row['description'];
        $category = $row['category'];
        $costPrice = $row['costPrice'];
        $retailPrice = $row['retailPrice'];
        $quantityInStock = $row['quantityInStock'];
        $reorderQuantity = $row['reorderQuantity'];
        $supplierId = $row['supplierId'];
        // stitch table columns together
        $alltext = "$stockId,$description,$category,$costPrice,$retailPrice,$quantityInStock,$reorderQuantity,$supplierId";
        echo "<option value='$alltext'>$description</option>";
    }
    echo "</select>";
    mysqli_close($con);
?>