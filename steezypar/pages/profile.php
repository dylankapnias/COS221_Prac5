<?php
session_start();

if (!isset($_SESSION["u_id"])) {
    die("Please enter this page appropriately");
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- all good -->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Profile
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
            <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">Profile</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white " href="dashboard.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="players.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Players</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white active bg-gradient-primary" href="profile.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white " href="../assets/php/sign-out.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">logout</i>
                    </div>
                    <span class="nav-link-text ms-1">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Profile</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Profile</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0">
                            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/background/2.jpg');">
            <span class="mask  bg-gradient-primary  opacity-6"></span>
        </div>
        <div class="card card-body mx-3 mx-md-4 mt-n6">
            <div class="row gx-4 mb-2">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <?php
                        require '../assets/php/util/get-pic.php';
                        echo "<img src='../assets/uploads/" . ($pic  == 0 ? 'default' : $_SESSION["u_id"]) . ".jpg' alt='profile_image' class='w-100 border-radius-lg shadow-sm'>";
                        ?>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            <?php
                            require_once '../assets/php/util/get-name.php';
                            echo $name;
                            ?>
                        </h5>
                    </div>
                </div>
                <div class="col-auto d-flex align-items-center justify-content-between">
                    <form role="form" action="../assets/php/upload-profile.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="profile_pic">
                        <?php
                        require '../assets/php/util/get-pic.php';
                        echo "<button type='submit' name='pic_submit' class='btn btn-outline-primary btn-sm mb-0'>" . ($pic  == 0 ? 'Upload ' : 'Change ') . "profile picture</button>";
                        ?>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="card card-plain h-100">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-md-8 d-flex align-items-center">
                                        <h6 class="mb-0">Profile Information</h6>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <a href="edit-profile.php">
                                            <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <?php
                                    require_once '../assets/php/util/get-handicap.php';
                                    echo "<li class='list-group-item border-0 ps-0 pt-0 text-sm'><strong class='text-dark'>Full Name:</strong> &nbsp;" . $name . "</li>";
                                    echo "<li class='list-group-item border-0 ps-0 text-sm'><strong class='text-dark'>Handicap:</strong> &nbsp;" . $handicap . "</li>";
                                    echo "<li class='list-group-item border-0 ps-0 text-sm'><strong class='text-dark'>Email:</strong> &nbsp;" . $email . "</li>";
                                    echo "<li class='list-group-item border-0 ps-0 text-sm'><strong class='text-dark'>Username:</strong> &nbsp;" . $username . "</li>";
                                    echo "<li class='list-group-item border-0 ps-0 pb-0'>";
                                    ?>
                                    <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                    <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                        <i class="fab fa-facebook fa-lg"></i>
                                    </a>
                                    <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                        <i class="fab fa-twitter fa-lg"></i>
                                    </a>
                                    <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                        <i class="fab fa-instagram fa-lg"></i>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="card card-plain h-100">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-md-8 d-flex align-items-center">
                                        <h6 class="mb-0">Add Your Score</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form role="form" class="text-start" action="../assets/php/capture-score.php" method="post">
                                    <div class="input-group input-group-outline my-3">
                                        <div class="dropdown">
                                            <?php
                                                require_once '../assets/php/create-game-selector.php'
                                            ?>
                                        </div>
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Insert Score</label>
                                        <input name="total_score" id="score-input" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Par</label>
                                        <input name="total_par" id="par-input" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Birdies</label>
                                        <input name="total_birdie" id="birdies-input" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Eagles</label>
                                        <input name="total_eagle" id="eagles-input" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Bogeys</label>
                                        <input name="total_bogey" id="bogeys-input" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Amount of Drives</label>
                                        <input name="total_drive" id="drives-input" class="form-control">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Longest Drive</label>
                                        <input name="total_distance" id="distance-input" class="form-control">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="capture_score" class="btn bg-gradient-primary w-100 my-4 mb-2">Add Score</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer py-4  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        ?? <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        made by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Swing Steezy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3">
            <div class="float-start">
                <h5 class="mt-3 mb-0">Settings</h5>
                <p>See our dashboard options.</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0">
            <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0">Sidebar Colors</h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
                <div class="badge-colors my-2 text-start">
                    <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                </div>
            </a>
            <!-- Sidenav Type -->
            <div class="mt-3">
                <h6 class="mb-0">Sidenav Type</h6>
                <p class="text-sm">Choose between 2 different sidenav types.</p>
            </div>
            <div class="d-flex">
                <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
                <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
                <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
            </div>
            <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
            <!-- Navbar Fixed -->
            <hr class="horizontal dark my-3">
            <div class="mt-2 d-flex">
                <h6 class="mb-0">Light / Dark</h6>
                <div class="form-check form-switch ps-0 ms-auto my-auto">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
                </div>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/material-dashboard.min.js?v=3.0.2"></script>
</body>

</html>