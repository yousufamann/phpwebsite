<?php 
include('../../database.php');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['name']) && isset($data['email'])&& isset($data['image'])) {
    
    $id=$data['id'];
    $name = mysqli_real_escape_string($con, $data['name']);
    $email = mysqli_real_escape_string($con, $data['email']);
    $image= mysqli_real_escape_string($con, $data['image']);

    $sql = "UPDATE `users` SET `name`='$name',`email`='$email', `image`='$image' WHERE id='$id'";

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