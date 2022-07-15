<!DOCTYPE html>

<?php
include "conn.php";
date_default_timezone_set('Asia/Jakarta');

session_start();

if (isset($_SESSION['username'])) {
    header("Location: dashboard/");
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($koneksi,$_POST['username']);
    $password = mysqli_real_escape_string($koneksi,md5($_POST['password']));

    $q = mysqli_query($koneksi, "select * from v_login where username='$username' and password='$password'");
    $row = mysqli_fetch_array($q);

    if (mysqli_num_rows($q) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['fullname'] = $row['nama'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['blokir'] = $row['blokir'];
        $_SESSION['foto'] = $row['foto'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['level'] = $row['level'];

        if ($row['blokir'] == 'Y') {
            session_destroy();
            echo '
            <script type="text/javascript">
            setTimeout(function () { 
                toastr.warning("Username sedang di blokir, harap hubungi administrator", "Oops!", { positionClass: "toastr toast-top-center", containerId: "toast-top-center" });
            }, 1000);
            </script>
            ';
        }
        else {
            if ($_SESSION['role'] == 'admin' && $_SESSION['level'] == 'admin' && $_SESSION['blokir'] == 'N') {
            header("location: dashboard/");
            //} elseif ($_SESSION['job'] == 'IT') {
                //header("location: ../IT");
            }
        }

    } else {
        echo '
        <script type="text/javascript">
        setTimeout(function () { 
            toastr.error("Username/Password yang anda input salah!", "Oops!", { positionClass: "toastr toast-top-center", containerId: "toast-top-center" });
        }, 1000);
        </script>
        ';

    }
}

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="dist/assets/images/favicon.ico">
    <title>Sign In Amartha Inventory</title>
	<link rel="canonical" href="https://www.wrappixel.com/templates/monsteradmin/" />
    <!-- Custom CSS -->
    <link href="dist/assets/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(https://amartha.com/wp-content/uploads/2019/10/rs-pattern.png) no-repeat center center; background-size: cover;">
            <div class="auth-box p-4 bg-white rounded">
                <div id="loginform">
                    <div class="logo text-center">
                        <span class="db"><img style='height: 80%; width: 80%; object-fit: contain' src="dist/assets/images/amartha.png" alt="logo"></span>
                    </div>
                    <div class="logo">
                        <hr>
                    </div>
                    <div class="logo">
                        <h3 class="box-title mb-3">Sign In</h3>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal mt-3 form-material" action="" method="post">
                                <div class="form-group mb-3">
                                    <div class="">
                                        <input class="form-control" name="username" type="text" required="" placeholder="Username"> </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div class="">
                                        <input class="form-control" name="password" type="password" required="" placeholder="Password"> </div>
                                </div>
                                <div class="form-group text-center mt-4">
                                    <div class="col-xs-12">
                                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" name="submit" type="submit">Log In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="dist/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="dist/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="dist/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="dist/assets/libs/sweetalert2/dist/sweetalert2.min.js"></script>
    <!--Toastr JavaScript -->
    <script src="dist/assets/extra-libs/toastr/dist/build/toastr.min.js"></script>
    <script src="dist/assets/extra-libs/toastr/toastr-init.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    </script>
</body>

</html>