<?php 
include('../../database.php');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['name'])) {
    
    $id=$data['id'];
    $name = mysqli_real_escape_string($con, $data['name']);

    $sql = "UPDATE `category` SET `name`='$name' WHERE id='$id'";

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