<!--
    NAME OF SCREEN:     Supplier List Box
    PURPOSE OF SCREEN:  Allows the user to select items from the Supplier table.
    STUDENT ID:         C00276123
    STUDENT NAME:       Amy Anderson
    DATE WRITTEN:       03/2023
-->
<?php
    include "../db.inc.php";

    // get all suppliers that haven't been deleted
    $sql = "SELECT supplierId, name FROM optician.supplier WHERE deleted = 0";
    if(!$result = mysqli_query($con, $sql)){
        die("Error in Querying Database: ".mysqli_error($con));
    }

    // allow the user to select no supplier
    echo "<select name='supplierlistbox' id='supplierlistbox'>
    <option value='0'>No Supplier</option>";

    // run through all suppliers and add them as options
    while($row = mysqli_fetch_array($result)){
        $supplierId = $row['supplierId'];
        $name = $row['name'];
        echo "<option value='$supplierId'>$name</option>";
    }
    echo "</select>";
    mysqli_close($con);
?>