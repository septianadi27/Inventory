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
    $kode_barang=$_POST['kode_brg'];
    $kategori=$_POST['kategori'];
    $nama_barang=$_POST['nama_brg'];
    $satuan=$_POST['satuan'];
    $harga=$_POST['harga'];
    $stock=$_POST['stock'];

    $query = mysqli_query($koneksi,"UPDATE `barang` SET `nama_barang` = '$nama_barang', `satuan` = '$satuan', `harga` = $harga, `stock` = $stock WHERE `barang`.`kode_barang` = '$kode_barang'");

    if ($query){
        header("Location:../brg-masuk/");
    } else {
        header("Location:../brg-masuk/");
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
    <title>Barang Masuk - Amartha Inventory</title>
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
    <!-- This Page CSS -->
    <link href="../dist/assets/libs/select2/dist/css/select2.min.css" rel="stylesheet">
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
            <div class="invoice-application">
				<!-- Left Part -->
				<div class="left-part bg-white fixed-left-part list-of-user">
	                    	<!-- Mobile toggle button -->
	                    	<a class="ti-menu ti-close btn btn-success show-left-part d-block d-md-none" href="javascript:void(0)"></a>
	                    	<!-- Mobile toggle button -->
		                  <div class="p-3">
		                        <h4>Chat Sidebar</h4>
		                  </div>
	                    	<div class="scrollable position-relative" style="height:100%;">
		                        <div class="p-3 border-bottom">
		                            	<h5 class="card-title">Search Invoice</h5>
		                            	<form>
		                                	<div class="searchbar">
		                                    	<input class="form-control" type="text" placeholder="Search Invoice">
		                                	</div>
		                            	</form>
		                        </div>
		                        <ul class="mailbox list-style-none app-invoice">
		                            	<li>
		                                	<div class="message-center chat-scroll invoice-users">
                                                <?php
                                                $query = "SELECT * FROM v_detailbmasuk";
                                                $tampil = mysqli_query($koneksi, $query);
                                                while ($data = mysqli_fetch_array($tampil)) {;?>
		                                   	 	<a href="javascript:void(0)" class="invoice-user message-item align-items-center border-bottom px-3 py-2 listing-user" id="<?php echo $data['kode_bmasuk']; ?>" data-invoice-id="<?php echo $data['kode_bmasuk']; ?>">
			                                        	<span class="user-img position-relative d-inline-block"> 
			                                        		<button class="btn btn-success btn-circle"><i class="mdi mdi-face"></i></button>
			                                        	</span>
			                                        	<div class="mail-contnet w-75 d-inline-block v-middle pl-2">
			                                            	<h5 class="message-title mb-0 mt-1 text-truncate invoice-customer">No PO: <?php echo $data['no_po']; ?></h5> 
			                                            	<span class="font-12 text-nowrap d-block text-muted text-truncate invoice-id"><span class="font-weight-bold text-dark">Id:</span> <?php echo $data['kode_bmasuk']; ?></span> 
			                                            	<span class="font-12 text-nowrap d-block text-muted invoice-date"><span class="font-weight-bold text-dark">Vendor:</span> <?php echo $data['nama_vendor']; ?></span> 
			                                        	</div>
		                                    	</a>
                                                <?php } ?>
			                                    <!-- Message -->
		                                	</div>
		                            	</li>
		                        </ul>
		                    </div>
	                	</div>
	                	<!-- ./Left part -->
	                	<!-- Right Part -->
	                	<div class="right-part invoice-box">
	                		<div class="p-4 invoice-inner-part">
                                <div class="card card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12 align-self-center">
                                            <h3 class="text-themecolor mb-0">Daftar Barang Masuk</h3>
                                            <ol class="breadcrumb mb-0 p-0 bg-transparent">
                                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                                <li class="breadcrumb-item active">Barang Masuk</li>
                                            </ol>
                                        </div>
                                        <div class="col-md-6 col-12 align-self-center d-none d-md-block">
                                            <div class="d-flex mt-2 justify-content-end">
                                                <div class="d-flex ml-2">
                                                    <button type="button" data-toggle="modal" data-target="#add-modal"
                                                    id="btn-add-contact" class="btn btn-info"><i class="fas fa-plus-square font-16 mr-1"></i> Input Barang Masuk</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Add Modal -->
                                        <div class="modal fade" id="add-modal" role="dialog"
                                            aria-labelledby="add-modalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header modal-colored-header bg-info">
                                                        <h4 class="modal-title text-white" id="add-modalLabel">Input Barang Masuk</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" id="add-brgmasuk" action="add-brgmasuk.php" method="post">
                                                            <div class="card-body">
                                                                <div class="form-group row">
                                                                    <label for="tanggal" class="col-sm-3 text-right control-label col-form-label">Tanggal</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="no_po" class="col-sm-3 text-right control-label col-form-label">No PO</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="no_po" name="no_po" placeholder="Masukkan Nomor PO" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 text-right control-label col-form-label">Vendor</label>
                                                                    <div class="col-sm-9">
                                                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                                    <?php $query = "SELECT * FROM vendor";
                                                                    $tampil = mysqli_query($koneksi, $query);
                                                                    while ($data = mysqli_fetch_array($tampil)) {;?>
                                                                        <option value="<?php echo $data['kode_vendor']; ?>"><?php echo $data['nama_vendor']; ?></option>
                                                                    <?php } ?>
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                                <br><hr><br>
                                                                <div class="form-group row">
                                                                    <h4 class="col-sm-9 card-title">Detail Barang</h4>
                                                                    <a href="javascript:void(0)" class="add-more-form col-sm-3 btn waves-effect waves-light btn-rounded btn-info">Add More</a>
                                                                </div>
                                                                <hr>
                                                                <div class="form-group row">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group row">
                                                                                    <label class="col-sm-3 text-right control-label col-form-label">Nama Barang</label>
                                                                                    <div class="col-sm-9">
                                                                                    <select class="select2 form-control custom-select" name="nama_barang[]" style="width: 100%; height:36px;">
                                                                                    <?php $query = "SELECT * FROM barang";
                                                                                    $tampil = mysqli_query($koneksi, $query);
                                                                                    while ($data = mysqli_fetch_array($tampil)) {;?>
                                                                                        <option value="<?php echo $data['kode_barang']; ?>"><?php echo $data['nama_barang']; ?></option>
                                                                                    <?php } ?>
                                                                                    </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-12 col-md-4">
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-form-label">Jumlah</label>
                                                                                    <input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-12 col-md-8">
                                                                                <div class="form-group">
                                                                                    <label class="control-label col-form-label">Harga</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text">IDR</span>
                                                                                        </div>
                                                                                        <input type="number" class="form-control" name="harga[]" placeholder="Harga Satuan" required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Add More -->
                                                                <div class="paste-new-forms"></div>
                                                                <!-- End Add More -->
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button type="submit" form="add-brgmasuk" class="btn btn-info">Save</button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </div>
                                </div>
	                			<div class="chat-not-selected">
		                            <div class="text-center">
		                                <span class="display-5 text-info"><i class="mdi mdi-file-document-box"></i></span>
		                                <h5>Open Invoice from the list</h5>
		                            </div>
		                        </div>
		                        <div class="invoiceing-box">
		                        	<div class="card card-body">
		                				<div class="invoice-header d-flex align-items-center border-bottom pb-3">
		                					<h3 class="font-medium text-uppercase mb-0">Invoice</h3>
				                   		<div class="ml-auto">
				                   			<h4 class="invoice-number"></h4>
				                   		</div>
				                   	</div>
				                   	<div class="" id="custom-invoice">
				                   		<!-- (1) -->
                                        <?php
                                        $query = "SELECT * FROM v_detailbmasuk";
                                        $tampil = mysqli_query($koneksi, $query);
                                        while ($data = mysqli_fetch_array($tampil)) {;?>
                                        <?php $kode_bmasuk = $data['kode_bmasuk'];?>
				                   		<div class="<?php echo $kode_bmasuk; ?>" id="printableArea">
				                   			<div class="row pt-3">
						                              <div class="col-md-12">
						                                    <div class="pull-left">
						                                        <address>
						                                        	<h3>&nbsp;Barang Masuk,</h3>
						                                            <h4>&nbsp;No.PO : <?php echo $data['no_po']; ?></h4>
						                                            <h4 class="mb-0 font-weight-bold">&nbsp;<?php echo ucwords(strtolower($data['nama'])); ?></h4>
						                                            <div class="mb-2">
						                                            	<span class="font-weight-bold ml-1">Invoice Id:</span><span class="invoice-number ml-2"></span>
						                                            	<h6 class="text-muted font-medium">&nbsp;Email: <?php echo $data['email']; ?></h6>
						                                            </div>
						                                        </address>
						                                    </div>
						                                    <div class="pull-right text-right">
						                                        <address>
						                                            <h3>From,</h3>
						                                            <h4 class="font-bold"><?php echo $data['nama_vendor']; ?>,</h4>
						                                            <p class="text-muted ml-4">----------------------------
						                                                <br/> <?php echo $data['alamat']; ?>,
						                                                <br/> <?php echo $data['contact']; ?></p>
						                                            <p class="mt-4"><b>Invoice Date :</b> <i class="fa fa-calendar"></i> <?php echo date('d F Y', strtotime($data['tgl_masuk'])); ?></p>
						                                        </address>
						                                    </div>
						                              </div>
						                              <div class="col-md-12">
						                                    <div class="table-responsive mt-5" style="clear: both;">
						                                        <table class="table table-hover">
						                                            <thead>
						                                                <tr>
						                                                    <th class="text-center">#</th>
                                                                            <th>Nama Barang</th>
						                                                    <th class="text-right">Jumlah</th>
						                                                    <th class="text-right">Harga</th>
						                                                    <th class="text-right">Total</th>
						                                                </tr>
						                                            </thead>
						                                            <tbody>
                                                                        <?php
                                                                        $no=1;
                                                                        $query = "SELECT * FROM v_bmasuk WHERE kode_bmasuk='$kode_bmasuk'";
                                                                        $tampil1 = mysqli_query($koneksi, $query);
                                                                        while ($data1 = mysqli_fetch_array($tampil1)) {;?>
						                                                <tr>
						                                                    <td class="text-center"><?php echo $no++; ?></td>
                                                                            <td><?php echo $data1['nama_barang']; ?></td>
						                                                    <td class="text-right"><?php echo $data1['jml_masuk']; ?> <?php echo $data1['satuan']; ?></td>
						                                                    <td class="text-right"><?php echo "IDR ".number_format($data1['harga_new'], 0); ?></td>
						                                                    <td class="text-right"><?php echo "IDR ".number_format($data1['total'], 0); ?></td>
						                                                </tr>
                                                                        <?php } ?>
						                                            </tbody>
						                                        </table>
						                                    </div>
						                              </div>
						                              <div class="col-md-12">
						                                    <div class="pull-right mt-4 text-right">
						                                        <hr>
                                                                <?php
                                                                $query = "SELECT SUM(total) AS GrandTotal FROM v_bmasuk WHERE kode_bmasuk='$kode_bmasuk'";
                                                                $tampil2 = mysqli_query($koneksi, $query);
                                                                while ($data2 = mysqli_fetch_array($tampil2)) {;?>
						                                        <h3><b>Total :</b><?php echo " IDR ".number_format($data2['GrandTotal'], 0); ?></h3>
                                                                <?php } ?>
						                                    </div>
						                                    <div class="clearfix"></div>
						                                    <hr>
						                                    <div class="text-right">
						                                        <button class="btn btn-danger" type="submit"> Delete Invoice </button>
						                                        <button class="btn btn-default print-page" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
						                                    </div>
						                              </div>
						                        </div>
				                   		</div>  <!-- ./(1) -->
                                        <?php } ?>
				                   	</div>
		                        </div>
	                		</div>
	                	</div>
	                	<!-- ./Right Part -->
	                </div>
			</div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
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
    <!-- select2 JS -->
    <script src="../dist/assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="../dist/assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="../dist/js/pages/forms/select2/select2.init.js"></script>
    <!--Invoice JavaScript -->
	<script src="../dist/js/pages/samplepages/jquery.PrintArea.js"></script>
	<script src="../dist/js/pages/invoice/invoice.js"></script>
    <script>

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

        $(document).ready(function () {

            $(document).on('click', '.remove-btn', function () {
                $(this).closest('.main-form').remove();
            });
            
            $(document).on('click', '.add-more-form', function () {
                $('.paste-new-forms').append('<div class="main-form"><br>\
                                                <div class="form-group row">\
                                                    <div class="card-body">\
                                                        <div class="row">\
                                                            <div class="col-sm-12">\
                                                                <div class="form-group row">\
                                                                    <label class="col-sm-3 text-right control-label col-form-label">Nama Barang</label>\
                                                                    <div class="col-sm-9">\
                                                                    <select class="select2 form-control custom-select" name="nama_barang[]" style="width: 100%; height:36px;">\
                                                                        <?php $query = "SELECT * FROM barang";
                                                                        $tampil = mysqli_query($koneksi, $query);
                                                                        while ($data = mysqli_fetch_array($tampil)) {;?>
                                                                            <option value="<?php echo $data['kode_barang']; ?>"><?php echo $data['nama_barang']; ?></option>\
                                                                        <?php } ?>
                                                                        </select>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                        <div class="row">\
                                                            <div class="col-sm-12 col-md-4">\
                                                                <div class="form-group">\
                                                                    <label class="control-label col-form-label">Jumlah</label>\
                                                                    <input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah" required>\
                                                                </div>\
                                                            </div>\
                                                            <div class="col-sm-12 col-md-8">\
                                                                <div class="form-group">\
                                                                    <label class="control-label col-form-label">Harga</label>\
                                                                    <div class="input-group">\
                                                                        <div class="input-group-prepend">\
                                                                            <span class="input-group-text">IDR</span>\
                                                                        </div>\
                                                                        <input type="number" class="form-control" name="harga[]" placeholder="Harga Satuan" required>\
                                                                    </div>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                    <div class="col-sm-4">\
                                                    </div>\
                                                    <div class="col-sm-4">\
                                                        <button type="button" class="remove-btn btn-block waves-effect waves-light btn-rounded btn-danger">Remove</button>\
                                                    </div>\
                                                </div>\
                                            </div>');
            });

        });
    </script>
</body>

</html>