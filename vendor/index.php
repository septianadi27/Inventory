<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php
session_start();
include "../conn.php";
date_default_timezone_set('Asia/Jakarta');

if (empty($_SESSION['username'])) {
    echo '
        <script type="text/javascript">
        setTimeout(function () { 
            toastr.info("Session anda telah habis, Silahkan login kembali!", "Oops!", { positionClass: "toastr toast-top-center", containerId: "toast-top-center",onHidden: function () {
                window.location = "../"
            } });
        }, 1000);
        </script>
        ';
}

$inactive = 1800;

if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_destroy();

        echo '
        <script type="text/javascript">
        setTimeout(function () { 
            toastr.info("Session anda telah habis, Silahkan login kembali!", "Oops!", { positionClass: "toastr toast-top-center", containerId: "toast-top-center",onHidden: function () {
                window.location = "../"
            } });
        }, 1000);
        </script>
        ';
    }
}
$_SESSION['timeout'] = time();

//Fungsi Update
if(isset($_POST['update'])){
    $kode_vendor=$_POST['kode_vendor'];
    $nama_vendor=$_POST['nama_vendor'];
    $alamat=$_POST['alamat'];
    $int_value = (int) $_POST['contact'];
    $contact='0'.$int_value;

    $query = mysqli_query($koneksi,"UPDATE `vendor` SET `nama_vendor` = '$nama_vendor', `alamat` = '$alamat', `contact` = '$contact' WHERE `vendor`.`kode_vendor` = '$kode_vendor'");

    if ($query){
        header("Location:../vendor/");
    } else {
        header("Location:../vendor/");
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
    <link rel="icon" type="image/png" sizes="16x16" href="../dist/assets/images/favicon.ico">
    <title>Daftar Vendor - Amartha Inventory</title>
	<link rel="canonical" href="https://www.wrappixel.com/templates/xtremeadmin/" />
    <link href="../dist/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../dist/js/pages/chartist/chartist-init.css" rel="stylesheet">
    <link href="../dist/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="../dist/assets/libs/c3/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link href="../dist/assets/extra-libs/toastr/dist/build/toastr.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="../dist/assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- DataTables -->
    <link
      rel="stylesheet"
      href="../dist/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
    />
    <link
      rel="stylesheet"
      href="../dist/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
    />
    <link
      rel="stylesheet"
      href="../dist/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"
    />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
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
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../dist/assets/images/amartha-logo-white.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="../dist/assets/images/amartha-logo-white.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="../dist/assets/images/amartha-text.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="../dist/assets/images/amartha-text-white.png" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto float-left">
                        <!-- This is  -->
                        <li class="nav-item"> <a
                                class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark"
                                href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="border-bottom rounded-top py-3 px-4">
                                            <h5 class="mb-0 font-weight-medium">Notifications</h5>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center notifications position-relative" style="height:250px;">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-danger rounded-circle btn-circle"><i class="fa fa-link"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Luanch Admin</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my new admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-success rounded-circle btn-circle"><i class="ti-calendar"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Event today</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just a reminder that you have event</span> <span class="font-12 text-nowrap d-block text-muted">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-info rounded-circle btn-circle"><i class="ti-settings"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Settings</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">You can customize this template as you want</span> <span class="font-12 text-nowrap d-block text-muted">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-primary rounded-circle btn-circle"><i class="ti-user"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Pavan kumar</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link border-top text-center text-dark pt-3" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="../dist/assets/images/users/1.jpg" alt="user" width="30" class="profile-pic rounded-circle" />
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right scale-up">
                                <ul class="dropdown-user list-style-none">
                                    <li>
                                        <div class="dw-user-box p-3 d-flex">
                                            <div class="u-img"><img src="../dist/assets/images/users/1.jpg" alt="user" class="rounded" width="80"></div>
                                            <div class="u-text ml-2">
                                                <h4 class="mb-0"><?php echo $_SESSION['fullname']; ?></h4>
                                                <p class="text-muted mb-1 font-14"><?php echo $_SESSION['email']; ?></p>
                                                <a href="pages-profile.html" class="btn btn-rounded btn-danger btn-sm text-white d-inline-block">View
                                                    Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="dropdown-divider"></li>
                                    <li class="user-list"><a class="px-3 py-2" href="../logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <div class="user-profile position-relative" style="background: url(../dist/assets/images/background/user-info.jpg) no-repeat;">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="../dist/assets/images/users/profile.png" alt="user" class="w-100" /> </div>
                    <!-- User profile text-->
                    <div class="profile-text pt-1"> 
                        <a href="#" class="dropdown-toggle u-dropdown w-100 text-white d-block" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo $_SESSION['fullname']; ?></a>
                        <div class="dropdown-menu animated flipInY"> 
                            <a href="#" class="dropdown-item"><i class="ti-user"></i>
                                My Profile</a> 
                            <div class="dropdown-divider"></div> 
                            <a href="../logout.php" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../dashboard/"
                                aria-expanded="false">
                                <i class="mdi mdi-gauge"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../stock/"
                                aria-expanded="false">
                                <i class="mdi mdi-dropbox"></i>
                                <span class="hide-menu">Stock Barang</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Transaksi Data</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../brg-masuk/"
                                aria-expanded="false">
                                <i class="mdi mdi-import"></i>
                                <span class="hide-menu">Barang Masuk</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../brg-keluar/"
                                aria-expanded="false">
                                <i class="mdi mdi-export"></i>
                                <span class="hide-menu">Barang Keluar</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../vendor/"
                                aria-expanded="false">
                                <i class="mdi mdi-cart"></i>
                                <span class="hide-menu">Vendor</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">User Management</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../user/"
                                aria-expanded="false">
                                <i class="mdi mdi-account-multiple"></i>
                                <span class="hide-menu">User</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Daftar Vendor</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Vendor</li>
                    </ol>
                </div>
                <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                    <div class="d-flex mt-2 justify-content-end">
                        <div class="d-flex ml-2">
                            <h3><div class="date">
								<script type='text/javascript'>
						<!--
						var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
						var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
						var date = new Date();
						var day = date.getDate();
						var month = date.getMonth();
						var thisDay = date.getDay(),
							thisDay = myDays[thisDay];
						var yy = date.getYear();
						var year = (yy < 1000) ? yy + 1900 : yy;
						document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);		
						//-->
						</script></div></h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="card-title">Data Daftar Vendor</h3>
                                    </div>
                                    <div class="col-md-8 text-right d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                                            <button type="button" data-toggle="modal" data-target="#add-modal"
                                            id="btn-add-contact" class="btn btn-info"><i class="fas fa-plus-square font-16 mr-1"></i> Tambah Vendor</button>
                                    </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <hr>
                                <div class="table-responsive">
                                    <table id="example1" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Vendor</th>
                                                <th>Nama Vendor</th>
                                                <th>Alamat</th>
                                                <th>Contact</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no=1;
                                            $query = "SELECT * FROM vendor";
                                            $tampil = mysqli_query($koneksi, $query);
                                            while ($data = mysqli_fetch_array($tampil)) {;?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $data['kode_vendor']; ?></td>
                                                <td><?php echo $data['nama_vendor']; ?></td>
                                                <td><?php echo $data['alamat']; ?></td>
                                                <td><a href="https://api.whatsapp.com/send?phone=62<?php echo $data['contact']; ?>"target="_blank"><?php echo $data['contact']; ?></a></td>
                                                <td><div class="btn-group" role="group">
                                                    <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-settings font-18 "></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                                        <button type="button" data-toggle="modal" data-target="#edit<?=$data['kode_vendor'];?>" class="dropdown-item">Edit</button>
                                                        <a class="dropdown-item" id="btn-hapus" href="del-vendor.php?kode=<?php echo $data['kode_vendor']; ?>">Delete</a>
                                                    </div></div>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div id="edit<?=$data['kode_vendor'];?>" class="modal fade" tabindex="-1" role="dialog"
                                                aria-labelledby="edit-modalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header modal-colored-header bg-info">
                                                            <h4 class="modal-title text-white" id="edit-modalLabel">Edit Vendor <?php echo $data['nama_vendor'];?> - <?php echo $data['contact'];?></h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">×</button>
                                                        </div>
                                                        <form class="form-horizontal" method="post">
                                                            <div class="modal-body">
                                                                <div class="card-body">
                                                                    <div class="form-group row d-none">
                                                                        <label for="kode_vendor" class="col-sm-3 text-right control-label col-form-label">Kode kode_vendor</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" id="kode_vendor" name="kode_vendor" placeholder="Masukkan Kode Vendor" value="<?php echo $data['kode_vendor']; ?>" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="nama_vendor" class="col-sm-3 text-right control-label col-form-label">Nama Vendor</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" placeholder="Masukkan Nama Vendor" value="<?php echo $data['nama_vendor']; ?>" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="alamat" class="col-sm-3 text-right control-label col-form-label">Alamat</label>
                                                                        <div class="col-sm-9">
                                                                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat Vendor" value="<?php echo $data['alamat']; ?>" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 control-label">Nomor Whatsapp</label>
                                                                        <div class="col-sm-9">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend"><span class="input-group-text">+62</span></div>
                                                                                <input type="number" class="form-control" id="contact" name="contact" placeholder="Masukkan Contact" value="<?php echo (int) $data['contact']; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light"
                                                                    data-dismiss="modal">Cancel</button>
                                                                <button type="submit" name="update" class="btn btn-info">Save</button>
                                                            </div>
                                                        </form>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->

                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Vendor</th>
                                                <th>Nama Vendor</th>
                                                <th>Alamat</th>
                                                <th>Contact</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Modal -->
                <div id="add-modal" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="add-modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header modal-colored-header bg-info">
                                <h4 class="modal-title text-white" id="add-modalLabel">Tambah Barang</h4>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">×</button>
                            </div>
                            <form class="form-horizontal" action="add-vendor.php" method="post">
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="nama_vendor" class="col-sm-3 text-right control-label col-form-label">Nama Vendor</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" placeholder="Masukkan Nama Vendor" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="alamat_vendor" class="col-sm-3 text-right control-label col-form-label">Alamat Vendor</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="alamat_vendor" name="alamat_vendor" placeholder="Masukkan Alamat Vendor" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label">Nomor Whatsapp</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">+62</span></div>
                                                    <input type="number" class="form-control" id="contact" name="contact" placeholder="Masukkan Contact" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light"
                                        data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-info">Save</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2022 Amartha Inventory by IT Regional
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../dist/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../dist/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../dist/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="../dist/js/app.min.js"></script>
    <script src="../dist/js/app.init.js"></script>
    <script src="../dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../dist/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!--Toastr JavaScript -->
    <script src="../dist/assets/extra-libs/toastr/dist/build/toastr.min.js"></script>
    <script src="../dist/assets/extra-libs/toastr/toastr-init.js"></script>
    <!-- SweetAlert2 -->
    <script src="../dist/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../dist/assets/extra-libs/sweetalert2/sweet-alert.init.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../dist/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../dist/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../dist/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../dist/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../dist/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../dist/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../dist/plugins/jszip/jszip.min.js"></script>
    <script src="../dist/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../dist/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../dist/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../dist/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../dist/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
      $(function () {
        $("#example1")
          .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            pageLength : 20,
            order: [[ 0, "asc" ]],
            buttons: ["csv", "excel", "pdf", "print", "colvis"],
          })
          .buttons()
          .container()
          .appendTo("#example1_wrapper .col-md-6:eq(0)");
      });

      $(Document).on('click', '#btn-hapus', function(e){
        e.preventDefault();
        var link = $(this).attr('href');

        Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    window.location = link;
                }
            })
      });
    </script>
</body>

</html>