<?php
include_once "./api/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/dusk.css">
</head>
<body class="dusk-bg-gray">

  <div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="login-modal-label" aria-hidden="true">
    <?php include "./modal/login.php"; ?>
  </div>

  <div class="modal fade" id="edit-banner-modal" tabindex="-1" aria-labelledby="edit-banner-modal-label" aria-hidden="true">
    <?php include "./modal/edit_banner.php"; ?>
  </div>


  <div class="top">
    <?php
      $banner;
      if(isset($_GET['type']) && $Banner->count(['type_id'=>$_GET['type']])!=0){
        $banner = $Banner->search(['type_id'=>$_GET['type']])['img'];
      }
      else $banner = $Banner->search(['type_id'=>0])['img'];
      echo "<div class='top-img' style='background-image: url(./banner/$banner);'></div>";
    ?>
    <!-- <div class="top-img"></div> -->
  </div>

  <div class="nav-placeholder"></div>
  <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand ms-3 me-3" href="./index.php">Dusk</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0">
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li> -->
            <li class="nav-item dropdown me-3">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                News
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">施工中</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown me-3">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Gallery
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./index.php?do=gallery">Gallery</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown me-3">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Video
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">施工中</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
          </ul>

          <div class="d-flex align-items-center ms-3">
            <?php
              if(isset($_SESSION['user'])){
                echo "<span class='text-light me-2'>歡迎!{$_SESSION['user']}</span>";
                
                if(isset($_SESSION['admin'])) include "./front/option_admin.php";
                else include "./front/option_user.php";

                echo "<button class='btn btn-outline-success logout-btn ms-3 me-3'>logout</button>";
              }
              else echo "<button class='btn btn-outline-success login-btn'>login</button>";
            ?>
          </div>
        </div>
      </div>
  </nav>

  <div class="container dusk-bg-lightgray">
    <?php
    if(isset($_GET['do'])){
      $file = "./front/{$_GET['do']}.php";
      if(file_exists($file)) include $file;
      else include "./front/main.php";
    }
    else if(isset($_GET['ad'])){
      $file = "./back/{$_GET['ad']}.php";
      if(file_exists($file)) include $file;
      else include "./front/main.php";
    }
    else include "./front/main.php";
    ?>
  </div>

  <div class="container vh-100">

  </div>

  <div class="footer bg-dark text-light d-flex justify-content-center align-items-center">
      <span class="m-auto">page footer</span>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="./js/dusk.js"></script>
</body>
</html>