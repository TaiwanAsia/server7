
<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Server 7</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <!-- <link href="dashboard.css" rel="stylesheet"> -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
        
  </head>

  <style type="text/css">
    th, td, form {
      white-space: nowrap;
    }

    #upload {
      width: 100px;
    }
    /* .table td, .table th {
        min-width: 150px;
    } */
  </style>

  <body>
    <?php if(isset($_SESSION['NAME'])) echo $_SESSION['NAME'].$_SESSION['LEVEL']; ?>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Server 7 後台</a>
        
          <input form="search" class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="<?php echo base_url(); ?>index.php/login/logout">Sign out</a>
            </li>
        </ul>
    </nav>
    <form method="get" action="search" id="search">
    </form>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url(); ?>index.php/orders/index">
                            <!-- <span data-feather="home"></span> -->
                            成交單管理<span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="checkbill">
                            <!-- <span data-feather="file"></span> -->
                            應收帳款
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <!-- <span data-feather="shopping-cart"></span> -->
                            對盤交易明細
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <span data-feather="users"></span>
                            客戶關係管理
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            成交單管理
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            服務工單
                            </a>
                        </li>
                        <?php 
                            if ($_SESSION['NAME']=='JOY') { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url(); ?>index.php/login/account">
                                    <span data-feather="file-text"></span>
                                    帳號管理
                                    </a>
                                </li>
                        <?php  }
                        ?>
                        
                    </ul>
                </div>
            </nav>