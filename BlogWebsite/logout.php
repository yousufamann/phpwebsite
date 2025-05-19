<?php
include('database.php');
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $q = mysqli_query($con, "UPDATE `users` SET `status`='InActive' WHERE `id`='$id'");
    if ($q) {
        session_unset();
        session_destroy();
         header('Location:website/home.php');
    } 
    else {
        echo "Failed to update status.";
    }
}
?>
