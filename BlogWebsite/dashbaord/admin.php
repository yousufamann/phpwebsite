<?php
include('../database.php');
$id=$_GET['id'];
$sql=mysqli_query($con,"UPDATE users SET role='Admin' WHERE id='$id'");
if($sql){
     echo "<script>alert('admin role updated'); window.location.href='user.php';</script>";
}
else{
    echo'not updated';
}
?>