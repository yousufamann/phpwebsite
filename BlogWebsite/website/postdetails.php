<?php
error_reporting(E_ERROR | E_PARSE);
include('../database.php');
require_once '../includes/header.php';
session_start();
if (isset($_SESSION['id'])) {
    $uid = $_SESSION['id'];
}
$id = $_GET['id'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details | TechBlog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        /* Add this CSS to your existing stylesheet */
        .post-detail-container {
            display: flex;
            gap: 40px;
            margin-top: 50px;
            height: calc(100vh - 200px);
            /* Adjust based on your header height */
        }

        .post-content-area {
            flex: 2;
            overflow-y: auto;
            padding-right: 20px;
            height: 100%;
        }

        .comments-sidebar {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .comments-container {
            background: var(--light-gray);
            padding: 30px;
            border-radius: 8px;
            overflow-y: auto;
            flex: 1;
        }

        .comment-form-container {
            background: var(--light-gray);
            padding: 30px;
            border-radius: 8px;
            margin-top: 20px;
        }

        /* Rest of your existing styles... */
        .post-header {
            margin-bottom: 30px;
        }

        .post-category {
            display: inline-block;
            background: var(--primary-color);
            color: var(--white);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .post-title {
            font-size: 23px;
            margin-bottom: 20px;
            color: var(--black);
            line-height: 1.3;
        }

        .post-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

     

        .post-share a {
            color: var(--dark-gray);
            margin-left: 10px;
            font-size: 18px;
            transition: var(--transition);
        }

        .post-share a:hover {
            color: var(--primary-color);
        }

        .post-featured-image {
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
        }

        .featured-img {
            width: 100%;
            height: auto;
            display: block;
            transition: var(--transition);
        }

        .post-featured-image:hover .featured-img {
            transform: scale(1.02);
        }

        .post-content {
            line-height: 1.8;
            color: var(--black);
        }

        .post-content h2 {
            font-size: 24px;
            margin: 30px 0 20px;
            color: var(--primary-dark);
        }

        .post-content h3 {
            font-size: 20px;
            margin: 25px 0 15px;
        }

        .post-content p {
            margin-bottom: 20px;
        }

        .post-content ul,
        .post-content ol {
            margin-bottom: 20px;
            padding-left: 20px;
        }

        .post-content li {
            margin-bottom: 10px;
        }

        .post-image {
            margin: 30px 0;
        }

        .content-img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .image-caption {
            text-align: center;
            font-size: 14px;
            color: var(--dark-gray);
        }

        .code-block {
            background: #f5f7fa;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
            overflow-x: auto;
        }

        .code-block pre {
            margin: 0;
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px;
            line-height: 1.5;
        }

        .post-quote {
            border-left: 4px solid var(--primary-color);
            padding-left: 20px;
            margin: 30px 0;
            font-style: italic;
            color: var(--dark-gray);
        }

        .post-quote footer {
            margin-top: 10px;
            font-style: normal;
            font-weight: 600;
        }

        .post-tags {
            margin: 40px 0;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .post-tags span {
            font-weight: 600;
        }

        .tag {
            display: inline-block;
            background: var(--light-gray);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            color: var(--dark-gray);
            transition: var(--transition);
        }

        .tag:hover {
            background: var(--primary-color);
            color: var(--white);
        }

        .author-bio {
            display: flex;
            gap: 20px;
            background: var(--light-gray);
            padding: 30px;
            border-radius: 8px;
            margin: 40px 0;
        }

        .author-bio .author-avatar {
            width: 80px;
            height: 80px;
            flex-shrink: 0;
        }

        .author-info h3 {
            margin-bottom: 10px;
            font-size: 20px;
        }

        .author-social {
            margin-top: 15px;
        }

        .author-social a {
            display: inline-block;
            width: 35px;
            height: 35px;
            background: var(--medium-gray);
            color: var(--black);
            border-radius: 50%;
            text-align: center;
            line-height: 35px;
            margin-right: 10px;
            transition: var(--transition);
        }

        .author-social a:hover {
            background: var(--primary-color);
            color: var(--white);
        }

        /* Comments Section Styles */
        .comments-heading {
            font-size: 24px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--medium-gray);
            color: var(--primary-dark);
        }

        .comment {
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid var(--medium-gray);
        }

        .comment:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .comment-author {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .comment-author img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .comment-author h4 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .comment-date {
            font-size: 14px;
            color: var(--dark-gray);
        }

        .comment-content p {
            margin: 0;
            line-height: 1.6;
        }

        .comment-form h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: var(--primary-dark);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--medium-gray);
            border-radius: 4px;
            font-family: inherit;
            font-size: 16px;
            transition: var(--transition);
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.2);
        }

        .submit-btn {
            background: var(--primary-color);
            color: var(--white);
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: 500;
        }

        .submit-btn:hover {
            background: var(--primary-dark);
        }

        /* Custom scrollbars */
        .post-content-area::-webkit-scrollbar,
        .comments-container::-webkit-scrollbar {
            width: 8px;
        }

        .post-content-area::-webkit-scrollbar-track,
        .comments-container::-webkit-scrollbar-track {
            background: var(--light-gray);
            border-radius: 10px;
        }

        .post-content-area::-webkit-scrollbar-thumb,
        .comments-container::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 10px;
        }

        .post-content-area::-webkit-scrollbar-thumb:hover,
        .comments-container::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .post-detail-container {
                flex-direction: column;
                height: auto;
            }

            .post-content-area {
                overflow-y: visible;
                padding-right: 0;
                margin-bottom: 40px;
            }

            .comments-sidebar {
                height: auto;
            }

            .comments-container {
                max-height: 400px;
            }

            .post-title {
                font-size: 28px;
            }
        }

        @media (max-width: 576px) {
            .post-title {
                font-size: 24px;
            }

            .post-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .author-bio {
                flex-direction: column;
            }

            .author-bio .author-avatar {
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
    <?php



    $sql = "SELECT * FROM `post1` WHERE id='$id'";
    $sql1 = "SELECT * FROM `users` WHERE id='$uid'";
    $query = mysqli_query($con, $sql);
    $query1 = mysqli_query($con, $sql1);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $row1 = mysqli_fetch_assoc($query1)
    ?>
            <main class="container" style="margin-top: 100px; margin-bottom: 50px;">
                <div class="post-comment-container">
                    <!-- Left Side - Post Content -->
                    <div class="post-content-area">
                        <!-- Post Header -->
                        <div class="post-header">
                            <span class="post-category">Category:<?php echo $row['category']; ?></span>
                            <h3 class="post-title">PostName:<?php echo $row['name']; ?></h1>
                            <h3 class="post-title">PostDescription:<?php echo $row['description']; ?></h3>
                        </div>

                        <!-- Featured Image -->
                        <div class="post-featured-image">
                            <img src="../dashbaord/uploads-images/<?php echo $row['image']; ?>" alt="Post Image" class="featured-img">
                        </div>

                        <!-- Additional post content can go here -->
                    </div>

                    <!-- Right Side - Comments -->
                    <div class="comments-area">
                        <div class="comments-container">
                            <h2 class="comments-heading">Comments</h2>

                            <!-- Comments Table -->
                            <div class="table-responsive" style="margin-top: 20px;">
                                <table class="table" style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
                                    <thead style="background-color: #1e88e5; color: white;">
                                        <tr>
                                            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">CommentName</th>
                                            <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        <!-- Comments will be loaded here via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Comment Form (fixed at bottom) -->
                        <?php if (isset($_SESSION['id'])): ?>
                            <div class="comment-form-container">
                                <h3 style="margin-bottom: 15px; color: #1e88e5;">Write a Comment</h3>
                                <div class="comment-input-container" style="display: flex; align-items: center; gap: 15px;">
                                    <!-- User Avatar -->
                                    <?php if (!empty($row1['image'])): ?>
                                        <?php echo $row1['name']; ?>
                                    <?php endif; ?>

                                    <!-- Input Field -->
                                    <div style="flex: 1;">
                                        <input type="text" id="comment" placeholder="Write your comment here..." style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 25px; outline: none;">
                                        <input type="hidden" id="uid" value="<?php echo $uid ?>">
                                        <input type="hidden" id="pid" value="<?php echo $id; ?>">
                                    </div>
                                </div>
                                <div style="text-align: right; margin-top: 10px;">
                                    <button id="submit" style="background: #1e88e5; color: white; border: none; padding: 10px 20px; border-radius: 25px; cursor: pointer; font-weight: bold;">Post Comment</button>
                                </div>
                            </div>
                        <?php else: ?>
                            <div style="text-align: center; padding: 20px; background: #f5f5f5; border-radius: 8px; margin-top: 20px;">
                                <p>Please <a href="../login.php" style="color: #1e88e5;">login</a> to post a comment</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </main>
    <?php }
    } ?>

    <style>
        /* Main container for post and comments */
        .post-comment-container {
            display: flex;
            gap: 30px;
            margin-top: 30px;
            height: calc(100vh - 200px);
            /* Adjust based on your header height */
        }

        /* Post content area (left side) */
        .post-content-area {
            flex: 2;
            overflow-y: auto;
            padding-right: 20px;
            height: 100%;
        }

        /* Comments area (right side) */
        .comments-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* Comments container (scrollable) */
        .comments-container {
            background: var(--light-gray);
            padding: 20px;
            border-radius: 8px;
            overflow-y: auto;
            flex: 1;
            margin-bottom: 20px;
        }

        /* Comment form (fixed at bottom) */
        .comment-form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            bottom: 0;
        }

        /* Custom scrollbars */
        .post-content-area::-webkit-scrollbar,
        .comments-container::-webkit-scrollbar {
            width: 8px;
        }

        .post-content-area::-webkit-scrollbar-track,
        .comments-container::-webkit-scrollbar-track {
            background: var(--light-gray);
            border-radius: 10px;
        }

        .post-content-area::-webkit-scrollbar-thumb,
        .comments-container::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 10px;
        }

        .post-content-area::-webkit-scrollbar-thumb:hover,
        .comments-container::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .post-comment-container {
                flex-direction: column;
                height: auto;
            }

            .post-content-area {
                overflow-y: visible;
                padding-right: 0;
                margin-bottom: 40px;
            }

            .comments-area {
                height: auto;
            }

            .comments-container {
                max-height: 400px;
            }
        }
    </style>
    </div>
    </div>


    </main>
    <?php
    require_once "../includes/footer.php";
    ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <input type="hidden" id="postid" value="<?php echo $id ?>">

    <script>
        $(document).ready(function() {


            var post_id = $('#postid').val();


            function loaddata() {
                $.ajax({
                    url: 'fetchcomment_ajax.php',
                    type: 'POST',
                    data: {
                        pid: post_id
                    },
                    success: function(fetch) {
                        $('#comment_data');
                        {
                            $('#tbody').html(fetch);
                        }

                    }
                });
            }
            loaddata();
            $('#submit').on('click', function(e) {
                e.preventDefault(); // Form submit rokta hai

                var comment = $('#comment').val();
                var uid = $('#uid').val();
                var pid = $('#pid').val();
                console.log(uid, pid);

                if (comment != '') { // Agar comment khali nahi hai
                    $.ajax({
                        url: 'comment_ajax.php',
                        type: 'POST',
                        data: {
                            comment_post: comment,
                            uid2: uid,
                            pid2: pid,
                        },
                        success: function(data) {
                            loaddata();

                            $('#comment').val(''); // Input khali karo
                        },
                        error: function() {
                            alert('no data received');
                        }
                    });
                } else {
                    alert('no comment in user');
                }
            });
        });
    </script>



</body>

</html>