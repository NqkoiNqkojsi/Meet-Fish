<?php
include "conn.php";
$sql="SELECT Pass, ID FROM customer";
$result = mysqli_query($conn, $sql);
$timeTarget = 0.05; // 50 milliseconds 
while($row = mysqli_fetch_assoc($result)) {
    $cost = 8;
    do {
        $cost++;
        $start = microtime(true);
        $pwd=password_hash($row["Pass"], PASSWORD_BCRYPT, ["cost" => $cost]);
        $end = microtime(true);
    } while (($end - $start) < $timeTarget);
    $sql = "UPDATE customer SET Pass='".$pwd."' WHERE ID=".$row["ID"];
    echo $sql."<br>";
    if (mysqli_query($conn, $sql)) {
        echo "Record #".$row["ID"]." updated successfully";
    } else {
        echo "Error updating record #".$row["ID"].": " . mysqli_error($conn);
    }
}
?>