<?php 
include('../../database.php');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['userid']) && isset($data['postid']) && isset($data['comment_content'])) {
    
    $id=$data['id'];
    $uid=mysqli_real_escape_string($con, $data['userid']);
    $pid = mysqli_real_escape_string($con, $data['postid']);
    $cname = mysqli_real_escape_string($con, $data['comment_content']);

    $sql = "UPDATE `comment` SET `userid`='$uid',`postid`='$pid',`comment_content`='$cname' WHERE id='$id'";

    if(mysqli_query($con, $sql)) {
        echo json_encode(array("status" => "updated"));
    } else {
        echo json_encode(array("status" => "not updated"));
    }

} 
else {
    echo json_encode(array("status" => "Update Api"));
}
?>