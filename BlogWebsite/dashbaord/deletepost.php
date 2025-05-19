<?php
include('../database.php');
$id=$_GET['id'];
$sql=mysqli_query($con,"DELETE FROM `post1` WHERE id='$id'");
if($sql){
     echo "<script>alert('post deleted'); window.location.href='post.php';</script>";
}
else{
    echo'not deleted';
}
?>