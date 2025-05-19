<?php
include('../database.php');
$id=$_GET['id'];
$sql=mysqli_query($con,"DELETE FROM `about` WHERE id='$id'");
if($sql){
     echo "<script>alert('about deleted'); window.location.href='about.php';</script>";
}
else{
    echo'not deleted';
}
?>