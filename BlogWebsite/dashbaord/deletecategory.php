<?php
include('../database.php');
$id=$_GET['id'];
$sql=mysqli_query($con,"DELETE FROM `category` WHERE catid='$id'");
if($sql){
     echo "<script>alert('category deleted'); window.location.href='category.php';</script>";
}
else{
    echo'not deleted';
}
?>
