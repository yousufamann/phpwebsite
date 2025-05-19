<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueSky</title>
    <link rel="icon" href="../dashbaord/uploads-images/logou.jpg" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="websiteAssets/style.css">
</head>

<body>
    <!-- Header/Navbar -->
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <div class="logo">
                    <i class="fas fa-blog"></i>
                    <span>BlueSky</span>
                </div>
                <?php
                include('../database.php');

                $sql = "SELECT * FROM `menus`";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                        <ul class="nav-links">
                            <?php if ($row['name'] == 'Home') {
                            ?>
                                <li><a href="home.php"><?php echo $row['name'];
                                                    } ?></a></li>
                                <?php if ($row['name'] == 'Categories') {
                                ?>
                                    <li><a href="category.php"><?php echo $row['name'];
                                                            } ?></a></li>
                                    <?php if ($row['name'] == 'About') {
                                    ?>
                                        <li><a href="about.php"><?php echo $row['name'];
                                                            } ?></a></li>
                                        <?php if ($row['name'] == 'Feedback') {
                                        ?>
                                            <li><a href="contact.php"><?php echo $row['name'];
                                                                    } ?></a></li>
                                            <?php if ($row['name'] == '') {
                                                echo 'no navigation br add';
                                            } ?>
                        </ul>
                <?php
                    }
                }
                ?>
                <form action="" method="post">
                    <div class="search-bar">
                        <input type="text" name="search_term" placeholder="Search posts...">
                        <button class="search-btn" type="submit" name="search_submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <?php
                include('../database.php');

                if (isset($_POST['search_submit'])) {
                    $search_term = mysqli_real_escape_string($con, $_POST['search_term']);
                    if (!empty($search_term)) {
                        header('location: search.php?search_term=' . urlencode($search_term));
                        exit;
                    } else {
                        echo "";
                    }
                }
                ?>
                <?php
                if (isset($_SESSION['status']) == 'Active') {
                   if($_SESSION['role']=='Admin'){
                     echo '<div class="auth-buttons">
                              <a href="../logout.php"><button class="btn login-btn">Logout</button></a>
                          </div>';
                           echo '<div class="auth-buttons">
                              <a href="../dashbaord/index.php"><button class="btn login-btn">Admin</button></a>
                          </div>';
                   }
                   else{
                        echo '<div class="auth-buttons">
                              <a href="../logout.php"><button class="btn login-btn">Logout</button></a>
                          </div>';
                        echo '<a href="apicenter.php"><button class="btn signup-btn" style="background-color: #1565c0;color: white;">Api Conter</button></a>
';
                   }
                } else {
                    echo '<div class="auth-buttons">
                              <a href="../login.php"><button class="btn login-btn">Login</button></a>
                              <a href="../register.php"><button class="btn signup-btn">Register</button></a>
                          </div>';
                }
                ?>
                <div class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>