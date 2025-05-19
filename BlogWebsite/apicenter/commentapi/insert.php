<?php 
include('../../database.php');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['userid']) && isset($data['postid']) && isset($data['comment_content']) ) {
     
     $uid = mysqli_real_escape_string($con, $data['id']);
      $pid = mysqli_real_escape_string($con, $data['id']);     

    $cname = mysqli_real_escape_string($con, $data['comment_content']);

    $sql = "INSERT INTO `comment`(`userid`, `postid`, `comment_content`) VALUES ('$uid','$pid','$cname')";

    if(mysqli_query($con, $sql)) {
        echo json_encode(array("status" => "inserted"));
    } else {
        echo json_encode(array("status" => "not inserted"));
    }

} 
else {
    echo json_encode(array("status" => "insert Api"));
}
?>
