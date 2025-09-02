<?php
  include("db_conn.php");
  if (isset($_REQUEST["email"])) {
    $sql = "SELECT * FROM staff WHERE email='$_REQUEST[email]'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $dbotp = $row['otp'];
    $uin = $row['uin'];
  }
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>NURTW - Admin OTP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
    <style>
        img {
            width: 50px;
            height: 50px;
        }

        .otp-box {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .otp-box input {
            width: 22%;
            height: 50px;
            font-size: 24px;
            text-align: center;
            border: 2px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: 0.2s;
        }

        .otp-box input:focus {
            border-color: #198754;
            box-shadow: 0 0 5px rgba(25, 135, 84, 0.5);
        }

        .btn {
            width: 100%;
        }
    </style>
</head>

<body id="top" class="login-3-bodycolor">

    <!-- Login 3 start -->
    <div class="login-3 bodycolor">
        <div class="login-3-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-info">
                            <div class="form-section align-self-center" style="padding: 50px;">
                                <div style="text-align: center;">
                                    <a href="../">
                                        <img src="assets/img/logos/nurtw-logo.jpg" alt="logo">
                                    </a> <br><br>
                                    <h1>Verify OTP</h1>
                                    <p>Check your email for the OTP code</p>
                                </div>
                                <form method="post">
                                    <?php
                                        error_reporting(E_ALL);
                                        if (isset($_REQUEST["submit"])) {
                                            $n1 = $_REQUEST["n1"];
                                            $n2 = $_REQUEST["n2"];
                                            $n3 = $_REQUEST["n3"];
                                            $n4 = $_REQUEST["n4"];
                                            $newotp = $n1 . $n2 . $n3 . $n4;
                                            $email = $row["email"];

                                            if ($newotp == $dbotp) {
                                                $query = "UPDATE staff SET status='Active' WHERE email='$email'";
                                                $result = mysqli_query($conn, $query);
                                                if ($result) {
                                                    echo "<script>alert('OTP verified successfully!')
                                                    location.href='admin_register.php?uin=$uin';</script>";
                                                }
                                            } else {
                                                echo "<script>alert('Invalid OTP. Please try again.');</script>";
                                            }
                                        }
                                    ?>
                                    <div class="form-group">
                                        <label for="first_field" class="form-label">Enter OTP</label>
                                        <div class="otp-box">
                                            <input type="text" name="n1" maxlength="1" inputmode="numeric"
                                                pattern="[0-9]*">
                                            <input type="text" name="n2" maxlength="1" inputmode="numeric"
                                                pattern="[0-9]*">
                                            <input type="text" name="n3" maxlength="1" inputmode="numeric"
                                                pattern="[0-9]*">
                                            <input type="text" name="n4" maxlength="1" inputmode="numeric"
                                                pattern="[0-9]*">
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <button type="submit" name="submit"
                                            class="btn btn-primary btn-lg btn-theme">Verify</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const inputs = document.querySelectorAll('.otp-box input');

        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                const value = e.target.value;
                if (!/^[0-9]$/.test(value)) {
                    e.target.value = ''; // Only digits allowed
                    return;
                }
                if (value && index < inputs.length - 1) {
                    inputs[index + 1].focus(); // Move to next
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === "Backspace" && !e.target.value && index > 0) {
                    inputs[index - 1].focus(); // Move back
                }
            });
        });
    </script>
</body>

</html>