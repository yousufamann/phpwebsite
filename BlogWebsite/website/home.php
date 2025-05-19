<?php
require_once '../includes/header.php';
session_start();

?>

<style>
      /* Main Slider Container */
    .image-slider {
        width: 100%;
        position: relative;
        overflow: hidden;
        margin: 0 auto 50px;
    }
    
    .slider-container {
        position: relative;
        width: 100%;
        height: 70vh; /* Adjust height as needed */
        max-height: 700px;
        min-height: 400px;
        overflow: hidden;
    }
    
    /* Individual Slide */
    .slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 1s ease;
    }
    
    .slide.active {
        opacity: 1;
    }
    
    /* Background Image */
    .slide-image {
        position: absolute;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        z-index: 1;
    }
    
    /* Centered Content - This is the key part */
    .slide-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        z-index: 2;
        width: 90%;
        max-width: 900px;
        padding: 20px;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.8);
    }
    
    .slide-title {
        font-size: 2.8rem;
        margin-bottom: 20px;
        animation: fadeInDown 0.8s ease;
    }
    
    .slide-text {
        font-size: 1.3rem;
        margin-bottom: 30px;
        line-height: 1.6;
        animation: fadeInUp 0.8s ease 0.3s both;
    }
    
    .slide-button {
        display: inline-block;
        padding: 12px 30px;
        background-color:#42a5f5;
        color:white;
        text-decoration: none;
        border-radius: 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        animation: fadeIn 1s ease 0.6s both;
    }
    
    .slide-button:hover {
        background-color: #1565c0;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    
    /* Navigation Arrows */
    .slider-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        background: rgba(0,0,0,0.5);
        color: white;
        border: none;
        border-radius: 50%;
        font-size: 1.5rem;
        cursor: pointer;
        z-index: 3;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .slider-nav:hover {
        background: rgba(0,0,0,0.8);
    }
    
    .prev-slide {
        left: 30px;
    }
    
    .next-slide {
        right: 30px;
    }
    
    /* Pagination Dots */
    .slider-pagination {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 3;
    }
    
  
    
    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    /* Responsive Adjustments */
    @media (max-width: 1200px) {
        .slide-title {
            font-size: 2.5rem;
        }
        .slide-text {
            font-size: 1.1rem;
        }
    }
    
    @media (max-width: 768px) {
        .slider-container {
            height: 60vh;
        }
        .slide-title {
            font-size: 2rem;
        }
        .slide-text {
            font-size: 1rem;
            margin-bottom: 20px;
        }
        .slide-button {
            padding: 10px 25px;
        }
        .slider-nav {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
        }
    }
    
    @media (max-width: 576px) {
        .slider-container {
            height: 50vh;
        }
        .slide-title {
            font-size: 1.6rem;
            margin-bottom: 15px;
        }
        .slide-text {
            font-size: 0.9rem;
        }
        .slider-pagination {
            bottom: 20px;
        }
    }

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

    @media (max-width: 768px) {

        .nav-links,
        .auth-buttons {
            display: none;
        }

        .mobile-menu-btn {
            display: block;
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

    /* Additional styles for About page */
    .about-banner {
        background: linear-gradient(rgba(30, 136, 229, 0.8), rgba(30, 136, 229, 0.8)),
            url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80');
        background-size: cover;
        background-position: center;
        color: var(--white);
        padding: 180px 0 100px;
        text-align: center;
        clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        margin-bottom: 50px;
        animation: fadeIn 1s ease;
    }

    .about-banner h1 {
        font-size: 48px;
        margin-bottom: 20px;
        animation: slideInDown 1s ease;
    }

    .about-banner p {
        font-size: 20px;
        max-width: 700px;
        margin: 0 auto 30px;
        animation: slideInUp 1s ease 0.2s both;
    }

    .about-section {
        padding: 80px 0;
    }

    .about-section .container {
        display: flex;
        align-items: center;
        gap: 50px;
    }

    .about-section.reverse .container {
        flex-direction: row-reverse;
    }

    .about-img {
        flex: 1;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--shadow);
        animation: fadeInLeft 1s ease;
    }

    .about-img img {
        width: 100%;
        height: auto;
        display: block;
        transition: var(--transition);
    }

    .about-img:hover img {
        transform: scale(1.05);
    }

    .about-content {
        flex: 1;
        animation: fadeInRight 1s ease;
    }

    .about-content h2 {
        font-size: 32px;
        margin-bottom: 20px;
        color: var(--primary-dark);
    }

    .about-content p {
        margin-bottom: 20px;
        color: var(--dark-gray);
        line-height: 1.8;
    }

    .team-section {
        padding: 80px 0;
        background-color: var(--light-gray);
    }

    .team-container {
        width: 100%;
        overflow-x: auto;
        padding-bottom: 20px;
    }

    .team-grid {
        display: flex;
        gap: 30px;
        margin-top: 50px;
        width: max-content;
        margin-left: auto;
        margin-right: auto;
        padding: 0 20px;
    }

    .team-card {
        background: var(--white);
        border-radius: 8px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        text-align: center;
        position: relative;
        width: 280px;
        flex-shrink: 0;
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .team-img-container {
        position: relative;
        overflow: hidden;
        height: 300px;
    }

    .team-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .team-card:hover .team-img {
        transform: scale(1.1);
    }

    .team-info {
        padding: 25px 20px;
    }

    .team-info h3 {
        font-size: 22px;
        margin-bottom: 8px;
        color: var(--black);
    }

    .team-info p {
        color: var(--primary-color);
        margin-bottom: 20px;
        font-weight: 600;
        font-size: 16px;
    }

    .team-social {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .team-social a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary-light);
        color: var(--white);
        transition: var(--transition);
        font-size: 18px;
    }

    .team-social a:hover {
        background: var(--primary-dark);
        transform: translateY(-3px) scale(1.1);
    }

    .stats-section {
        padding: 80px 0;
        background: linear-gradient(135deg, var(--primary-light), var(--primary-color));
        color: var(--white);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
        text-align: center;
    }

    .stat-item {
        padding: 30px;
    }

    .stat-number {
        font-size: 48px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 18px;
    }

    /* Animations */
    @keyframes slideInDown {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes slideInUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes fadeInLeft {
        from {
            transform: translateX(-50px);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes fadeInRight {
        from {
            transform: translateX(50px);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Responsive styles */
    @media (max-width: 992px) {
        .about-banner h1 {
            font-size: 36px;
        }

        .about-banner p {
            font-size: 18px;
        }
    }

    @media (max-width: 768px) {

        .about-section .container,
        .about-section.reverse .container {
            flex-direction: column;
        }

        .about-img {
            margin-bottom: 30px;
            width: 100%;
        }

        .about-banner {
            padding: 120px 0 80px;
        }

        .team-grid {
            gap: 20px;
        }

        .team-card {
            width: 250px;
        }
    }

    @media (max-width: 576px) {
        .about-banner {
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
            padding: 100px 0 60px;
        }

        .about-banner h1 {
            font-size: 28px;
        }

        .team-card {
            width: 220px;
        }
    }

    /* Scrollbar styling for team container */
    .team-container::-webkit-scrollbar {
        height: 8px;
    }

    .team-container::-webkit-scrollbar-track {
        background: var(--light-gray);
        border-radius: 10px;
    }

    .team-container::-webkit-scrollbar-thumb {
        background: var(--primary-light);
        border-radius: 10px;
    }

    .team-container::-webkit-scrollbar-thumb:hover {
        background: var(--primary-color);
    }
</style>
<br><br>
<section class="image-slider">
 <div class="container">
       <div class="slider-container">
        <?php
        include('../database.php');
        $sql = "SELECT * FROM `carousel-data`";
        $query = mysqli_query($con, $sql);
        if (mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_array($query)) {
        ?>
        <div class="slide">
            <div class="slide-image"><img style="width: 120%;" src="../dashbaord/uploads-homeimages/<?php echo $row['image']; ?>" alt=""></div>
            <div class="slide-content"><br><br>
                <h2 class="slide-title"><?php echo $row['name']; ?></h2>
                <p class="slide-text"><?php echo $row['description']; ?></p>
                 <a href="#" class="slide-button">Learn More</a>
            </div>
        </div>
        <?php
            }
        }
        ?>
        <button class="slider-nav prev-slide">&larr;</button>
        <button class="slider-nav next-slide">&rarr;</button>
        <div class="slider-pagination"></div>
    </div>
 </div>
</section>
<!-- Categories
<section class="categories">
    <div class="container">
        <h2 class="section-title">Popular Categories</h2>
        <div class="categories-grid">
            <div class="category-card active" data-tab="trending">
                <i class="fas fa-fire"></i>
                <h3>Trending</h3>
            </div>
            <div class="category-card" data-tab="live">
                <i class="fas fa-broadcast-tower"></i>
                <h3>Live</h3>
            </div>
            <div class="category-card" data-tab="movies">
                <i class="fas fa-film"></i>
                <h3>Movies</h3>
            </div>
            <div class="category-card" data-tab="gaming">
                <i class="fas fa-gamepad"></i>
                <h3>Gaming</h3>
            </div>
            <div class="category-card" data-tab="videos">
                <i class="fas fa-video"></i>
                <h3>Videos</h3>
            </div>
            <div class="category-card" data-tab="food">
                <i class="fas fa-utensils"></i>
                <h3>Food</h3>
            </div>
        </div>
    </div>
</section> -->

  
    <!-- Categories Section -->
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="section-title">Popular Categories</h2>
    </div>
    
    <div class="categories-grid">
        <?php
        $activeCat = isset($_GET['name']) ? $_GET['name'] : '';
        $sql = "SELECT * FROM category";
        $q = mysqli_query($con, $sql);

        if (mysqli_num_rows($q) > 0) {
            while ($row = mysqli_fetch_assoc($q)) {
                $isActive = ($activeCat == $row['catid']) ? 'active' : '';
        ?>
                <a style="text-decoration: none;" href="category.php?name=<?php echo $row['catid']; ?>">
                    <div class="category-card <?php echo $isActive; ?>">
                        <h3><?php echo $row['catname']; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            echo "<div class='no-post'>NO CATEGORIES AVAILABLE</div>";
        }
        ?>
    </div>
    
    <div class="posts-grid">
        <?php
        if (isset($_GET['name'])) {
            $catId = mysqli_real_escape_string($con, $_GET['name']);
            $catQuery = "SELECT catname FROM category WHERE catid = '$catId'";
            $catResult = mysqli_query($con, $catQuery);
            
            if (mysqli_num_rows($catResult) > 0) {
                $catRow = mysqli_fetch_assoc($catResult);
                $categoryName = $catRow['catname'];
                
                // Get posts for this category
                $sql = "SELECT * FROM post1 WHERE category = '$categoryName'";
                $query = mysqli_query($con, $sql);

                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
        ?>
                        <div class="post-card">
                            <?php if (!empty($row['image'])) { ?>
                                <img src="../dashbaord/uploads-images/<?php echo $row['image']; ?>" alt="Post Image" class="post-card-img">
                            <?php } else { ?>
                                <div class="post-card-img" style="background: #eee; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-image" style="font-size: 50px; color: #ccc;"></i>
                                </div>
                            <?php } ?>
                            <div class="post-card-content">
                                <span class="post-card-category"><?php echo $row['category']; ?></span>
                                <h3 class="post-card-title"><?php echo $row['name']; ?></h3>
                                <p class="post-card-excerpt"><?php echo $row['description']; ?></p>
                                <a href="postdetails.php?id=<?php echo $row['id'];?>"><button class="btn btn-success">SeeMore</button></a>
                            </div>
                        </div>
        <?php
                    }
                } else {
                    echo "<div class='no-post'>NO POSTS AVAILABLE IN THIS CATEGORY</div>";
                }
            } else {
                echo "<div class='no-post'>CATEGORY NOT FOUND</div>";
            }
        } else {
            // Default view (shows all posts)
            $sql = "SELECT * FROM post1";
            $query = mysqli_query($con, $sql);

            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
        ?>
                    <div class="post-card">
                        <?php if (!empty($row['image'])) { ?>
                            <img src="../dashbaord/uploads-images/<?php echo $row['image']; ?>" alt="Post Image" class="post-card-img">
                        <?php } else { ?>
                            <div class="post-card-img" style="background: #eee; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="font-size: 50px; color: #ccc;"></i>
                            </div>
                        <?php } ?>
                        <div class="post-card-content">
                            <span class="post-card-category"><?php echo $row['category']; ?></span>
                            <h3 class="post-card-title"><?php echo $row['name']; ?></h3>
                            <p class="post-card-excerpt"><?php echo $row['description']; ?></p>
                            <a href="postdetails.php?id=<?php echo $row['id'];?>"><button class="btn btn-success">SeeMore</button></a>
                        </div>
                    </div>
        <?php
                }
            } else {
                echo "<div class='no-post'>NO POSTS AVAILABLE</div>";
            }
        }
        ?>
    </div>
</div>

<!-- Team Section -->
<section class="team-section">
    <div class="container">
        <h2 class="section-title" style="text-align: center;">Meet The Team</h2>
        <p style="text-align: center; max-width: 700px; margin: 0 auto 30px; color: var(--dark-gray);">
            Our dedicated team works tirelessly to ensure BlueSky remains a platform you love. Here are some of the people behind the scenes.
        </p>
        <div class="team-container">
            <div class="team-grid">
                <div class="team-card">
                    <div class="team-img-container">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=688&q=80" alt="Sarah Johnson" class="team-img">
                    </div>
                    <div class="team-info">
                        <h3>Sarah Johnson</h3>
                        <p>CEO & Founder</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-card">
                    <div class="team-img-container">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Michael Chen" class="team-img">
                    </div>
                    <div class="team-info">
                        <h3>Michael Chen</h3>
                        <p>CTO</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-card">
                    <div class="team-img-container">
                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=761&q=80" alt="Emma Wilson" class="team-img">
                    </div>
                    <div class="team-info">
                        <h3>Emma Wilson</h3>
                        <p>Content Director</p>
                        <div class="team-social">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include('../database.php');
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
<!-- Newsletter -->
<section class="newsletter">
    <div class="container">
        <div class="newsletter-content">
            <h2>Subscribe to our Newsletter</h2>
            <p>Get the latest posts delivered right to your inbox</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter your email">
                <button type="submit" class="btn">Subscribe</button>
            </form>
        </div>
    </div>
</section>
<script>
    // Tab functionality
    document.addEventListener('DOMContentLoaded', function() {
        const categoryCards = document.querySelectorAll('.category-card');

        categoryCards.forEach(card => {
            card.addEventListener('click', function() {
                // Remove active class from all cards
                categoryCards.forEach(c => c.classList.remove('active'));

                // Add active class to clicked card
                this.classList.add('active');

                // Get the tab to show
                const tabId = this.getAttribute('data-tab') + '-tab';

                // Hide all content tabs
                document.querySelectorAll('.content-tab').forEach(tab => {
                    tab.classList.remove('active');
                });

                // Show the selected tab
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Mobile menu toggle
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            document.querySelector('.nav-links').classList.toggle('active');
            document.querySelector('.auth-buttons').classList.toggle('active');
        });
    });


   document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.slide');
        const pagination = document.querySelector('.slider-pagination');
        let currentSlide = 0;
        
        // Create pagination dots
        slides.forEach((slide, index) => {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            if(index === 0) dot.classList.add('active');
            dot.addEventListener('click', () => goToSlide(index));
            pagination.appendChild(dot);
        });
        
        const dots = document.querySelectorAll('.dot');
        
        // Initialize first slide
        slides[0].classList.add('active');
        
        // Navigation controls
        document.querySelector('.next-slide').addEventListener('click', nextSlide);
        document.querySelector('.prev-slide').addEventListener('click', prevSlide);
        
        // Auto-rotation
        let slideInterval = setInterval(nextSlide, 5000);
        
        function nextSlide() {
            goToSlide((currentSlide + 1) % slides.length);
        }
        
        function prevSlide() {
            goToSlide((currentSlide - 1 + slides.length) % slides.length);
        }
        
        function goToSlide(index) {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 5000);
            
            slides[currentSlide].classList.remove('active');
            dots[currentSlide].classList.remove('active');
            
            currentSlide = index;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }
        
        // Pause on hover
        const slider = document.querySelector('.slider-container');
        slider.addEventListener('mouseenter', () => clearInterval(slideInterval));
        slider.addEventListener('mouseleave', () => {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 5000);
        });
    });
</script>
<?php
require_once '../includes/footer.php';
?>