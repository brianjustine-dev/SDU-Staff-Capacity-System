<?php 
include ("db.php");

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $query = "DELETE FROM users WHERE id = $id";
    mysqli_query($conn, $query);
}
header("Location: staff.php");
exit();
?>
