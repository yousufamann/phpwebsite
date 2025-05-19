<?php
include('../database.php');
require_once '../includes/header.php';

$search_term = isset($_GET['search_term']) ? mysqli_real_escape_string($con, $_GET['search_term']) : '';
$query = "SELECT * FROM post1 WHERE name LIKE '%$search_term%' OR description LIKE '%$search_term%'OR category LIKE '%$search_term%'";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results for - BlueSky</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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

        /* YouTube-style Layout */
        .search-page {
            display: flex;
            min-height: 100vh;
            padding-top: 60px;
        }
        
        .search-sidebar {
            width: 240px;
            padding: 20px;
            background: var(--white);
            border-right: 1px solid var(--medium-gray);
            position: fixed;
            height: calc(100vh - 60px);
            overflow-y: auto;
        }
        
        .search-main {
            flex: 1;
            margin-left: 240px;
            padding: 20px;
        }
        
        /* Filters Section */
        .filters {
            display: flex;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid var(--medium-gray);
            margin-bottom: 20px;
            overflow-x: auto;
        }
        
        .filter-btn {
            padding: 8px 12px;
            border-radius: 20px;
            background: var(--light-gray);
            border: none;
            cursor: pointer;
            white-space: nowrap;
            font-size: 14px;
            transition: var(--transition);
        }
        
        .filter-btn:hover, .filter-btn.active {
            background: var(--black);
            color: var(--white);
        }
        
        /* Search Results */
        .search-results {
            display: grid;
            gap: 16px;
        }
        
        .search-result-card {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
        }
        
        .thumbnail {
            width: 360px;
            height: 202px;
            background: var(--light-gray);
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }
        
        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .search-result-details {
            flex: 1;
        }
        
        .search-result-title {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--black);
        }
        
        .search-result-meta {
            color: var(--dark-gray);
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .search-result-description {
            color: var(--dark-gray);
            font-size: 14px;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .search-result-category {
            display: inline-block;
            background: var(--light-gray);
            color: var(--black);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            margin-top: 8px;
        }
        
        /* No Results */
        .no-results {
            text-align: center;
            padding: 50px 0;
        }
        
        .no-results i {
            font-size: 60px;
            color: var(--medium-gray);
            margin-bottom: 20px;
        }
        
        .no-results h3 {
            color: var(--black);
            margin-bottom: 15px;
        }
        
        .no-results p {
            color: var(--dark-gray);
            max-width: 500px;
            margin: 0 auto;
        }
        
        /* Responsive */
        @media (max-width: 900px) {
            .search-sidebar {
                display: none;
            }
            
            .search-main {
                margin-left: 0;
            }
            
            .search-result-card {
                flex-direction: column;
            }
            
            .thumbnail {
                width: 100%;
                height: auto;
                aspect-ratio: 16/9;
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
</head>
<body>
    <div class="search-page">
        <!-- Sidebar (like YouTube filters) -->
       
        <!-- Main Content -->
        <div class="search-main">
            <!-- Filters Bar -->
           
            
            <!-- Search Results Count -->
            <div style="margin-bottom: 20px; color: var(--dark-gray);">
                <?php 
                $count = mysqli_num_rows($result);
                echo $count > 0 ? "About $count results for \"<strong>".htmlspecialchars($search_term)."</strong>\"" : "No results found for \"<strong>".htmlspecialchars($search_term)."</strong>\"";
                ?>
            </div>
            
            <!-- Search Results -->
            <div class="search-results">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="search-result-card">
                            <div class="thumbnail">
                                <?php if (!empty($row['image']));?>
                                    <img src="../dashbaord/uploads-images/<?php echo $row['image']; ?>" alt="">
                             
                                    <div style="display: flex; align-items: center; justify-content: center; height: 100%; background: var(--medium-gray); color: var(--dark-gray);">
                                        <i class="fas fa-image" style="font-size: 40px;"></i>
                                    </div>
                           
                            </div>
                            <div class="search-result-details">
                                <h3 class="search-result-title"><?php echo htmlspecialchars($row['name']); ?></h3>
                                <div class="search-result-meta">
                                    <span>Category: <?php echo htmlspecialchars($row['category']); ?></span>
                                </div>
                                <p class="search-result-description">
                                    <?php echo htmlspecialchars($row['description']); ?>
                                </p>
                                <span class="search-result-category">
                                    <?php echo htmlspecialchars($row['category']); ?>
                                </span>
                    <a href="postdetails.php?id=<?php echo $row['id'];?>"><button class="btn btn-success">SeeMore</button></a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="no-results">
                        <i class="fas fa-search"></i>
                        <h3>No matching results found</h3>
                        <p>Try different keywords or check out our categories to find what you're looking for.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php require_once '../includes/footer.php'; ?>

    <script>
        // Filter buttons functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Here you would typically reload the page with the new filter
                // or make an AJAX call to update the results
            });
        });
    </script>
</body>
</html>