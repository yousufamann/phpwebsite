<?php
include('../database.php');

if(isset($_POST['pid'])) {
    $pid = $_POST['pid'];
    
    $sql = "SELECT * FROM comment WHERE postid = $pid"; // Adjust table name and columns as needed
    $result = mysqli_query($con, $sql);
    
    if(!$result) {
        die("Database query failed: " . mysqli_error($con));
    }
    
    if(mysqli_num_rows($result) > 0) {
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered text-center">';
        echo '<thead class="table-primary text-center">';
        echo '<tr><th>CommentName</th></tr>';
        echo '</thead>';
        echo '<tbody>';
        
        while($comment = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>'.$comment['comment_content'].'</td>';
            echo '</tr>';
        }
        
        echo '</tbody></table></div>';
    } else {
        echo '<div class="alert alert-info">No comments found for this post.</div>';
    }
} else {
    echo '<div class="alert alert-warning">Invalid request.</div>';
}
?>