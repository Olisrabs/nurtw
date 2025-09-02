<?php
session_start();
require('db_conn.php');

if (isset($_POST['identifier']) && isset($_POST['password'])) {
    $identifier = stripslashes($_POST['identifier']);
    $identifier = mysqli_real_escape_string($conn, $identifier);

    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    // Check if identifier matches either email or phone
    $query = "
        SELECT * FROM `member`
        WHERE (`email` = '$identifier' OR `phone` = '$identifier') 
        AND password = PASSWORD('$password') 
        AND `status` = 'Active' 
        LIMIT 1
    ";

    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $rows = mysqli_num_rows($result);

    if ($rows == 1) {
        $user = mysqli_fetch_assoc($result);

        // ✅ Set session variables
        $_SESSION['email'] = $user['email'];
        $_SESSION['status'] = $user['status'];

        // ✅ Role-based redirection
        if ($user['status'] == 'Active') {
            header("Location: ../dashboard/member_index.php");
        } else {
            echo "<script>alert('You are not an active member.'); location.href='member_login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid login credentials.'); location.href='member_login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>NURTW - Member Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
</head>

<body id="top" class="login-3-bodycolor">
<div class="page_loader"></div>

<!-- Login 3 start -->
<div class="login-3">
    <div class="login-3-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-info">
                        <div class="form-section align-self-center">
                            <div class="btn-section clearfix">
                                <a href="member_login.php" class="link-btn active btn-1 active-bg default-bg">Login</a>
                                <a href="index.php" class="link-btn btn-2">Register</a>
                            </div>
                            <div class="logo">
                                <a href="../">
                                    <img src="assets/img/logos/nurtw-logo.jpg" style="width: 50px; height: 50px;" alt="logo">
                                </a>
                            </div>
                            <h1>Welcome!</h1>
                            <h3>Sign Into Your Account</h3>
                            <div class="clearfix"></div>
                            <form method="post">
                                <div class="form-group">
                                    <label for="first_field" class="form-label">Email / Phone</label>
                                    <input name="identifier" type="text" class="form-control" id="email" placeholder="Enter email or phone" aria-label="Email Address" required>
                                </div>
                                <div class="form-group clearfix">
                                    <label for="second_field" class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control" autocomplete="off" id="password" placeholder="Password" aria-label="Password" required>
                                </div>
                                <div class="checkbox form-group clearfix">
                                    <div class="form-check float-start mb-0">
                                        <input class="form-check-input" type="checkbox" id="rememberme">
                                        <label class="form-check-label" for="rememberme">
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="member_forgot_password.php" class="float-end forgot-password">Forgot your password?</a>
                                </div>
                                <div class="form-group clearfix">
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg btn-theme">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
