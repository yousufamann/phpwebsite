<?php
include('../database.php');
$id=$_GET['id'];
$sql=mysqli_query($con,"DELETE FROM `carousel-data` WHERE id='$id'");
if($sql){
     echo "<script>alert('home deleted'); window.location.href='home.php';</script>";
}
else{
    echo'not deleted';
}
?>