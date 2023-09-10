<!--
    NAME OF SCREEN:     Delete Stock Item (Back End)
    PURPOSE OF SCREEN:  Allows the user to delete a Stock item.
    STUDENT ID:         C00276123
    STUDENT NAME:       Amy Anderson
    DATE WRITTEN:       03/2023
-->
<?php
    session_start();
    include "../db.inc.php";

    // FIND ITEMS THAT ARE CURRENTLY ON ORDER
    $sql = "SELECT * FROM optician.order INNER JOIN optician.order_item ON 'order'.orderId = order_item.orderId WHERE order_item.stockId = '$_POST[stockid]' AND delivered = 0";
    if(!($result = mysqli_query($con, $sql))){
        die("Error in Querying Database: ".mysqli_error($con));
    }
    if(($rowcount = mysqli_affected_rows(£con)) == -1){ // returning -1 means there is an error. anything else is the number of rows
        die("Error in SQL Query: ".mysqli_error($con));
    }

    // if the selected item has no active orders
    if($rowcount == 0){
        // DELETE ITEM
        $sql = "UPDATE optician.stock SET deleted = true WHERE stockId = '$_POST[stockid]'";
        if(!($result = mysqli_query($con, $sql))){
            die("Error in Querying Database: ".mysqli_error($con));
        }

        // update session variables
        $_SESSION['stockid'] = $_POST['stockid'];
        $_SESSION['description'] = $_POST['description'];
    }
    else{ // otherwise, do not delete
        $_SESSION['undelivered'] = true;
    }

    mysqli_close($con);
?>

<script>
    // go back to the main delete page
    window.location.assign("delete.html.php");
</script>