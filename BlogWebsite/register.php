<?php
session_start();
include('database.php');
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    $query = mysqli_query($con, "INSERT INTO `users`(`name`, `email`, `password`,`role`,`status`) VALUES ('$name','$email','$pass','User','InActive')");

    if ($query) {
        if ($pass == $cpass) {
            $_SESSION['Registration_success'] = "Registration Successful";
            header('location:login.php');
        }
         else {
            $register_error = 'Password And ConfirmPassword Not correct!.';
        }
    } else {
        $register_error = 'Registration Not Successful!.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="./dashbaord/uploads-images/logou.jpg" type="image/png">    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="formAssets/style.css">
</head>

<body>
    <!-- Particles Background -->
    <div class="particles" id="particles"></div>
    <div class="container">
        <div class="register-card floating">
            <h1 class="register-title">Create Your Account</h1>
            <?php if (isset($register_error)): ?>
                <div style="color: #c62828; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center;font-weight: bold;">
                    <?php echo $register_error; ?>
                </div>
            <?php endif; ?>
            <form method="Post">
                <div class="form-group">
                    <label for="fullname">Name</label>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="pass" class="form-control" placeholder="Enter your password" required> 
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="cpass" class="form-control" placeholder="Confirm your password" required>
                    </div>
                </div>
                <button type="submit" name="register" class="btn">Register</button>
                <p class="login-link">Already have an account? <a href="login.php">Sign in</a></p>
            </form>
        </div>
    </div>

    <script src="formAssets/script.js"></script>
</body>

</html>