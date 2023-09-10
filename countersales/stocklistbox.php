<!--
    NAME OF SCREEN:     Stock List Box (Counter Sales Version)
    PURPOSE OF SCREEN:  Allows the user to select items from the Stock table. Tailored specifically for the Counter Sales screen.
    STUDENT ID:         C00276123
    STUDENT NAME:       Amy Anderson
    DATE WRITTEN:       03/2023
-->
<?php
    include "../db.inc.php";

    // get all stock items that haven't been deleted
    $sql = "SELECT * FROM optician.stock WHERE category = 'Other' AND deleted = 0";
    if(!$result = mysqli_query($con, $sql)){
        die("Error in Querying Database: ".mysqli_error($con));
    }

    echo "<select name='stocklistbox' id='stocklistbox'>";

    // run through all stock items and add them as options
    while($row = mysqli_fetch_array($result)){
        $stockId = $row['stockId'];
        $description = $row['description'];
        $retailPrice = $row['retailPrice'];
        $quantityInStock = $row['quantityInStock'];
        // stitch table columns together
        $alltext = "$stockId,$description,$retailPrice,$quantityInStock";
        // is it out of stock?
        if($quantityInStock <= 0){
            $outOfStock = " title='This item is out of stock.' disabled";
            $description = "$description (Out of Stock)";
        }
        else{
            $outOfStock = " ";
        }
        echo "<option value='$alltext'$outOfStock>$description</option>";
    }
    echo "</select>";
    mysqli_close($con);
?>