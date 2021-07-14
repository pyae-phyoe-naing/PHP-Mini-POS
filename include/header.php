<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/bootstrap.css" />
  <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/argon-design-system.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/style.css">

  <title>Hello, world!</title>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <!-- Container wrapper -->
    <div class="container-fluid pr-4 pl-4">
      <!-- Toggle button -->
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample"
        aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarButtonsExample">
        <div class="d-flex">
          <a href="<?php echo $base_url;?>index.php" type="button" class="btn btn-warning me-3 text-white">
            <span class="fa fa-home"></span>
            <span class="ml-1">Home</span>
          </a>
          <a href="manage_shop.php" type="button" class="btn btn-warning me-3 text-white">
            <span class="fas fa-store-alt"></span>
            <span class="ml-1">Manage Shop</span>
          </a>
          <div class="dropdown">
            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
              Manage Shop
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item d-flex align-items-center" href="<?php echo $base_url ?>category/index.php">
                <i class="fas fa-list text-warning"> </i>
                <span class="">Category</span>
              </a>

              <a class="dropdown-item d-flex align-items-center" href="<?php echo $base_url ?>product/index.php">
                <i class="fa fa-shopping-bag text-warning"> </i>
                <span class="">Product</span>
              </a>
            </div>
          </div>
          <!-- Sale -->
          <!-- <a type="button" class="btn btn-warning me-3 text-white">
            <span class="fas fa-balance-scale-left"></span>
            <span class="ml-1">Sale</span>
          </a> -->
          <!-- Account -->
          <a href="<?php echo $base_url; ?>manage_account.php" type="button" class="btn btn-warning me-3 text-white">
            <span class="fa fa-user"></span>
            <span class="ml-1">Manage Account</span>
          </a>
          <!-- Account -->
          <a type="button" href="<?php echo $base_url; ?>logout.php" class="btn btn-danger me-3 text-white">
            <span class="fa fa-user"></span>
            <span class="ml-1">Logout</span>
          </a>
        </div>
      </div>
      <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->