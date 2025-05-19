<?php 
include('../../database.php');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['name']) && isset($data['description']) && isset($data['category']) && isset($data['image'])) {
    
    $name = mysqli_real_escape_string($con, $data['name']);
    $description = mysqli_real_escape_string($con, $data['description']);
    $category = mysqli_real_escape_string($con, $data['category']);
    $image = mysqli_real_escape_string($con, $data['image']);

    $sql = "INSERT INTO `post1`(`name`, `description`, `category`,`image`) VALUES ('$name','$description','$category','$image')";

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
