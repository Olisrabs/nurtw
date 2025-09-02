<?php
include('session_check.php');
include('db_conn.php');
$id = 1;
$sql = "SELECT * FROM staff WHERE id='$id'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$rows = mysqli_fetch_array($result);
?>

<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/images/brand/favicon.ico"> -->

    <!-- TITLE -->
    <title>NURTW - Add Driver</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE CSS -->
     <link href="assets/css/style.css" rel="stylesheet">

	<!-- Plugins CSS -->
    <link href="assets/css/plugins.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="assets/css/icons.css" rel="stylesheet">

    <!-- INTERNAL Switcher css -->
    <link href="assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="assets/switcher/demo.css" rel="stylesheet">

</head>

<body class="app sidebar-mini ltr light-mode">

    <?php include('menu.php'); ?>

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Add New Driver</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Drivers</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Drivers</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- ROW OPEN -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Enter New Driver's Information</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                                            <?php
                                                error_reporting(E_ALL);
                                                $rand = rand(1000, 9999);
                                                $today = date("dmy");
                                                $ID = "NURTW" . $today . $rand;
                                                if (isset($_REQUEST["submit"])) {
                                                    $uin = $_REQUEST["uin"];
                                                    $fname = $_REQUEST["fullname"];
                                                    $email = $_REQUEST["email"];
                                                    $phone = $_REQUEST["phone"];
                                                    $dob = $_REQUEST["dob"];
                                                    $state_of_origin = $_REQUEST["state_of_origin"];
                                                    $lga = $_REQUEST["lga"];
                                                    $state_of_work = $_REQUEST["state_of_work"];
                                                    $station_of_work = $_REQUEST["station_of_work"];
                                                    $gender = $_REQUEST["gender"];
                                                    $vehicle = $_REQUEST["vehicle"];
                                                    $vin = $_REQUEST["vin"];
                                                    $password = $_REQUEST["password"];

                                                    $driver_license = $uin . $_FILES["driver_license"]["name"];
                                                    $target = "../driver_license/";
                                                    $target = $target . $driver_license;
    // Webcam
    $img = $_POST['image'];
    $folderPath = "../member_photo/";

    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];

    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';

    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);

                                                    // Check for duplicate record
                                                    $check = "SELECT * FROM member WHERE uin='$uin' OR email='$email' OR phone='$phone'";
                                                    $checkrow = mysqli_query($conn, $check);

                                                    if (mysqli_num_rows($checkrow) > 0) {
                                                        echo "<div class='alert alert-danger'>Driver's record already exists.</div>";
                                                    } else {

                                                    if (move_uploaded_file($_FILES["driver_license"]["tmp_name"], $target)) {
                                                        $query = "INSERT INTO member (uin, fullname, phone, email, dob, state_of_origin, lga, state_of_work, station_of_work, gender, vehicle, vin, driver_license, `status`, photo, `password`) VALUES ('$uin', '$fname', '$phone', '$email', '$dob', '$state_of_origin', '$lga', '$state_of_work', '$station_of_work', '$gender', '$vehicle', '$vin', '$driver_license', 'Active', '$fileName', PASSWORD('$password'))";
                                                        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                                        if ($result) {
                                                            echo "<div class='alert alert-success'>Driver added successfully!</div>";
                                                        } else {
                                                            echo "<div class='alert alert-danger'>Error adding driver.</div>";
                                                        }
                                                    } else {
                                                        echo "<div class='alert alert-danger'>Error uploading driver license.</div>";
                                                    }

                                                }}
                                            ?>

                                            <input type="text" name="uin" value="<?php echo $ID; ?>" hidden>
                                            <div class="form-row">
                                                <!-- Photo Capture -->
                                                <div class="col-xl-6 mb-3">
                                                    <label for="validationCustom01">Capture</label>
                                                    <div id="my_camera"></div>
                                                    <input class="btn btn-primary" type=button value="Take Snapshot" onClick="take_snapshot()">
                                                    <input type="hidden" name="image" class="image-tag">
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                                <!-- Capture Result -->
                                                <div class="col-xl-6 mb-3">
                                                    <label for="validationCustom01">Result</label>
                                                    <div id="results"> Your captured image will appear here...</div>
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                                <script src="assets/js/webcam.min.js"></script>

                                        <script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 100
    });

    Webcam.attach( '#my_camera' );

    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>
                                                <!-- Full name -->
                                                <div class="col-xl-3 mb-3">
                                                    <label for="validationCustom01">Full name</label>
                                                    <input type="text" name="fullname" class="form-control" id="validationCustom01"
                                                        placeholder="Abimbola Israel" required>
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                                <!-- Email -->
                                                <div class="col-xl-3 mb-3">
                                                    <label for="validationCustom02">Email</label>
                                                    <input type="email" name="email" class="form-control" id="validationCustom02"
                                                        placeholder="nurtw@gmail.com" required>
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                                <!-- Phone -->
                                                <div class="col-xl-3 mb-3">
                                                    <label for="validationCustom03">Phone</label>
                                                    <input type="text" name="phone" class="form-control" id="validationCustom03"
                                                        placeholder="08012345678" required>
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                                <!-- D.O.B -->
                                                <div class="col-xl-3 mb-3">
                                                    <label for="validationCustom04">D.O.B</label>
                                                    <input type="date" name="dob" class="form-control" id="validationCustom04" required>
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <!-- State of Origin -->
                                                <div class="col-xl-3 mb-3">
                                                    <label for="state_of_origin">State of Origin</label>
                                                    <select onchange="updateLGA()" name="state_of_origin" id="state_of_origin" class="form-control select2" required>
                                                        <option value="">Select State of Origin</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please provide a valid state of origin.</div>
                                                </div>
                                                <!-- L.G.A -->
                                                <div class="col-xl-3 mb-3">
                                                    <label for="lga">L.G.A</label>
                                                    <select class="form-control select2" name="lga" id="lga"
                                                        required>
                                                        <option selected disabled value="">Select L.G.A</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a valid L.G.A.</div>
                                                </div>
                                                <!-- State of Work -->
                                                <div class="col-xl-3 mb-3">
                                                    <label for="state_of_work">State of Work</label>
                                                    <select name="state_of_work" id="state_of_work" class="form-control select2" required>
                                                        <option value="">Select State of Work</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please provide a valid state of work.</div>
                                                </div>
                                                <!-- Station of Work -->
                                                <div class="col-xl-3 mb-3">
                                                    <label for="station_of_work">Station of Work</label>
                                                    <select class="form-control select2" name="station_of_work" id="station_of_work"
                                                        required>
                                                        <option selected disabled value="">Select Station of Work</option>
                                                        <option value="oshosdi">Oshodi</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a valid Station of Work.</div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <!-- Gender -->
                                                <div class="col-xl-3 mb-3">
                                                    <label for="validationCustom09">Gender</label>
                                                    <select class="form-control select2" name="gender" id="validationCustom09" required>
                                                        <option selected disabled value="">Select Gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a valid Gender.</div>
                                                </div>
                                                <!-- Vehicle -->
                                                <div class="col-xl-3 mb-3">
                                                    <label for="validationCustom10">Vehicle</label>
                                                    <input type="text" name="vehicle" class="form-control" id="validationCustom10"
                                                        placeholder="Enter Vehicle" required>
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                                <!-- VIN -->
                                                <div class="col-xl-3 mb-3">
                                                    <label for="validationCustom11">VIN</label>
                                                    <input type="text" name="vin" class="form-control" id="validationCustom11"
                                                        placeholder="Enter VIN" required>
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                                <!-- Driver's License -->
                                                <div class="col-xl-3 mb-3">
                                                    <label for="validationCustom12">Driver's License</label>
                                                    <input type="file" name="driver_license" class="form-control" id="validationCustom12" accept=".jpg, .jpeg, .png, .pdf, .JPG, .JPEG, .PNG, .PDF" required>
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <!-- Password -->
                                                <div class="col-xl-6 mb-3">
                                                    <label for="validationCustom10">Password</label>
                                                    <input type="password" name="password" class="form-control" id="password"
                                                        placeholder="Enter Password" required>
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="invalidCheck" required>
                                                    <label class="form-check-label" for="invalidCheck">Agree to terms and
                                                        conditions</label>
                                                    <div class="invalid-feedback">You must agree before submitting.</div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-block" onclick="return confirm('Are you sure you want to submit the form?');" name="submit" type="submit">Submit form</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ROW CLOSED -->
                    </div>
                    <!-- CONTAINER CLOSED -->
                </div>
            </div>
            <!--app-content closed-->
        </div>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 text-center">
                        Copyright © <span id="year"></span> <a href="https://olisrab.vercel.app/">Olisrab</a>. Designed with <span class="fa fa-heart text-danger"></span> by <a href="https://olisrab.vercel.app/"> Abimbola Israel </a> All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
        <!-- FOOTER END -->
    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!-- JQUERY JS -->
    <script src="assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- INPUT MASK JS-->
    <script src="assets/plugins/input-mask/jquery.mask.min.js"></script>

	<!-- TypeHead js -->
	<script src="assets/plugins/bootstrap5-typehead/autocomplete.js"></script>
    <script src="assets/js/typehead.js"></script>

    <!-- SELECT2 JS -->
    <script src="assets/plugins/select2/select2.full.min.js"></script>

    <!-- FORMVALIDATION JS -->
    <script src="assets/js/form-validation.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="assets/plugins/p-scroll/perfect-scrollbar.js"></script>
    <script src="assets/plugins/p-scroll/pscroll.js"></script>
    <script src="assets/plugins/p-scroll/pscroll-1.js"></script>

    <!-- SIDE-MENU JS -->
    <script src="assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- SIDEBAR JS -->
    <script src="assets/plugins/sidebar/sidebar.js"></script>

    <!-- Color Theme js -->
    <script src="assets/js/themeColors.js"></script>

    <!-- Sticky js -->
    <script src="assets/js/sticky.js"></script>

    <!-- CUSTOM JS -->
    <script src="assets/js/custom.js"></script>

    <!-- Custom-switcher -->
    <script src="assets/js/custom-swicher.js"></script>

    <!-- Switcher js -->
    <script src="assets/switcher/js/switcher.js"></script>

    <!-- Dependable dropdown js -->
     <script src="../main/assets/js/main.js"></script>

</body>

</html>