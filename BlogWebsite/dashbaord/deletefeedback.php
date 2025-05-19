<?php
include('../database.php');
$id=$_GET['id'];
$sql=mysqli_query($con,"DELETE FROM `feedback` WHERE id='$id'");
if($sql){
     echo "<script>alert('feedback deleted'); window.location.href='feedback.php';</script>";
}
else{
    echo'not deleted';
}
?>