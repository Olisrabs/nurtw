<?php
  include("db_conn.php");
  if (isset($_REQUEST["uin"])) {
    $query = "SELECT * FROM member WHERE uin='$_REQUEST[uin]'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
  }
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>NURTW - Member Register</title>
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
        .hidden {
            display: none;
        }

        .next {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body id="top" class="login-3-bodycolor">
    <div class="page_loader"></div>

    <div class="login-3">
        <div class="login-3-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-info">
                            <div class="form-section align-self-center">
                                <div class="btn-section clearfix">
                                    <a href="member_login.php" class="link-btn active-bg btn-1 default-bg">Login</a>
                                </div>
                                <div class="logo">
                                    <a href="../">
                                        <img src="assets/img/logos/nurtw-logo.jpg" style="width: 50px; height: 50px;"
                                            alt="logo">
                                    </a>
                                </div>
                                <h1>Welcome!</h1>
                                <h3>Create An Account</h3>
                                <div class="clearfix"></div>
                                <form method="post" enctype="multipart/form-data">
                                    <?php
                                    include("db_conn.php");
                                    error_reporting(E_ALL);
                                    $uid = uniqid();
                                    if (isset($_REQUEST["submit"])) {
                                        $fname = $_REQUEST["name"];
                                        $phone = $_REQUEST["phone"];
                                        $dob = $_REQUEST["dob"];
                                        $gender = $_REQUEST["gender"];
                                        $state_of_origin = $_REQUEST["state_of_origin"];
                                        $lga = $_REQUEST["lga"];
                                        $state_of_work = $_REQUEST["state_of_work"];
                                        $station_of_work = $_REQUEST["station_of_work"];
                                        $vehicle = $_REQUEST["vehicle"];
                                        $vin = $_REQUEST["vin"];
                                        $password = $_REQUEST["password"];
                                        $uin = $row['uin'];

                                        
                                        $driver_license = $uin . $_FILES["driver_license"]["name"];
                                        $target = "../driver_license/";
                                        $target = $target . $uin . $_FILES["driver_license"]["name"];

                                        $passport = $uid . $_FILES["passport"]["name"];
                                        $target2 = "../member_photo/";
                                        $target2 = $target2 . $uid . $_FILES["passport"]["name"];

                                        if (move_uploaded_file($_FILES["driver_license"]["tmp_name"], $target) && move_uploaded_file($_FILES["passport"]["tmp_name"], $target2)) {
                                            $query = "UPDATE member SET fullname='$fname', phone='$phone', dob='$dob', state_of_origin='$state_of_origin', lga='$lga', state_of_work='$state_of_work', station_of_work='$station_of_work', gender='$gender', vehicle='$vehicle', vin='$vin', driver_license='$driver_license', `password`=PASSWORD('$password'), photo='$passport' WHERE uin='$uin'";

                                            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                            if ($result) {
                                                echo "<script>alert('Registration successful!')
                                                location.href='member_login.php'</script>";
                                            } else {
                                                echo "<script>alert('Error: " . mysqli_error($conn) . "')</script>";
                                            }
                                        } else {
                                            echo "<script>alert('Failed to upload driver's license. Please try again.')</script>";
                                        }

                                    }
                                    ?>
                                    
                                    <!-- Step 1 => Personal Details -->
                                    <div id="step1">
                                        <!-- Full name -->
                                        <div class="form-group">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input name="name" type="text" class="form-control" id="name"
                                                placeholder="Full Name" aria-label="Full Name" required>
                                        </div>
                                        <!-- Phone number -->
                                        <div class="form-group">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input name="phone" type="text" class="form-control" id="phone"
                                                placeholder="Phone Number" aria-label="Phone Number" required>
                                        </div>
                                        <!-- D.O.B -->
                                        <div class="form-group">
                                            <label for="dob" class="form-label">D.O.B</label>
                                            <input name="dob" type="date" class="form-control" id="dob"
                                                aria-label="D.O.B" required>
                                        </div>
                                        <!-- Gender -->
                                        <div class="form-group">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select name="gender" id="gender" class="form-control" required>
                                                <option value="">-- Select Gender --</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                        <!-- State of Origin -->
                                        <div class="form-group">
                                            <label for="state_of_origin" class="form-label">State of Origin</label>
                                            <select name="state_of_origin" id="state_of_origin" class="form-control"
                                                onchange="updateLGA()" required>
                                                <option value="">-- Select State --</option>
                                            </select>
                                        </div>
                                        <!-- L.G.A -->
                                        <div class="form-group">
                                            <label for="lga" class="form-label">L.G.A</label>
                                            <select name="lga" id="lga" class="form-control" required>
                                                <option value="">-- Select L.G.A --</option>
                                            </select>
                                        </div>
                                        <!-- Next -->
                                        <div class="form-group clearfix">
                                            <input type="button" value="Next" class="btn btn-primary btn-lg btn-theme"
                                                onclick="showNextStep(1)">
                                        </div>
                                    </div>
                                    <!-- Step 1 End -->

                                    <!-- Step 2 => Work Details -->
                                    <div id="step2" class="hidden">
                                        <!-- State of Work -->
                                        <div class="form-group">
                                            <label for="state_of_work" class="form-label">State of Work</label>
                                            <select name="state_of_work" id="state_of_work" class="form-control"
                                                required>
                                                <option value="">-- Select State --</option>
                                            </select>
                                        </div>
                                        <!-- Station of Work -->
                                        <div class="form-group">
                                            <label for="station_of_work" class="form-label">Station of Work</label>
                                            <select name="station_of_work" id="station_of_work" class="form-control"
                                                required>
                                                <option value="">-- Select Station --</option>
                                            </select>
                                        </div>
                                        <!-- Vehicle -->
                                        <div class="form-group">
                                            <label for="vehicle" class="form-label">Vehicle</label>
                                            <input name="vehicle" type="text" class="form-control" id="vehicle"
                                                placeholder="Vehicle" aria-label="vehicle" required>
                                        </div>
                                        <!-- VIN -->
                                        <div class="form-group">
                                            <label for="vin" class="form-label">Vin</label>
                                            <input name="vin" type="text" class="form-control" id="vin"
                                                placeholder="Vin" aria-label="vin" required>
                                        </div>
                                        <!-- Driver's License -->
                                        <div class="form-group">
                                            <label for="driver_license" class="form-label">Driver's License</label>
                                            <input name="driver_license" type="file"
                                                accept=".jpg,.jpeg,.png,.pdf,.JPG,.JPEG,.PNG,.PDF" class="form-control"
                                                id="driver_license" aria-label="driver_license" required>
                                        </div>
                                        <!-- Passport -->
                                        <div class="form-group">
                                            <label for="passport" class="form-label">Passport</label>
                                            <input name="passport" type="file"
                                                accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG" class="form-control"
                                                id="passport" aria-label="passport" required>
                                        </div>
                                        <!-- Next -->
                                        <div class="next">
                                            <div class="form-group clearfix">
                                                <input type="button" value="Previous" class="btn btn-primary btn-lg btn-theme"
                                                    onclick="showPreviousStep(2)">
                                            </div>
                                            <div class="form-group clearfix">
                                                <input type="button" value="Next" class="btn btn-primary btn-lg btn-theme"
                                                    onclick="showNextStep(2)">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Step 2 End -->

                                    <!-- Step 3 => Security Details -->
                                    <div id="step3" class="hidden">
                                        <!-- Password -->
                                        <div class="form-group clearfix">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" min="8"
                                                autocomplete="off" id="password" oninput="validatePassword()" placeholder="Password"
                                                aria-label="Password" required>
                                                <div id="feedback"></div>
                                        </div>
                                        <!-- Confirm Password -->
                                        <div class="form-group clearfix">
                                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                                            <input name="password" type="password" class="form-control" min="8" autocomplete="off"
                                                id="confirmPassword" oninput="validatePassword()" placeholder="Confirm Password"
                                                aria-label="Confirm Password" required>
                                                <div id="feedback2"></div>
                                        </div>
                                        <!-- Terms of Service -->
                                        <div class="form-group checkbox clearfix">
                                            <div class="clearfix float-start">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" id="rememberme" required>
                                                    <label class="form-check-label" for="rememberme">
                                                        I agree to the terms of service
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Submit -->
                                        <div class="next">
                                            <div class="form-group clearfix">
                                                <button class="btn btn-primary btn-lg btn-theme"
                                                    onclick="showPreviousStep(3)">Previous</button>
                                            </div>
                                            <div class="form-group clearfix">
                                                <button type="submit" name="submit" id="submit"
                                                    class="btn btn-primary btn-lg btn-theme">Register</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Step 3 End -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
</body>

</html>