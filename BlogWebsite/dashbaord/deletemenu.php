<?php
include('../database.php');
$id=$_GET['id'];
$sql=mysqli_query($con,"DELETE FROM `menus` WHERE id='$id'");
if($sql){
     echo "<script>alert('menu deleted'); window.location.href='menu.php';</script>";
}
else{
    echo'not deleted';
}
?>