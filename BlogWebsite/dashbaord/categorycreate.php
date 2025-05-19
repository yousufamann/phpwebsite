<?php
require_once '../include/header.php';
require_once '../include/sidebar.php';
include('../database.php');
if(isset($_POST['insert'])){
    $name = $_POST['catname'];

$sql=mysqli_query($con,"INSERT INTO `category`(`catname`) VALUES ('$name')");
if($sql){
     echo "<script>alert('category inserted'); window.location.href='category.php';</script>";
}
else{
    echo'not inserted';
}
}
?>
<style>
    /* Global Styles */
    :root {
        --primary-color: #1e88e5;
        --primary-dark: #1565c0;
        --primary-light: #42a5f5;
        --sidebar-blue: #1976D2;
        --sidebar-dark: #0D47A1;
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
        background-color: #f9fafb;
        overflow-x: hidden;
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

    /* Dashboard Layout */
    .dashboard {
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar Styles */
    .sidebar {
        width: 250px;
        background: var(--sidebar-blue);
        position: fixed;
        height: 100vh;
        transition: var(--transition);
        z-index: 1000;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        transform: translateX(-100%);
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .sidebar-header {
        padding: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        display: flex;
        align-items: center;
        font-size: 20px;
        font-weight: bold;
        color: var(--white);
    }

    .logo i {
        margin-right: 10px;
        color: var(--white);
    }

    .close-sidebar {
        color: var(--white);
        font-size: 20px;
        cursor: pointer;
        transition: var(--transition);
        opacity: 0.7;
        display: none;
    }

    .close-sidebar:hover {
        opacity: 1;
        transform: rotate(90deg);
    }

    .sidebar-menu {
        padding: 20px 0;
        height: calc(100vh - 70px);
        overflow-y: auto;
    }

    .menu-title {
        padding: 15px 20px 10px;
        font-size: 12px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 600;
    }

    .menu-item {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: var(--white);
        text-decoration: none;
        transition: var(--transition);
        margin: 0 10px;
        border-radius: 4px;
    }

    .menu-item i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
        color: var(--white);
    }

    .menu-item:hover,
    .menu-item.active {
        background: rgba(255, 255, 255, 0.1);
        color: var(--white);
    }

    .menu-item:hover i,
    .menu-item.active i {
        color: var(--white);
    }

    /* Main Content Area */
    .main-content {
        flex: 1;
        transition: var(--transition);
        width: 100%;
        min-height: 100vh;
        margin-left: 0;
    }

    .main-content.sidebar-open {
        margin-left: 250px;
    }

    /* Overlay for mobile */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
    }

    .overlay.active {
        opacity: 1;
        visibility: visible;
    }

    /* Top Navigation */
    .top-nav {
        background: var(--white);
        padding: 15px 0;
        box-shadow: var(--shadow);
        position: sticky;
        top: 0;
        z-index: 90;
    }

    .nav-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .search-bar {
        flex: 1;
        max-width: 500px;
        display: flex;
        margin-right: 20px;
    }

    .search-bar input {
        flex: 1;
        padding: 10px 15px;
        border: 1px solid var(--medium-gray);
        border-radius: 4px 0 0 4px;
        font-size: 14px;
        transition: var(--transition);
    }

    .search-bar input:focus {
        outline: none;
        border-color: var(--primary-color);
    }

    .search-bar button {
        background: var(--primary-color);
        color: var(--white);
        border: none;
        padding: 0 15px;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
        transition: var(--transition);
    }

    .search-bar button:hover {
        background: var(--primary-dark);
    }

    .user-menu {
        display: flex;
        align-items: center;
        position: relative;
    }

    .notification-icon {
        position: relative;
        margin-right: 20px;
        color: var(--dark-gray);
        cursor: pointer;
        transition: var(--transition);
    }

    .notification-icon:hover {
        color: var(--primary-color);
    }

    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: var(--primary-color);
        color: var(--white);
        width: 18px;
        height: 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
    }

    .user-profile {
        display: flex;
        align-items: center;
        cursor: pointer;
        position: relative;
        padding: 5px 10px;
        border-radius: 30px;
        transition: var(--transition);
    }

    .user-profile:hover {
        background: var(--light-gray);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
        object-fit: cover;
        border: 2px solid var(--medium-gray);
        transition: var(--transition);
    }

    .user-profile:hover .user-avatar {
        border-color: var(--primary-color);
    }

    .user-name {
        font-weight: 500;
    }

    /* User Dropdown */
    .user-dropdown {
        position: absolute;
        top: 120%;
        right: 0;
        background: var(--white);
        width: 250px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        padding: 10px 0;
        z-index: 100;
        display: none;
        border: 1px solid var(--medium-gray);
    }

    .user-dropdown.active {
        display: block;
        animation: fadeInDown 0.3s ease;
    }

    .dropdown-header {
        padding: 15px;
        border-bottom: 1px solid var(--medium-gray);
        display: flex;
        align-items: center;
    }

    .dropdown-header .user-avatar {
        width: 40px;
        height: 40px;
        margin-right: 10px;
        border-color: var(--primary-color);
    }

    .dropdown-header .user-info {
        font-size: 14px;
    }

    .dropdown-header .user-info .name {
        font-weight: 600;
        color: var(--black);
    }

    .dropdown-header .user-info .email {
        font-size: 12px;
        color: var(--dark-gray);
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: var(--black);
        text-decoration: none;
        transition: var(--transition);
    }

    .dropdown-item i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
        color: var(--dark-gray);
    }

    .dropdown-item:hover {
        background: var(--light-gray);
        color: var(--primary-color);
    }

    .dropdown-item:hover i {
        color: var(--primary-color);
    }

    .dropdown-divider {
        height: 1px;
        background: var(--medium-gray);
        margin: 5px 0;
    }

    /* Dashboard Content */
    .content {
        padding: 30px 0;
    }

    .section-title {
        font-size: 24px;
        margin-bottom: 20px;
        color: var(--primary-dark);
        position: relative;
        padding-bottom: 10px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: var(--primary-color);
        border-radius: 3px;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: var(--white);
        border-radius: 8px;
        padding: 20px;
        box-shadow: var(--shadow);
        transition: var(--transition);
        border-left: 4px solid var(--primary-color);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .stat-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .stat-card-title {
        font-size: 14px;
        color: var(--dark-gray);
    }

    .stat-card-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
    }

    .stat-card-icon.users {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .stat-card-icon.posts {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .stat-card-icon.views {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .stat-card-icon.comments {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    .stat-card-value {
        font-size: 28px;
        font-weight: bold;
        color: var(--black);
        margin-bottom: 5px;
    }

    .stat-card-change {
        font-size: 12px;
        display: flex;
        align-items: center;
    }

    .stat-card-change.positive {
        color: #4caf50;
    }

    .stat-card-change.negative {
        color: #f44336;
    }

    /* Recent Activity */
    .activity-card {
        background: var(--white);
        border-radius: 8px;
        padding: 25px;
        box-shadow: var(--shadow);
        margin-bottom: 30px;
    }

    .activity-list {
        list-style: none;
    }

    .activity-item {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid var(--medium-gray);
        transition: var(--transition);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item:hover {
        background: rgba(0, 0, 0, 0.01);
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--light-gray);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: var(--primary-color);
    }

    .activity-content {
        flex: 1;
    }

    .activity-text {
        margin-bottom: 5px;
    }

    .activity-time {
        font-size: 12px;
        color: var(--dark-gray);
    }

    /* Recent Posts */
    .posts-card {
        background: var(--white);
        border-radius: 8px;
        padding: 25px;
        box-shadow: var(--shadow);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .table-responsive {
        overflow-x: auto;
        border-radius: 8px;
        border: 1px solid var(--medium-gray);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid var(--medium-gray);
    }

    th {
        background: var(--light-gray);
        color: var(--dark-gray);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 12px;
    }

    tr {
        transition: var(--transition);
    }

    tr:hover {
        background: var(--light-gray);
    }

    .status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .status.published {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .status.draft {
        background: #fff8e1;
        color: #ff8f00;
    }

    .status.pending {
        background: #e3f2fd;
        color: #1565c0;
    }

    .action-btn {
        background: transparent;
        border: none;
        color: var(--dark-gray);
        cursor: pointer;
        margin: 0 5px;
        transition: var(--transition);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .action-btn:hover {
        background: rgba(0, 0, 0, 0.05);
        color: var(--primary-color);
    }

    /* Mobile Menu Button */
    .mobile-menu-btn {
        display: none;
        font-size: 24px;
        cursor: pointer;
        color: var(--primary-color);
        margin-right: 20px;
        transition: var(--transition);
    }

    .mobile-menu-btn:hover {
        color: var(--primary-dark);
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

    @keyframes slideInLeft {
        from {
            transform: translateX(-100%);
        }

        to {
            transform: translateX(0);
        }
    }

    /* Responsive Styles */
    @media (max-width: 1200px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .main-content.sidebar-open {
            margin-left: 0;
            transform: translateX(250px);
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .mobile-menu-btn {
            display: block;
        }

        .close-sidebar {
            display: block;
        }
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .nav-content {
            flex-wrap: wrap;
        }

        .search-bar {
            order: 1;
            margin-top: 15px;
            max-width: 100%;
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .user-name {
            display: none;
        }

        .dropdown-header {
            flex-direction: column;
            text-align: center;
        }

        .dropdown-header .user-avatar {
            margin-right: 0;
            margin-bottom: 10px;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .section-header .btn {
            margin-top: 15px;
            width: 100%;
        }
    }

    /* Full screen specific styles */
    @media screen and (display-mode: fullscreen) {
        .sidebar {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 250px;
        }

        .mobile-menu-btn {
            display: none;
        }

        .overlay {
            display: none;
        }

        .close-sidebar {
            display: block;
        }
    }
</style>
<br>
<h1 style='text-align: center;'>Add Category</h1>
<div style="max-width: 600px; margin: 20px auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">

    <form style="display: flex; flex-direction: column; gap: 15px;" method="Post">
        <div style="display: flex; flex-direction: column; gap: 5px;">
            <label style="font-weight: 500; color: #333;">Category Name</label>
            <input
                type="text"
                style="padding: 10px;border: 1px solid #ddd;border-radius: 4px;font-size: 16px;"
                name="catname" required>
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            style="
                background-color: #0d6efd;
                color: white;
                border: none;
                padding: 12px;
                border-radius: 5px;
                font-size: 16px;
                font-weight: 500;
                cursor: pointer;
                transition: background-color 0.3s;
                margin-top: 10px;"
            onmouseover="this.style.backgroundColor='#0b5ed7'"
            onmouseout="this.style.backgroundColor='#0d6efd'"
            name="insert">
            CategoryInsert
        </button>
    </form>
</div>
<script>
    // Toggle mobile menu
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const sidebar = document.querySelector('.sidebar');
    const closeSidebarBtn = document.querySelector('.close-sidebar');
    const overlay = document.querySelector('.overlay');
    const mainContent = document.querySelector('.main-content');

    function openSidebar() {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        mainContent.classList.add('sidebar-open');
    }

    function closeSidebar() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = 'auto';
        mainContent.classList.remove('sidebar-open');
    }

    mobileMenuBtn.addEventListener('click', openSidebar);
    closeSidebarBtn.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);

    // Toggle user dropdown
    const userProfile = document.querySelector('.user-profile');
    const userDropdown = document.querySelector('.user-dropdown');

    userProfile.addEventListener('click', function(e) {
        e.stopPropagation();
        userDropdown.classList.toggle('active');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function() {
        userDropdown.classList.remove('active');
    });

    // Prevent dropdown from closing when clicking inside it
    userDropdown.addEventListener('click', function(e) {
        e.stopPropagation();
    });

    // Handle window resize
    function handleResize() {
        if (window.innerWidth > 1200 && !document.fullscreenElement) {
            sidebar.classList.add('active');
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
            mainContent.classList.add('sidebar-open');
            document.querySelector('.mobile-menu-btn').style.display = 'none';
            document.querySelector('.close-sidebar').style.display = 'none';
        } else if (!document.fullscreenElement) {
            sidebar.classList.remove('active');
            mainContent.classList.remove('sidebar-open');
            document.querySelector('.mobile-menu-btn').style.display = 'block';
            document.querySelector('.close-sidebar').style.display = 'block';
        }
    }

    // Fullscreen change event
    function handleFullscreenChange() {
        if (document.fullscreenElement) {
            sidebar.classList.add('active');
            mainContent.classList.add('sidebar-open');
            document.querySelector('.mobile-menu-btn').style.display = 'none';
            document.querySelector('.close-sidebar').style.display = 'block';
            overlay.classList.remove('active');
        } else {
            if (window.innerWidth <= 1200) {
                sidebar.classList.remove('active');
                mainContent.classList.remove('sidebar-open');
                document.querySelector('.mobile-menu-btn').style.display = 'block';
            }
        }
    }

    // Initialize on load
    document.addEventListener('DOMContentLoaded', function() {
        handleResize();

        // Check if in fullscreen mode
        if (document.fullscreenElement) {
            handleFullscreenChange();
        }
    });

    window.addEventListener('resize', handleResize);
    document.addEventListener('fullscreenchange', handleFullscreenChange);
</script>
<?php require_once '../include/footer.php'; ?>