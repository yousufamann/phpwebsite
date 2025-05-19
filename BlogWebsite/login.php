<?php
include('database.php');
session_start();
if (isset($_SESSION['id'])) {
    header('Location: website/home.php');
}


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$pass'");

    if (mysqli_num_rows($sql) > 0) {
        while ($q = mysqli_fetch_assoc($sql)) {
            $_SESSION['name'] = $q['name'];
            $_SESSION['email'] = $q['email'];
            $_SESSION['role'] = $q['role'];
            $_SESSION['status'] = $q['status'];
            $_SESSION['id'] = $q['id'];

            $id = $q['id'];
            mysqli_query($con, "UPDATE `users` SET `status`='Active' WHERE `id`='$id'");


            $role = $q['role'];
            if ($role == 'User') {
                $_SESSION['Login_success'] = "Wellcome To User Website!";
                header('location: website/home.php');
            } else if ($role == 'Admin') {
                $_SESSION['Login_success'] = "Wellcome To Admin Dashbaord!";
                header('location: dashbaord/index.php');
            } else {
                header('location: register.php');
            }
        }
    } else {
        $login_error = "Login Not Successful!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="./dashbaord/uploads-images/logou.jpg" type="image/png">
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
            background-color: #f9fafb;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #1e88e5, #0d47a1);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            overflow: hidden;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 0 20px;
        }

        /* Login Card */
        .login-card {
            background: var(--white);
            border-radius: 10px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            padding: 40px;
            text-align: center;
            transform: translateY(0);
            opacity: 1;
            transition: var(--transition);
            animation: fadeInUp 0.8s ease;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to bottom right,
                    rgba(255, 255, 255, 0.1),
                    rgba(255, 255, 255, 0));
            transform: rotate(30deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% {
                transform: translateX(-100%) rotate(30deg);
            }

            100% {
                transform: translateX(100%) rotate(30deg);
            }
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            color: var(--primary-dark);
            font-size: 28px;
            font-weight: bold;
        }

        .logo i {
            margin-right: 10px;
            font-size: 32px;
        }

        .login-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: var(--black);
            position: relative;
            display: inline-block;
        }

        .login-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: var(--primary-color);
            border-radius: 3px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-gray);
            transition: var(--transition);
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--dark-gray);
            transition: var(--transition);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid var(--medium-gray);
            border-radius: 5px;
            font-size: 16px;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.2);
        }

        .form-control:focus+i {
            color: var(--primary-color);
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to bottom right,
                    rgba(255, 255, 255, 0.3),
                    rgba(255, 255, 255, 0));
            transform: rotate(30deg);
            animation: shine 3s infinite;
            opacity: 0;
            transition: var(--transition);
        }

        .btn:hover::after {
            opacity: 1;
        }

        .forgot-password {
            display: block;
            text-align: right;
            margin-top: 5px;
            font-size: 14px;
            color: var(--dark-gray);
            text-decoration: none;
            transition: var(--transition);
        }

        .forgot-password:hover {
            color: var(--primary-color);
        }

        .register-link {
            margin-top: 20px;
            font-size: 14px;
            color: var(--dark-gray);
        }

        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Floating Animation */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Particles Background */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: float linear infinite;
        }

        @keyframes float {
            to {
                transform: translateY(-100vh) rotate(360deg);
            }
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

        /* Responsive Styles */
        @media (max-width: 576px) {
            .login-card {
                padding: 30px 20px;
            }

            .logo {
                font-size: 24px;
            }

            .logo i {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>
    <!-- Particles Background -->
    <div class="particles" id="particles"></div>

    <div class="container">
        <div class="login-card floating">
            <h1 class="login-title">Welcome Back</h1>

            <?php if (isset($_SESSION['Registration_success'])): ?>
                <div style="color: #1e88e5; padding:10px; text-align:center;font-weight: bold;">
                    <?php
                    echo $_SESSION['Registration_success'];
                    unset($_SESSION['Registration_success']);
                    ?>
                </div>
            <?php endif; ?>


            <?php if (isset($login_error)): ?>
                <div style="color: #c62828; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center;font-weight: bold;">
                    <?php echo $login_error; ?>
                </div>
            <?php endif; ?>
            <form method='Post'>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="text" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="pass" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" name="login" class="btn">Login</button>
                <p class="register-link">Don't have an account? <a href="register.php">Sign up</a></p>
            </form>
        </div>
    </div>

    <script>
        // Create particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Random size between 2px and 6px
                const size = Math.random() * 4 + 2;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;

                // Random position
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.bottom = `-${size}px`;

                // Random animation duration between 10s and 20s
                const duration = Math.random() * 10 + 10;
                particle.style.animationDuration = `${duration}s`;

                // Random delay
                particle.style.animationDelay = `${Math.random() * 5}s`;

                // Random opacity
                particle.style.opacity = Math.random() * 0.5 + 0.1;

                particlesContainer.appendChild(particle);
            }
        }

        // Form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // Simple validation
            if (username.trim() === '' || password.trim() === '') {
                alert('Please fill in all fields');
                return;
            }

            // Here you would typically send the data to your server
            console.log('Login attempt with:', {
                username,
                password
            });

            // Simulate login success
            const loginCard = document.querySelector('.login-card');
            loginCard.style.transform = 'translateY(-20px)';
            loginCard.style.opacity = '0';

            setTimeout(() => {
                alert('Login successful! Redirecting to dashboard...');
                window.location.href = 'dashboard.php'; // Redirect to dashboard
            }, 500);
        });

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
        });
    </script>
</body>

</html>