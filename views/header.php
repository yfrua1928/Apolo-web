<?php 
//echo 'este es el header';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  
  <link rel="icon" href="<?php echo URL;?>views/resources/Img/calen.ico">

  <title>Apolo - Tramisalud</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" href="assets/img/favicon.icon" >
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  
  <!-- Vendor CSS Files -->
  <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/libs/datatable/datatables.min.css" rel="stylesheet">

  <link href="assets/libs/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/libs/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/libs/remixicon/remixicon.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body class="toggle-sidebar">
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <input type="hidden" id="identifier" value="<?php echo $_SESSION['id']?>"/>
    <div class="d-flex align-items-center justify-content-between">
    <i class=" bi bi-list toggle-sidebar-btn"></i>
      <a href="index.html" class="ml-6 logo d-flex align-items-center">
        <img src="assets/img/favicon.ico" alt="">
        <span class="d-none d-lg-block">APOLO</span>
      </a>
    </div><!-- End Logo -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/perfil.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['name']; ?></span>
          </a><!-- End Profile Iamge Icon -->
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION['name']; ?></h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?php echo constant('URL')?>logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Cerrar Sesion</span>
              </a>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation -->
  </header><!-- End Header -->
  <!-- ======= Main ======= -->
  <main id="main" class="main">
  <div class="pagetitle">
        <h1><?php echo $this->title ?></h1>
        <?php if($this->title != 'Dashboard'){ ?>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo constant('URL')?>home">Principal</a></li>
            <li class="breadcrumb-item active"><?php echo $this->title ?></li>
            </ol>
        </nav>
        <?php } ?>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                  <br>