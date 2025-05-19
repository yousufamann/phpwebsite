<?php
include('../database.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['id'])) {
        if (isset($_POST['insert'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            $sql = "INSERT INTO `feedback`(`name`, `email`, `message`) VALUES ('$name','$email','$message')";
            $query = mysqli_query($con, $sql);

            if ($query) {
                $login_success = 'User feedback submitted!';
            }
            else {
                $login_error = 'no submiited the feedback!';
            }
        } 
        else {
            $login_error = 'Please submit your feedback!';
        }
    }
    else {
        $login_error = 'Please login First!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueSky</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Global Styles */
        :root {
            --primary-color: #1e88e5;
            --primary-dark: #1565c0;
            --primary-light: #42a5f5;
            --white: #ffffff;
            --light-gray: #f5f5f5;
            --medium-gray: #e0e0e0;
            --dark-gray: #757575;
            --black: #212121;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--black);
            background-color: var(--white);
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        /* Header Styles */
        .header {
            background-color: var(--white);
            box-shadow: var(--shadow);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            color: var(--primary-dark);
        }

        .logo i {
            margin-right: 10px;
            color: var(--primary-color);
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin-left: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--black);
            font-weight: 500;
            transition: var(--transition);
            position: relative;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--primary-color);
        }

        .nav-links a.active:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--primary-color);
        }

        .auth-buttons .login-btn {
            background: transparent;
            color: var(--primary-color);
            margin-right: 10px;
            border: 1px solid var(--primary-color);
        }

        .auth-buttons .signup-btn {
            background: var(--primary-color);
            color: var(--white);
        }

        .mobile-menu-btn {
            display: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--primary-color);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
            color: var(--white);
            padding: 150px 0 100px;
            text-align: center;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
            margin-bottom: 50px;
        }

        .hero-title {
            font-size: 48px;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease;
        }

        .hero-subtitle {
            font-size: 20px;
            margin-bottom: 30px;
            animation: fadeInDown 1s ease 0.2s both;
        }

        .search-bar {
            max-width: 600px;
            margin: 0 auto;
            display: flex;
            animation: fadeInUp 1s ease 0.4s both;
        }

        .search-bar input {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 4px 0 0 4px;
            font-size: 16px;
        }

        .search-bar .search-btn {
            background: var(--primary-dark);
            color: var(--white);
            border: none;
            padding: 0 20px;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }

        /* Section Styles */
        .section-title {
            font-size: 32px;
            margin-bottom: 30px;
            color: var(--primary-dark);
            position: relative;
            display: inline-block;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .view-all {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .view-all:hover {
            text-decoration: underline;
        }

        /* Posts Grid */
        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .post-card {
            background: var(--white);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            animation: fadeIn 0.5s ease;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .post-card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .post-card-content {
            padding: 20px;
        }

        .post-card-category {
            display: inline-block;
            background: var(--primary-light);
            color: var(--white);
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .post-card-title {
            font-size: 20px;
            margin-bottom: 10px;
            color: var(--black);
        }

        .post-card-excerpt {
            color: var(--dark-gray);
            margin-bottom: 15px;
            font-size: 14px;
        }

        .post-card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: var(--dark-gray);
        }

        .post-card-author {
            display: flex;
            align-items: center;
        }

        .post-card-author img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        /* Categories Grid */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 50px;
        }

        .category-card {
            background: var(--white);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
            cursor: pointer;
        }

        .category-card.active {
            background: var(--primary-color);
            color: var(--white);
            transform: translateY(-5px);
        }

        .category-card.active i {
            color: var(--white);
        }

        .category-card:hover {
            background: var(--primary-color);
            color: var(--white);
            transform: translateY(-5px);
        }

        .category-card i {
            font-size: 30px;
            margin-bottom: 10px;
            color: var(--primary-color);
            transition: var(--transition);
        }

        .category-card:hover i,
        .category-card.active i {
            color: var(--white);
        }

        .category-card h3 {
            font-size: 18px;
        }

        /* Content Tabs */
        .content-tab {
            display: none;
        }

        .content-tab.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        /* Newsletter */
        .newsletter {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
            color: var(--white);
            padding: 80px 0;
            text-align: center;
            margin: 50px 0;
            clip-path: polygon(0 15%, 100% 0, 100% 100%, 0 100%);
        }

        .newsletter h2 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .newsletter p {
            margin-bottom: 30px;
            font-size: 18px;
        }

        .newsletter-form {
            max-width: 500px;
            margin: 0 auto;
            display: flex;
        }

        .newsletter-form input {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 4px 0 0 4px;
            font-size: 16px;
        }

        .newsletter-form .btn {
            background: var(--primary-dark);
            color: var(--white);
            border: none;
            padding: 0 30px;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }

        /* Footer */
        .footer {
            background: var(--black);
            color: var(--white);
            padding: 80px 0 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-col h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: var(--white);
            position: relative;
        }

        .footer-col h3:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 40px;
            height: 2px;
            background-color: var(--primary-color);
        }

        .footer-col p {
            margin: 20px 0;
            color: var(--medium-gray);
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            color: var(--medium-gray);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-col ul li a:hover {
            color: var(--primary-light);
            padding-left: 5px;
        }

        .footer-col ul li i {
            margin-right: 10px;
            color: var(--primary-color);
            width: 20px;
            text-align: center;
        }

        .social-links {
            display: flex;
            margin-top: 20px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            margin-right: 10px;
            transition: var(--transition);
        }

        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--medium-gray);
            font-size: 14px;
        }

        /* Skeleton Loading */
        .skeleton {
            position: relative;
            overflow: hidden;
            background-color: var(--light-gray);
        }

        .skeleton::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg,
                    rgba(255, 255, 255, 0) 0%,
                    rgba(255, 255, 255, 0.3) 50%,
                    rgba(255, 255, 255, 0) 100%);
            animation: shimmer 1.5s infinite;
        }

        .skeleton-img {
            width: 100%;
            height: 200px;
            background: var(--medium-gray);
        }

        .skeleton-text {
            height: 15px;
            background: var(--medium-gray);
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .skeleton-text.short {
            width: 50%;
        }

        .skeleton-text.medium {
            width: 70%;
        }

        .skeleton-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--medium-gray);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 36px;
            }

            .hero-subtitle {
                font-size: 18px;
            }
        }

        @media (max-width: 768px) {

            .nav-links,
            .auth-buttons {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero {
                padding: 120px 0 80px;
            }

            .hero-title {
                font-size: 32px;
            }

            .categories-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }

            .newsletter-form {
                flex-direction: column;
            }

            .newsletter-form input {
                border-radius: 4px;
                margin-bottom: 10px;
            }

            .newsletter-form .btn {
                border-radius: 4px;
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .hero {
                clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
                padding: 100px 0 60px;
            }

            .hero-title {
                font-size: 28px;
            }

            .section-title {
                font-size: 24px;
            }

            .posts-grid {
                grid-template-columns: 1fr;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <?php
    require_once '../includes/header.php';
    ?>
    <br><br>
    <!-- Contact Form -->
    <section class="container" style="max-width: 700px; margin: 60px auto;">
          <?php if (isset($login_error)):?>
            <div style="color: #c62828; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
                <?php echo $login_error; ?>
            </div>
        <?php endif; ?><br>
         <?php if (isset($login_success)):?>
            <div style="color:rgb(11, 133, 233); padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
                <?php echo $login_success; ?>
            </div>
        <?php endif; ?>
        <h2 class="section-title" style="text-align: center;">Feedback Form</h2>
        <form class="contact-form" style="display: flex; flex-direction: column; gap: 20px; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);" method="post">

            <input type="text" name="name" placeholder="Your Name" required style="padding: 15px; border: 1px solid #ccc; border-radius: 10px;">

            <input type="email" name="email" placeholder="Your Email" required style="padding: 15px; border: 1px solid #ccc; border-radius: 10px;">

            <textarea placeholder="Your Message" name="message" rows="6" required style="padding: 15px; border: 1px solid #ccc; border-radius: 10px; resize: vertical;"></textarea>

            <button type="submit" name="insert" class="btn signup-btn" style="width: 100%; padding: 15px;">Send Message</button>
        </form>
    </section>
    <?php
    require_once '../includes/footer.php';
    ?>
</body>

</html>