<?php
require_once '../includes/header.php';
?>
<style>
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

<!-- Animated Banner -->
<section class="about-banner">
    <div class="container">
        <h1>About BlueSky</h1>
        <p>Discover the story behind our platform and the passionate team that makes it all possible.</p>
        <a href="#our-story" class="btn login-btn" style="animation: fadeInUp 1s ease 0.4s both;text-decoration: none;">Explore Our Journey</a>
    </div>
</section>
<?php
include('../database.php');
$sql="SELECT * FROM `about`";
$query=mysqli_query($con,$sql);
if(mysqli_num_rows($query)>0){
    while($row=mysqli_fetch_assoc($query)){


?>
<!-- Our Story Section -->
<section id="our-story" class="about-section">
    <div class="container">
        <div class="about-img">
            <img src="../dashbaord/uploads-about/<?php echo $row['image'];?>" alt="Our Team">
        </div>
        <div class="about-content">
            <h2>Our Story</h2>
            <p><?php echo $row['description'];?></p>
        </div>
    </div>
</section>

<!-- Our Values Section -->
<section class="about-section reverse" style="background-color: var(--light-gray);">
    <div class="container">
        <div class="about-img">
            <img src="../dashbaord/uploads-about/<?php echo $row['rightimage']?>" alt="Our Values">
        </div>
        <div class="about-content">
            <h2>Our Values</h2>
            <p><?php echo $row['rightdescription']?></p>
        </div>
    </div>
</section>

<!-- Stats Section - Now Dynamic -->
<section class="stats-section">
    <div class="container">
        <h2 class="section-title" style="color: var(--white); text-align: center;">BlueSky By The Numbers</h2>
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number" id="dailyUsers">0</div>
                <div class="stat-label">Daily Active Users</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="publishedArticles">0</div>
                <div class="stat-label">Published Articles</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="contentCreators">0</div>
                <div class="stat-label">Content Creators</div>
            </div>
            <div class="stat-item">
                <div class="stat-number" id="countriesReached">0</div>
                <div class="stat-label">Countries Reached</div>
            </div>
        </div>
    </div>
</section>

<!-- Join Us Section -->
 <section class="about-section">
    <div class="container">
        <div class="about-img">
            <img src="../dashbaord/uploads-about/<?php echo $row['leftimage'];?>" alt="Join Us">
        </div>
        <div class="about-content">
            <h2>Join Our Community</h2>
            <p><?php echo $row['leftdescription'];?></p>
            <div style="display: flex; gap: 15px; margin-top: 30px;">
                <a href="#" class="btn" style="background: var(--white); color: var(--primary-color); border: 1px solid var(--primary-color);text-decoration: none;">Learn More</a>
            </div>
        </div>
    </div>
</section>
<?php
    }
}
?>
<br>
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

        // Animated counter for statistics
    function animateValue(id, start, end, duration) {
        const obj = document.getElementById(id);
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = Math.floor(progress * (end - start) + start);
            obj.innerHTML = value.toLocaleString() + (id === 'dailyUsers' ? '+' : '');
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    // Start counters when stats section is in view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Set your actual numbers here or fetch from backend
                animateValue('dailyUsers', 0, 10500, 2000);
                animateValue('publishedArticles', 0, 52000, 2000);
                animateValue('contentCreators', 0, 5800, 2000);
                animateValue('countriesReached', 0, 120, 2000);
                observer.unobserve(entry.target);
            }
        });
    }, {threshold: 0.5});

    // Observe the stats section
    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        observer.observe(statsSection);
    }
</script>
<?php
require_once '../includes/footer.php';
?>