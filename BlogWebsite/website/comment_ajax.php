
<?php
include('../database.php');

    $comment1 = $_POST['comment_post'];
    $uid1= $_POST['uid2'];
    $pid1 = $_POST['pid2'];


    
 $sql="INSERT INTO `comment`(`userid`, `postid`, `comment_content`)
  VALUES ('$uid1','$pid1','$comment1')";

  $query=mysqli_query($con,$sql);
  if($query){
    return true;
  }else{
    return false;
  }
    
 

?>
