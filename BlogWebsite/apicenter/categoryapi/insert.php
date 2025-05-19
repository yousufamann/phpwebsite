<?php 
include('../../database.php');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['name'])) {
    
    $name = mysqli_real_escape_string($con, $data['name']);

    $sql = "INSERT INTO `category`(`catname`) VALUES ('$name')";

    if(mysqli_query($con, $sql)) {
        echo json_encode(array("status" => "inserted"));
    }
    else {
        echo json_encode(array("status" => "not inserted"));
    }

} 
else {
    echo json_encode(array("status" => "insert Api"));
}
?>
