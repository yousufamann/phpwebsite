<?php 
include('../../database.php');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['name']) && isset($data['description']) && isset($data['category'])&& isset($data['image'])) {
    
    $id=$data['id'];
    $name = mysqli_real_escape_string($con, $data['name']);
    $description = mysqli_real_escape_string($con, $data['description']);
    $category = mysqli_real_escape_string($con, $data['category']);
    $image= mysqli_real_escape_string($con, $data['image']);

    $sql = "UPDATE `post1` SET `name`='$name',`description`='$description',`category`='$category',`image`='$image' WHERE id='$id'";

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