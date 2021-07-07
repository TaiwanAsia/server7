
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">
        <title>成交單</title>
        <link rel="stylesheet" href="/server7/assets/css/style.css">
        <link rel="stylesheet" href="/server7/assets/css/tablesaw.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/cwtexkai.css">
   
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script src="/server7/assets/js/jquery-min.js"></script>
        <script src="/server7/assets/js/action.js"></script>
        <script src="/server7/assets/js/tablesaw.jquery.js"></script>
        <script src="/server7/assets/js/tablesaw-init.js"></script>
   
        <!-- Icons -->
        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <!-- Graphs -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

    </head>

    <script type="text/javascript">
        function gettoday() {
            document.getElementById("date").valueAsDate = new Date();
        }

    </script>


 <body>
  <header id="header">
    <div class="s-pull-1">
    <span><?php if(isset($_SESSION['NAME'])) echo $_SESSION['NAME'].$_SESSION['權限名稱'];
    // echo '帳號設定權限: '.$_SESSION['帳號設定權限'];
     ?></span>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Server 7 後台</a>
          <input form="search" class="form-control form-control-dark w-100" type="text" placeholder="Ex : 2018050001" aria-label="Search" name="keyword">
          
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="../login/logout">Sign out</a>
            </li>
        </ul>
    </nav>
  </div>
 </header>
    <form method="get" name="search" action="search" id="search">
    </form>
    <div class="container-fluid">
        <div class="row" style="flex-wrap: initial">
            <nav class="s-sidebar" style="background-color: #CCCCCC;">
                <div class="s-sidebar-1">
                    <ul class="nav flex-column" style="font-family:微軟正黑體; font-size: 22px; color: white;" >
                        <li class="nav-item">
                            <a class="nav-link active" href="../orders/index" style="color: black;">
                                首頁<span class="sr-only"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../orders/go_assign" style="color: black;">
                                公佈欄<span class="sr-only"></span>
                            </a>
                        </li>
                        <li class="nav-item">

                            <a class="nav-link active" href="../orders/go_orders" style="color: black;">
                            <!-- <span data-feather="home"></span> -->
                                成交單管理<span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link active" href="<?php echo base_url(); ?>index.php/orders/go_orders_before0701">
                            <span data-feather="home"></span>
                                七月前成交單<span class="sr-only">(current)</span>
                            </a>
                        </li> -->
                        <li class="nav-item">

                            <a class="nav-link" href="../orders/passrecord" style="color: black;">
                                轉讓紀錄
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>index.php/orders/passrecord_before0701">
                                七月前轉讓紀錄
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <?php if ($_SESSION['權限名稱'] == '最高權限') { ?>
                                <a class="nav-link" href="../orders/boss_check_money" style="color: black;">
                                應收帳款
                                </a>
                            <?php } else {?>
                            <a class="nav-link" href="../orders/checkbill" style="color: black;">
                                應收帳款
                            </a>
                        <?php } ?>
                        </li>
                        <?php if ($_SESSION['權限名稱'] == '最高權限') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../orders/checkbillout" style="color: black;">
                                應匯帳款
                            </a>
                        </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../orders/fax_info" style="color: black;">
                                傳真資料
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../orders/document_download_view" style="color: black;">
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
                            <a class="nav-link" href="../orders/move_record" style="color: black;">
                                動作紀錄
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="../orders/go_deleted" style="color: black;">
                                已刪成交單
                            </a>
                        </li>
                        <?php } ?>
                        <?php if ($_SESSION['帳號設定權限']==1) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../login/account" style="color: black;">
                                帳號管理
                            </a>
                        </li>
                        <?php  }
                        ?>


                    </ul>
                </div>
            </nav>