
<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">
        <title>Server7</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css?123">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tablesaw.css">
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script src="<?php echo base_url(); ?>assets/js/jquery-min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/action.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/tablesaw.jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/tablesaw-init.js"></script>
        <!-- Icons -->
        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <!-- Graphs -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

        <!-- <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet"> -->

        <!-- Custom styles for this template -->
        <!-- <link href="dashboard.css" rel="stylesheet"> -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

        <!-- <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.js"
             type="text/javascript"></script> -->
    </head>

    <script type="text/javascript">
        function gettoday() {
            document.getElementById("date").valueAsDate = new Date();
        }



        $("td.cell").live("dblclick", function () {
            //若已有其他欄位在編輯中，強制結束
            if (window.$currEditing)
                finishEditing($currEditing);
            var $cell = $(this);
            var $inp = $("<input type='text' />");
            $inp.val($cell.text());
            $cell.addClass("cell-editor").html("").append($inp);
            $inp[0].select();
            window.$currEditing = $inp;
        }).live("click", function () {
            //點選其他格子，強制結束目前的編輯欄
            if (window.$currEditing
                //排除點選目前編輯欄位的情況
                && $currEditing.parent()[0] != this)
                finishEditing($currEditing);
        });
        //加上按Enter/Tab切回原來Text的事件
        $("td.cell-editor input").live("keydown", function (e) {
            if (e.which == 13 || e.which == 9)
                finishEditing($(this));
        });
        //結束編輯模式
        function finishEditing($inp) {
            $inp.parent().removeClass("cell-editor").text($inp.val());
            window.$currEditing = null;
        }
    </script>

  <body>
    <?php if(isset($_SESSION['NAME'])) echo $_SESSION['NAME'].$_SESSION['權限名稱'];
    // echo '帳號設定權限: '.$_SESSION['帳號設定權限'];
     ?>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Server 7 後台</a>

          <input form="search" class="form-control form-control-dark w-100" type="text" placeholder="Ex : 2018050001" aria-label="Search" name="keyword">

        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="<?php echo base_url(); ?>index.php/login/logout">Sign out</a>
            </li>
        </ul>
    </nav>
    <form method="get" name="search" action="search" id="search">
    </form>
    <div class="container-fluid">
        <div class="row" style="flex-wrap: initial">
            <nav class="s-sidebar bg-light">
                <div class="s-sidebar-1">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url(); ?>index.php/orders/index">
                                首頁<span class="sr-only"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url(); ?>index.php/orders/go_assign">
                                公佈欄<span class="sr-only"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url(); ?>index.php/orders/go_orders">
                            <!-- <span data-feather="home"></span> -->
                                成交單管理<span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url(); ?>index.php/orders/go_orders_before0701">
                            <!-- <span data-feather="home"></span> -->
                                七月前成交單<span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>index.php/orders/passrecord">
                                轉讓紀錄
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>index.php/orders/boss_check_money">
                                應收帳款
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>index.php/orders/checkbillout">
                                應匯帳款
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>index.php/orders/fax_info">
                                傳真資料
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>index.php/orders/document_download_view">
                                文件下載
                            </a>
                        </li>

                        <!-- <li class="nav-item">
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
                        -->
                        <?php if ($_SESSION['權限名稱']=='最高權限') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>index.php/orders/move_record">
                                動作紀錄
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="<?php echo base_url(); ?>index.php/orders/go_deleted">
                                被刪成交單
                            </a>
                        </li>
                        <?php } ?>
                        <?php if ($_SESSION['帳號設定權限']==1) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>index.php/login/account">
                                帳號管理
                            </a>
                        </li>
                        <?php  }
                        ?>


                    </ul>
                </div>
            </nav>