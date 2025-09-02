<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>NURTW - Admin Forget Password</title>
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
<div class="login-3 bodycolor">
    <div class="login-3-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-info">
                        <div class="form-section align-self-center">
                            <div class="btn-section clearfix">
                                <a href="admin_login.php" class="link-btn active btn-1 default-bg">Login</a>
                                <a href="admin_index.php" class="link-btn btn-2 default-bg">Register</a>
                            </div>
                            <div class="logo">
                                <a href="../">
                                    <img src="assets/img/logos/nurtw-logo.jpg" style="width: 50px; height: 50px;" alt="logo">
                                </a>
                            </div>
                            <h1>Forgot Password</h1>
                            <p>Recover Your Password</p>
                            <div class="clearfix"></div>
                            <form method="post">
                                <div class="form-group">
                                    <label for="first_field" class="form-label">Email address</label>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="Email Address" aria-label="Email Address">
                                </div>
                                <div class="form-group clearfix">
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg btn-theme">Send Me Email</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let email = document.getElementById("email").value;
    let submit = document.getElementById("submit");

    submit.addEventListener("click", () => {
        if (email == "" || email == null) {
            alert("Please enter a valid email address");
            return;
        } else if (!email.includes("@")) {
            alert("Please enter a valid email address");
            return;
        } else {
            alert("Password reset link has been sent to your email address");
        }
    })
</script>
</body>
</html>
