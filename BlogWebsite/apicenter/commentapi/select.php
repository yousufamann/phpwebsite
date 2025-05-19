<?php
include('../../database.php');
header('Content-Type:Application/json');

$sql="SELECT * FROM `comment`";
$query=mysqli_query($con,$sql);
if(mysqli_num_rows($query)>0){
    $q=mysqli_fetch_all($query,MYSQLI_ASSOC);
    echo json_encode($q);
}
else{
    echo json_encode(array("status" => "no record found"));
}

?>