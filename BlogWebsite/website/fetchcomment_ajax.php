<?php
include('../database.php');
$pid = $_POST['pid'];
$sq = "SELECT users.name,comment.comment_content From users INNER JOIN comment ON users.id = comment.userid WHERE comment.postid = '$pid'";
$result = mysqli_query($con, $sq);
$row = '';
if (mysqli_num_rows($result) > 0) {
  foreach ($result as $r) {
    echo '<tr style="border-bottom: 1px solid #ddd;">
                      <td style="padding: 12px;  border-right: 1px">' . $r['name'] . '</td>
                    <td style="padding: 12px;  border-right: 1px">' . $r['comment_content'] . '</td>
                  </tr>';
  }
} else {
  echo '<tr style="border-bottom: 1px solid #ddd;">
  <td style="padding: 12px; border-right: 1px solid #ddd;">NO COMMENT YET</td>

</tr>';
}
