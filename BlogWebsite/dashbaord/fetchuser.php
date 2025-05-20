<?php
include('../database.php');
$id=$_GET['id'];
$sql=mysqli_query($con,"UPDATE users SET role='User' WHERE id='$id'");
if($sql){
     echo "<script>alert('user  role updated'); window.location.href='user.php';</script>";
}
else{
    echo'not updated';
}
?>