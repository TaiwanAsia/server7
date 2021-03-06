
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
        <!-- font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="/server7/assets/js/jquery-min.js"></script>
        <script src="/server7/assets/js/action.js"></script>
        <script src="/server7/assets/js/tablesaw.jquery.js"></script>
        <script src="/server7/assets/js/tablesaw-init.js"></script>
   
        <!-- Icons -->
<!--        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>-->
        <!-- Graphs -->
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>-->

    </head>

    <script type="text/javascript">
        function gettoday() {
            document.getElementById("date").valueAsDate = new Date();
        }

    </script>


 <body style="display: flex; flex-direction: column;">
    <div id="header" style="position: fixed;">
            <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0" style="height: 75px;">

                <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Server 7 後台</a>
                <input form="search" id="inputsearch" type="text" placeholder="Ex : 2018050001" aria-label="Search" name="keyword">
                <div style="display:flex; flex-direction: row; width: 300px; justify-content: space-evenly; margin-right: 15px;">
                    <span style="color: wheat; font-size: large; align-self: flex-end"><?php if(isset($_SESSION['NAME'])) echo $_SESSION['NAME'].$_SESSION['權限名稱']; ?></span>
                    <div>
                        <button class="btn btn-sm btn-outline-secondary" style="font-size: x-large;" onclick="javascript:location.href='../login/logout'">
                            Sign out
                            <i class="fa fa-sign-out" style="font-size:30px; color:#e9eff2;"></i>
                        </button>
                    </div>

                </div>

            </nav>
    </div>

    <form method="get" name="search" action="search" id="search"></form>

    <div class="container-fluid" style="padding-left: 0;padding-right: 0; margin-top: 75px;">
        <div class="row" style="flex-wrap: initial; margin: 0">
            <nav class="s-sidebar" style="background-color: #CCCCCC; border: black; background-color: #CCCCCC; border-right-style: double; z-index: 1001;">
                <div class="s-sidebar-1">
                    <ul class="nav flex-column" style="font-family:微軟正黑體; font-size: 22px; color: white;" >
                        <li class="nav-item">
                            <a class="nav-link active" href="../orders/index" style="color: black;">
                                首頁<span class="sr-only"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../orders/go_assign" style="color: black;">
                                新增工單<span class="sr-only"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../orders/go_orders" style="color: black;">
                                成交單管理<span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../orders/passrecord" style="color: black;">
                                轉讓紀錄
                            </a>
                        </li>
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
                        <li class="nav-item">
                            <?php if ($_SESSION['權限名稱'] == '最高權限'){ ?>
                                <a class="nav-link" href="../login/account" style="color: black;">
                            <?php } else { ?>
                                <a class="nav-link" href="../login/go_edit_employee?employee_id=<?=$_SESSION['ID']?>" style="color: black;">
                            <?php } ?>
                                帳號資訊
                            </a>
                        </li>


                    </ul>
                </div>
            </nav>