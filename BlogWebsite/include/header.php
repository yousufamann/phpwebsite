<?php
include('../database.php');
session_start();
$role = $_SESSION['role'];
if (!isset($_SESSION['id'])) {
    header('Location:../login.php');
} else {
    if ($role == 'User') {
        header('Location:../website/home.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashboardBlueSky</title>
    <link rel="icon" href="uploads-images/logou.jpg" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../dashboard/adminAssets/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <div class="overlay"></div>

    <div class="dashboard">
        <?php
        require_once '../include/sidebar.php';
        ?>

        <div class="main-content">
            <nav class="top-nav">
                <div class="container">
                    <div class="nav-content">
                        <div class="mobile-menu-btn">
                            <i class="fas fa-bars"></i>
                        </div>
                        <div class="search-bar">
                            <input type="text" placeholder="Search...">
                            <button><i class="fas fa-search"></i></button>
                        </div>
                        <div class="user-menu">
                            <div class="notification-icon">
                                <i class="fas fa-bell"></i>
                                <span class="notification-badge">3</span>
                            </div>
                            <div class="user-profile">
                                <?php
                                $user_id = $_SESSION['id'];
                                $sql = "SELECT * FROM `users` WHERE id = '$user_id'";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result)) {
                                    $row = mysqli_fetch_assoc($result);
                                    $image_path = !empty($row['image']) ? "../uploads-profileimage/" . $row['image'] : "../uploads-profileimage/default.jpg";
                                ?>
                                    <img src="<?php echo $image_path; ?>" alt="User" class="user-avatar">
                                    <span class="user-name"><?php echo $_SESSION['role']; ?></span>
                                    <div class="user-dropdown">
                                        <div class="dropdown-header">
                                            <img src="<?php echo $image_path; ?>" alt="User" class="user-avatar">
                                            <div class="user-info">
                                                <div class="name"><?php echo $_SESSION['name']; ?></div>
                                                <div class="email"><?php echo $_SESSION['email']; ?></div>
                                                <?php 
                                               
                                                
                                                if (isset($row['status']) && $row['status'] == 'Active') { 
                                                ?>
                                                    <div style="color: #4CAF50; font-size: 13px; display: flex; align-items: center; margin-top: 5px;">
                                                        <span style="display: inline-block; width: 8px; height: 8px; background-color: #4CAF50; border-radius: 50%; margin-right: 6px; animation: pulse 1.5s infinite;"></span>
                                                        Online
                                                    </div>
                                                    <style>
                                                        @keyframes pulse {
                                                            0% {
                                                                transform: scale(0.95);
                                                                box-shadow: 0 0 0 0 rgba(76, 175, 80, 0.7);
                                                            }
                                                            70% {
                                                                transform: scale(1);
                                                                box-shadow: 0 0 0 7px rgba(76, 175, 80, 0);
                                                            }
                                                            100% {
                                                                transform: scale(0.95);
                                                                box-shadow: 0 0 0 0 rgba(76, 175, 80, 0);
                                                            }
                                                        }
                                                    </style>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <a href="profile.php" class="dropdown-item">
                                            <i class="fas fa-user"></i>
                                            <span>My Profile</span>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a href="../logout.php" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span>Logout</span>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>