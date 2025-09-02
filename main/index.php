<?php
ini_set('display_errors', '1');
// 	require '../includes/PHPMailer.php';
// 	require '../includes/SMTP.php';
// 	require '../includes/Exception.php';
// //Define name spaces
// 	use PHPMailer\PHPMailer\PHPMailer;
// 	use PHPMailer\PHPMailer\SMTP;
// 	use PHPMailer\PHPMailer\Exception;
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>NURTW - Member Email Verification</title>
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
                            <div class="btn-section clearfix">
                                <a href="member_login.php" class="link-btn active btn-1 active-bg default-bg">Login</a>
                                <a href="index.php" class="link-btn btn-2">Register</a>
                            </div>
                                <div>
                                    <a href="../">
                                        <img src="assets/img/logos/nurtw-logo.jpg" alt="logo">
                                    </a> <br><br>
                                    <h1>Verify Email</h1>
                                    <p>Enter your email address to receive the OTP</p>
                                </div>
                                <form method="post">
                                    <?php
                                        include ("db_conn.php");
                                        error_reporting(E_ALL);

                                        $rand = rand(1000, 9999);
                                        $today = date("dmy");
                                        $UID = "NURTW" . $today . $rand;
                                        if (isset($_REQUEST["submit"])) {
                                            $emailreg = $_REQUEST["email"];
                                            $uin = $_REQUEST["uin"];
                                            $otp = $rand;

                                            // Check for duplicate record
                                            $check = mysqli_query($conn, "SELECT * FROM member WHERE uin = '$uin' OR email = '$emailreg'");
                                            $checkrow = mysqli_num_rows($check);
                                            
                                            if ($checkrow > 0) {
                                                echo "<script>alert('User already exists!');</script>";
                                            } else {
                                                $query = "INSERT INTO member (uin, email, otp, `status`) VALUES ('$uin', '$emailreg', '$otp', 'Pending')";
                                                $result = mysqli_query($conn, $query);
                                                if ($result) {

                                                    //  Create instance of PHPMailer
// 	$mail = new PHPMailer();
// //Set mailer to use smtp
// 	$mail->isSMTP();
// //Define smtp host
// 	$mail->Host = "mail.wetindey.com.ng";
// //Enable smtp authentication
// 	$mail->SMTPAuth = true;
// //Set smtp encryption type (ssl/tls)
// 	$mail->SMTPSecure = "tls";
// //Port to connect smtp
// 	$mail->Port = "587";
// //Set gmail username
// 	$mail->Username = "olisrab@wetindey.com.ng";
// //Set gmail password
// 	$mail->Password = "Israelboy01!";
// //Email subject
// 	$mail->Subject = "OTP Verification";
// //Set sender email
// 	$mail->setFrom('olisrab@wetindey.com.ng', 'NURTW');
// //Enable HTML
// 	$mail->isHTML(true);
// //Attachment


// //Email body
// 	$mail->Body = "<style>
//         html,
//         body {
//             margin: 0 auto !important;
//             padding: 0 !important;
//             height: 100% !important;
//             width: 100% !important;
//             font-family: 'Roboto', sans-serif !important;
//             font-size: 14px;
//             margin-bottom: 10px;
//             line-height: 24px;
//             color: #8094ae;
//             font-weight: 400;
//         }
//         * {
//             -ms-text-size-adjust: 100%;
//             -webkit-text-size-adjust: 100%;
//             margin: 0;
//             padding: 0;
//         }
//         table,
//         td {
//             mso-table-lspace: 0pt !important;
//             mso-table-rspace: 0pt !important;
//         }
//         table {
//             border-spacing: 0 !important;
//             border-collapse: collapse !important;
//             table-layout: fixed !important;
//             margin: 0 auto !important;
//         }
//         table table table {
//             table-layout: auto;
//         }
//         a {
//             text-decoration: none;
//         }
//         img {
//             -ms-interpolation-mode:bicubic;
//         }
//     </style>

//     <center style='width: 100%; background-color: #f5f6fa;'>
//         <table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#f5f6fa'>
//             <tr>
//                <td style='padding: 40px 0;'>
//                     <table style='width:100%;max-width:620px;margin:0 auto;'>
//                         <tbody>
//                             <tr>
//                                 <td style='text-align: center; padding-bottom:25px'>
//                                     <a href='#'><img style='height: 60px' src='https://wetindey.space/logo.png' alt='logo'></a>
//                                 </td>
//                             </tr>
//                         </tbody>
//                     </table>
//                     <table style='width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;'>
//                         <tbody>
//                             <tr>
//                                 <td style='padding: 30px 30px 15px 30px; text-align: center;'>
//                                     <h2 style='font-size: 18px; color: #84B700; font-weight: 600; margin: 0;'>One Time Password</h2>
//                                 </td>
//                             </tr>
//                             <tr>
//                                 <td style='padding: 0 30px 20px; text-align: center;'>
//                                     <p style='margin-bottom: 10px;'>Hi there,</p>
//                                     <p style='margin-bottom: 10px;'>Your OTP to complete your registration is:</p>
//                                     <h1 style='font-size: 35px; color: #84B700; font-weight: 600; margin: 0;'> $otp</h1>
                                
//                                 </td>
//                             </tr>
                           
                           
//                         </tbody>
//                     </table>
//                     <table style='width:100%;max-width:620px;margin:0 auto;'>
//                         <tbody>
//                             <tr>
//                                 <td style='text-align: center; padding:25px 20px 0;'>
//                                     <p style='font-size: 13px;'>Copyright © 2020 Olisrab. All rights reserved. <br> </p>
                                    
//                                     <p style='padding-top: 15px; font-size: 12px;'>This email was sent to you as a registered user on <a style='color: #84B700; text-decoration:none;' href='#'>Olisrab</a>.</p>
//                                 </td>
//                             </tr>
//                         </tbody>
//                     </table>
//                </td>
//             </tr>
//         </table>
//     </center>";
// //Add recipient
// 	$mail->addAddress("$emailreg");
// //Finally send email
// 	if ( $mail->send() ) {

                                                    echo "<script>alert('OTP sent to $emailreg')
                                                    location.href = 'member_otp.php?uin=$uin&email=$emailreg';</script>";
                                                }
                                            }
                                        }
                                        // }
                                    ?>

                                    
                                    <!-- UIN -->
                                    <input type="text" name="uin" value="<?php echo $UID;?>" hidden>

                                    <div class="form-group">
                                        <label for="first_field" class="form-label">Email address</label>
                                        <input name="email" type="email" class="form-control" id="email"
                                            placeholder="Email Address" aria-label="Email Address">
                                    </div>
                                    <div class="form-group clearfix">
                                        <button type="submit" name="submit"
                                            class="btn btn-primary btn-lg btn-theme">Send OTP</button>
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