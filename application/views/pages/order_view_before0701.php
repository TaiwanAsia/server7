  <main role="main" style="flex: 1 0 auto;" >
    <div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
     <h1 class="h2">成交單</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
       <div class="btn-group mr-2">
        <!-- <button class="btn btn-sm btn-outline-secondary" id="new_order">新增成交單</button> -->
        <!-- <button class="btn btn-sm btn-outline-secondary">所有</button> -->
        <div class="btn-group-s">
        <a href="<?php echo base_url(); ?>index.php/orders/go_orders_before0701" class="btn btn-sm btn-outline-secondary">所有</a>
        <a href="<?php echo base_url(); ?>index.php/orders/go_inventory_before0701" class="btn btn-sm btn-outline-secondary">庫存</a>
        <a href="<?php echo base_url(); ?>index.php/orders/go_ko_before0701" class="btn btn-sm btn-outline-secondary">KO</a>
        <?php if ($_SESSION['權限名稱'] == '最高權限') { ?>
          <a href="<?php echo base_url(); ?>index.php/orders/admin_new_order" class="btn btn-sm btn-outline-secondary">新增成交單</a>
        <?php } else if($add_quene) { ?>
        <a href="<?php echo base_url(); ?>index.php/orders/new_order" class="btn btn-sm btn-outline-secondary">新增成交單</a>
        <?php } ?>

        </div>

        <form action="export" method="post">
          <select id="業務" name="業務" class="btn btn-sm btn-outline-secondary" onchange="">
            <?php
            echo "<option value=所有業務>所有業務</option>";
            if ($_SESSION['權限名稱']=='最高權限') {
              for ($j=0; $j < count($employees); $j++) {
                if ($employees[$j]['權限名稱'] == '業務') {
                  echo "<option value=".$employees[$j]['NAME'].">".$employees[$j]['NAME']."</option>";
                }
              }
            } else {
              echo "<option value=".$_SESSION['NAME'].">".$_SESSION['NAME']."</option>";
            }

            ?>
          </select>

          <input id="datePicker_1" class="btn btn-sm btn-outline-secondary" name="date1" type="date" value="" onchange="">
          <input id="datePicker_2" class="btn btn-sm btn-outline-secondary" name="date2" type="date" value="" onchange="">
          <label id="dateselectorinfo"><?PHP if (isset($_GET['業務'])&&isset($_GET['date1'])&&isset($_GET['date2'])) {
            echo $_GET['業務']."：".$_GET['date1']."~".$_GET['date2'];
            echo '<input type="hidden" name="selected_業務" id="" value="'.$_GET['業務'].'">';
            echo '<input type="hidden" name="selected_datePicker_1" id="" value="'.$_GET['date1'].'">';
            echo '<input type="hidden" name="selected_datePicker_2" id="" value="'.$_GET['date2'].'">';
          } elseif(isset($_GET['業務']) && !isset($_GET['date2'])) {
            echo $_GET['業務'];
            echo '<input type="hidden" name="selected_業務" id="" value="'.$_GET['業務'].'">';
          }  ?></label>
          <button name="" type="button" class="btn btn-sm btn-outline-secondary" onclick="selectByRange2()">篩選</button>
          <button name="Export" type="submit" class="btn btn-sm btn-outline-secondary">匯出</button>
        </form>
        <!-- <button class="btn btn-primary">匯出</button> -->
      </div>
      <!-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <span data-feather="calendar"></span>
        This week
      </button>-->
    </div>
  </div>


<div class="t-form">
<table id="eoTable" class="table table-md table-hover table-responsive" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>
    <thead class="thead-light">
      <tr>
        <th data-tablesaw-priority="persist"></th>
        <th data-tablesaw-priority="persist"></th>
        <th data-tablesaw-priority="0">編號</th>
        <th data-tablesaw-priority="0">ID</th>
        <th data-tablesaw-priority="1" scope="col">成交日期</th>
        <th data-tablesaw-priority="1">業務</th>
        <th data-tablesaw-priority="1">客戶姓名</th>
        <th data-tablesaw-priority="0">身分證字號</th>
        <th data-tablesaw-priority="1">聯絡電話</th>
        <th data-tablesaw-priority="0">聯絡人</th>
        <th data-tablesaw-priority="0">聯絡住址</th>
        <th data-tablesaw-priority="1">買賣</th>
        <th data-tablesaw-priority="1">股票</th>
        <th data-tablesaw-priority="1">張數</th>
        <th data-tablesaw-priority="1">成交價</th>
        <th data-tablesaw-priority="1">盤價</th>
        <th data-tablesaw-priority="1">匯款/應收金額</th>
        <th data-tablesaw-priority="0">匯款銀行</th>
        <th data-tablesaw-priority="0">匯款分行</th>
        <th data-tablesaw-priority="0">匯款戶名</th>
        <th data-tablesaw-priority="0">匯款帳號</th>
        <th data-tablesaw-priority="1">轉讓會員</th>
        <th data-tablesaw-priority="1">完稅人</th>
        <th data-tablesaw-priority="1">一審</th>
        <th data-tablesaw-priority="1">二審</th>
        <!-- <th>成交單狀態</th> -->
        <th data-tablesaw-priority="0">新舊</th>
        <th data-tablesaw-priority="0">自行應付</th>
        <th data-tablesaw-priority="0">刻印</th>
        <th data-tablesaw-priority="0">過戶費</th>
        <!-- <th data-tablesaw-priority="0">媒合</th> -->
        <th data-tablesaw-priority="1">收付款</th>
        <th data-tablesaw-priority="0">過戶日期</th>
        <th data-tablesaw-priority="1">通知查帳</th>
        <th data-tablesaw-priority="1">上傳契約-要記得選擇檔案</th>
        <th data-tablesaw-priority="1">上傳稅單-要記得選擇檔案</th>
        <?php if ($_SESSION['權限名稱'] == '最高權限') { ?>
          <th data-tablesaw-priority="1">上傳水</th>
        <?php } ?>
        <th data-tablesaw-priority="1">是否結案</th>
        <th data-tablesaw-priority="persist"></th>

      </tr>
    </thead>
   <tbody>
    <?php if($orders) {
        for($i=0; $i<count($orders); $i++) { ?>




    <tr <?php if ($orders[$i]['媒合'] != 0 ) { ?>class=""<?php }?>>
        <td>
              <?php if ($_SESSION['刪除權限']==1) { ?>
                <button onclick="Delete(<?php echo $orders[$i]['ID']; ?>)">刪除</button>
              <?php } ?>
          </td>
        <td>
          <?php if ($_SESSION['編輯權限']==1) { ?>
          <form method="GET" action="go_edit_before0701">
            <input type="hidden" name="id" value="<?php echo ($orders[$i]['ID']) ?>">
            <button type="submit">修改</button>
          </form>
          <?php } ?>
        </td>
        <!-- <td>
          <?php if ($_SESSION['刪除權限']==1) { ?>
            <button onclick="Delete(<?php echo $orders[$i]['ID']; ?>)">刪除</button>
          <?php } ?>
        </td> -->
        <!-- <td>
          <?php if ($_SESSION['刪除權限']==1) { ?>
          <form method="POST" action="delete">
            <button type="submit">刪除</button>
            <input type="hidden" name="id" value="<?php echo ($orders[$i]['ID']) ?>">
          </form>
          <?php } ?>
        </td> -->
        <td>
          <?php echo ($orders[$i]['媒合']) ?>
          <input type="hidden" id="媒合<?php echo $orders[$i]['ID']; ?>" name="媒合" value="<?php echo $orders[$i]['媒合']; ?>">
        </td>
        <td>
          <label id="mousemove<?php echo ($orders[$i]['ID']) ?>" onmouseout="changefont_back(<?php echo ($orders[$i]['ID']) ?>)" onmousemove="changefont(<?php echo ($orders[$i]['ID']) ?>)" onclick="showbonus(<?php echo ($orders[$i]['ID']) ?>)" style="cursor: pointer;"><?php echo ($orders[$i]['ID']) ?></label>
        </td>
        <td>
          <?php echo ($orders[$i]['成交日期']) ?>
          <input type="hidden" id="成交日期<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['成交日期']; ?>">
        </td>
        </td>
        <td>
          <a class="clickable_hint" href="javascript:location.href='
            <?php
            echo base_url()."index.php/orders/";
            if ($orders[$i]['轉讓會員'] == '庫存') {
              echo "go_inventory_before0701?業務=".$orders[$i]['業務'];
            } else if($orders[$i]['轉讓會員'] == 'KO') {
              echo "go_ko_before0701?業務=".$orders[$i]['業務'];
            } else {
              echo "go_orders_before0701?業務=".$orders[$i]['業務'];
            }?>'"
            title="<?php echo ($orders[$i]['業務']) ?>"><?php echo ($orders[$i]['業務']) ?></a>
            <input type="hidden" id="業務<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['業務']; ?>">
        </td>
        <td class="thd-s1">
          <a class="clickable_hint" href="javascript:location.href='
            <?php
            echo base_url()."index.php/orders/";
            if ($orders[$i]['轉讓會員'] == '庫存') {
              echo "go_inventory_before0701?客戶姓名=".$orders[$i]['客戶姓名'];
            } else if($orders[$i]['轉讓會員'] == 'KO') {
              echo "go_ko_before0701?客戶姓名=".$orders[$i]['客戶姓名'];
            } else {
              echo "go_orders_before0701?客戶姓名=".$orders[$i]['客戶姓名'];
            }?>'"
            title="<?php echo ($orders[$i]['客戶姓名']) ?>"><?php echo ($orders[$i]['客戶姓名']) ?></a>
          <input type="hidden" id="name<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['客戶姓名']; ?>">
        </td>
        <td>
        <?php if($_SESSION['身分證字號權限']==1) {
          echo ($orders[$i]['身分證字號']);
        ?>
        <input type="hidden" id="F<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['身分證字號']; ?>">
        <?php } ?>
      </td>
      <td>
        <?php if($_SESSION['聯絡電話權限']==1) { ?>
          <a class="clickable_hint" href="javascript:location.href='
            <?php
            echo base_url()."index.php/orders/";
            if ($orders[$i]['轉讓會員'] == '庫存') {
              echo "go_inventory_before0701?聯絡電話=".$orders[$i]['聯絡電話'];
            } else if($orders[$i]['轉讓會員'] == 'KO') {
              echo "go_ko_before0701?聯絡電話=".$orders[$i]['聯絡電話'];
            } else {
              echo "go_orders_before0701?聯絡電話=".$orders[$i]['聯絡電話'];
            }?>'"
            title="<?php echo ($orders[$i]['聯絡電話']) ?>"><?php echo ($orders[$i]['聯絡電話']) ?></a>
          <input type="hidden" id="phone<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['聯絡電話']; ?>">
        <?php } ?>
      </td>
        <td>
          <?php if($_SESSION['聯絡人權限']==1) {
            echo ($orders[$i]['聯絡人']);
          } ?>
        </td>
        <td>
          <?php if($_SESSION['聯絡地址權限']==1) {
            echo ($orders[$i]['聯絡地址']);
          ?>
          <input type="hidden" id="address<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['聯絡地址']; ?>">
          <?php } ?>
        </td>
        <td><?php
        if($orders[$i]['買賣']==1){
          echo '<p class="text-danger"><b>買</b>';
          echo '<input type="hidden" id="買賣'.$orders[$i]['ID'].'" name="" value="1">';
        } else {
          echo '<p class="text-primary"><b>賣</b>';
          echo '<input type="hidden" id="買賣'.$orders[$i]['ID'].'" name="" value="0">';
        }
        ?></p>
       </td>
        <td>
          <a class="clickable_hint" href="javascript:location.href='
            <?php
            echo base_url()."index.php/orders/";
            if ($orders[$i]['轉讓會員'] == '庫存') {
              echo "go_inventory_before0701?股票=".$orders[$i]['股票'];
            } else if($orders[$i]['轉讓會員'] == 'KO') {
              echo "go_ko_before0701?股票=".$orders[$i]['股票'];
            } else {
              echo "go_orders_before0701?股票=".$orders[$i]['股票'];
            }?>'"
            title="<?php echo ($orders[$i]['股票']) ?>"><?php echo ($orders[$i]['股票']) ?></a>
          <input type="hidden" id="company<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['股票']; ?>">
        </td>
        <td>
          <?php echo ($orders[$i]['張數']) ?>
          <input type="hidden" id="amount<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['張數']; ?>">
        </td>
        <td>
          <?php echo ($orders[$i]['成交價']) ?>
          <input type="hidden" id="成交價<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['成交價']; ?>">
        </td>
        <td>
          <?php if($_SESSION['盤價權限']==1) {
            echo ($orders[$i]['盤價']);
          ?>
          <input type="hidden" id="盤價<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['盤價']; ?>">
          <?php } ?>
        </td>
        <?php if ($_SESSION['匯款資訊權限']==1) { ?>
        <td>
          <?php echo ($orders[$i]['匯款金額應收帳款']) ?>
          <input type="hidden" id="匯款金額應收帳款<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款金額應收帳款']; ?>">
        </td>
        <td>
          <?php echo ($orders[$i]['匯款銀行']) ?>
          <input type="hidden" id="匯款銀行<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款銀行']; ?>">
        </td>
        <td>
          <?php echo ($orders[$i]['匯款分行']) ?>
          <input type="hidden" id="匯款分行<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款分行']; ?>">
        </td>
        <td>
          <?php echo ($orders[$i]['匯款戶名']) ?>
          <input type="hidden" id="匯款戶名<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款戶名']; ?>">
        </td>
        <td>
          <?php echo ($orders[$i]['匯款帳號']) ?>
          <input type="hidden" id="匯款帳號<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款帳號']; ?>">
        </td>
        <?php } else {
          echo "<td></td><td></td><td></td><td></td><td></td>";
        } ?>

        <td>
          <?php if($_SESSION['轉讓會員權限']==1) {
            echo ($orders[$i]['轉讓會員']);
          ?>
          <input type="hidden" id="轉讓會員<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['轉讓會員']; ?>">
          <?php } ?>
        </td>
        <td>
          <?php echo ($orders[$i]['完稅人']) ?>
          <input type="hidden" id="完稅人<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['完稅人']; ?>">
        </td>
        <?php
        if ($_SESSION['一審權限']==1) {
          if ($orders[$i]['成交單狀態']!='審核完成') {
          //一審[未完]開始
            if ($orders[$i]['買賣']==1) {
               //客戶賣, 大姊匯錢則不用再點一審進去, 改成點擊觸發成交單狀態為完成以及更改匯款日期&過戶日期 ?>
              <td>
                <button onclick="Buy_Edit(<?php echo $orders[$i]['ID']; ?>)" >一審</button>
              </td>
             <?php } else { ?>
          <td>
            <!-- Trigger/Open The Modal -->
            <button data-popup-open="popup-1" class="edit_btn1" onclick="Edit(<?php echo $orders[$i]['ID']; ?>)" >一審</button>
          </td>
        <?php }
          //一審[未完]結束
          } else {
            //一審[完]開始
              if ($orders[$i]['買賣']==0) {
              //此筆客戶為賣方, 一審[審完]改成[已匯]
              if ($_SESSION['權限名稱'] == '最高權限') {
                echo '<td><p style="cursor: help;" class="text-primary" data-popup-open="popup-1" onclick="Edit('.$orders[$i]['ID'].')"><b>已匯</b></td>';
              } else {
                echo "<td><p class='text-primary'><b>已匯</b></td>";
              }
            } else {
              if ($_SESSION['權限名稱'] == '最高權限') {
                echo '<td><p style="cursor: help;" class="text-danger" data-popup-open="popup-1" onclick="Edit('.$orders[$i]['ID'].')"><b>審完</b></td>';
              } else {
                echo "<td><p class='text-primary'><b>審完</b></td>";
              }
            }
            //一審[完]結束
          }
        } else {
          //沒有一二審權限
          // CHECKPOINT
          echo "<td class='debug_ongoing'>On Debug</td>";
          // The following code need the 'correct' value to show
          // echo "<td class='debug_ongoing'>".$orders[$i]['成交單狀態']."</td>";
          echo "<script type='text/javascript'>
          $('.debug_ongoing').css('color','red');
          console.log('".$orders[$i]['ID']." 成交單狀態: ".$orders[$i]['成交單狀態']."')
          </script>";
        }
        ?>
        <?php
        if ($_SESSION['二審權限']==1) {
          if ($orders[$i]['二審']==0) {
        ?>
        <td>
          <form method="GET" action="go_edit2_before0701">
            <button type="submit">二審</button>
            <input type="hidden" name="id" value="<?php echo ($orders[$i]['ID']) ?>">
          </form>
        </td>
        <?php
          } else {
            if ($orders[$i]['買賣']==1) {
              echo "<td><p class='text-danger'><b>審完</b></td>";
            } else {
              echo "<td><p class='text-primary'><b>審完</b></td>";
            }

          }
        } else {
          echo "<td></td>";
        }
        ?>

        <td>
        <?php
        if($orders[$i]['新舊']==1){
          echo "新";
        } else {
          echo "舊";
        }
        ?>

        </td>

        <td><?php echo ($orders[$i]['自行應付']) ?></td>

        <td>
          <?php echo ($orders[$i]['刻印']) ?>
          <input type="hidden" id="刻印<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['刻印']; ?>">
        </td>

            <td><?php echo ($orders[$i]['過戶費']) ?></td>

<!--         <?php if ($_SESSION['媒合權限']==1) { ?>
          <td style="min-width: 100px;">
            <?php if($orders[$i]['媒合']==0){ ?>
              <form method="post" action="match">
                <select id="inputState" name="欲媒合對方ID" class="form-control">
                    <option selected value="0">尚無</option>
                    <?php
                    for ($j=0; $j < count($all_orders); $j++) {
                        if ($orders[$i]['股票'] == $all_orders[$j]['股票'] && $orders[$i]['買賣'] != $all_orders[$j]['買賣']) {
                          echo "<option>".$all_orders[$j]['ID']."</option>";
                        }
                    }
                    ?>
                </select>
                <input type="hidden" name="欲媒合自身ID" value="<?php echo $orders[$i]['ID']?>">
                <button type="submit" id="" name="" class="">確認</button>
              </form>
            <?php } else {
              echo "<u>".$orders[$i]['媒合']."</u>";
            }
            ?>
          </td>

            <?php } else {
              if ($orders[$i]['媒合']==0) {
                echo "<td>未媒合</td>";
              } else {
                echo "<td><u>".$orders[$i]['媒合']."</u></td>";
              }
             }?> -->

            <td><?php echo ($orders[$i]['匯款日期']) ?></td>

            <td>
              <?php echo ($orders[$i]['過戶日期']) ?>
              <input type="hidden" id="過戶日期<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['過戶日期']; ?>">
            </td>

            <td>
              <?php
              if ($_SESSION['通知查帳權限']==1) {
                //有通知查帳的權限
                  if ($orders[$i]['通知查帳']=='未通知') {
                  //業務尚未點通知查帳 ?>
                    <form method="get" action="salesman_check_money">
                      <input type="hidden" name="ID" value="<?php echo $orders[$i]['ID']; ?>">
                      <button type="submit">未通知</button>
                    </form>

              <?php
                  } elseif ($orders[$i]['通知查帳']=='待對帳') {
                  //業務點了通知查帳 ?>
                    <form method="get" action="salesman_check_money">
                      <input type="hidden" name="ID" value="<?php echo $orders[$i]['ID']; ?>">
                      <a href="salesman_check_money?ID=<?php echo $orders[$i]['ID']; ?>"><img src="<?php echo base_url(); ?>static/待對帳.png" width="80" height="40"></a>
                    </form>

              <?php
                  } elseif ($orders[$i]['通知查帳']=='待確認') {
                  //已匯入銀行明細對帳正確，待大姊自己手動確認 ?>
                    <a href="boss_check_money"><img src="<?php echo base_url(); ?>static/待確認.png" width="80" height="40"></a>
              <?php
                  } else {
                  //大姊手動確認，顯示日期 ?>
                    <label><?php echo $orders[$i]['通知查帳']; ?></label>
              <?php
                  }
              } else {
              //沒有通知查帳的權限 ?>
                  <label><?php echo $orders[$i]['通知查帳']; ?></label>
              <?php
                } ?>
            </td>
            <td style="min-width:100px;">
                <?php if (file_exists("upload/contact/" . $orders[$i]['ID'])){
                  ?>
                <a class="clickable_hint" href="<?=base_url('upload/contact/'.$orders[$i]['ID'])?>" target="_blank">檢視（點開檢視檔案）</a>
                <?php } else {?>
                <form method="post" action="upload_contact" enctype="multipart/form-data">
                  <div class="form-group">
                      <input type="file" name="file" class="f-file-s" id="exampleFormControlFile1">
                      <input type="hidden" name="id" value="<?php echo $orders[$i]['ID']?>">
                      <button type="submit" id="" name="" class="">上傳</button>
                  </div>
                </form>
                <?php } ?>
            </td>
            <td>
                <?php if (file_exists("upload/tax/" . $orders[$i]['ID'])){
                  ?>
                <a class="clickable_hint" href="<?=base_url('upload/tax/'.$orders[$i]['ID'])?>" target="_blank">檢視（點開檢視檔案）</a>
                <?php  } else {?>
                <form method="post" action="upload_tax" enctype="multipart/form-data">
                  <div class="form-group">
                      <input type="file" name="file" class="f-file-s" id="exampleFormControlFile1">
                      <input type="hidden" name="id" value="<?php echo $orders[$i]['ID']?>">
                      <button type="submit" id="" name="" class="">上傳</button>
                  </div>
                </form>
                <?php } ?>
            </td>

            <?php if ($_SESSION['權限名稱'] == '最高權限') {
              if ($orders[$i]['業務'] == 'JOY') {
                if ($orders[$i]['已結案'] == 0) {
                  ?>
                 <td>
                   <form action="admin_order_end" method="post" id="admin_end">
                      <input type="hidden" name="id" value="<?php echo $orders[$i]['ID']?>">
                      <button type="submit" form="admin_end">結案</button>
                   </form>
                 </td>
              <?php } else { ?>
                <td>

                </td>
            <?php  }
            } else { ?>
                <td>
                  <?php if (file_exists("upload/water/" . $orders[$i]['ID'])){
                    ?>
                  <a class="clickable_hint" href="<?=base_url('upload/water/'.$orders[$i]['ID'])?>" target="_blank">檢視（點開檢視檔案）</a>
                  <?php  } else {?>
                  <form method="post" action="upload_water" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="file" class="f-file-s" id="exampleFormControlFile1">
                        <input type="hidden" name="id" value="<?php echo $orders[$i]['ID']?>">
                        <button type="submit" id="" name="" class="">上傳</button>
                    </div>
                  </form>
                  <?php } ?>
                </td>
            <?php }} ?>

            <td>
              <?php
                if($orders[$i]['已結案']==1){
                  echo "<label class='text-info'>"."已結</label>";
                } else {
                  echo "<label class='text-danger'>"."未結</label>";
                }
              ?>

              <?php
              //秦不知道成交單狀態要放哪，先放這。
              if($orders[$i]['成交單狀態']=='審核完成'){
                // echo '<p class="text-primary"><b>審完</b>';
                echo '<input type="hidden" id="成交單狀態'.$orders[$i]['ID'].'" name="" value="審核完成">';
              } elseif ($orders[$i]['成交單狀態']=='審核中') {
                // echo '<p class="text-success"><b>審核中</b>';
                echo '<input type="hidden" id="成交單狀態'.$orders[$i]['ID'].'" name="" value="審核中">';
              } else {
                // echo '<p class="text-danger"><b>審核不通過</b>';
                echo '<input type="hidden" id="成交單狀態'.$orders[$i]['ID'].'" name="" value="審核不通過">';
              }
              ?>

          </td>
          <td>
            <button onclick="Copy(<?php echo $orders[$i]['ID']; ?>)">複製</button>
          </td>

            <!-- 沒顯示出來的欄位 -->
            <input type="hidden" id="自行應付<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['自行應付']; ?>">
            <input type="hidden" id="匯款金額應收帳款<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款金額應收帳款']; ?>">
            <input type="hidden" id="過戶費<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['過戶費']; ?>">
            <input type="hidden" id="收送<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['收送']; ?>">
            <!-- <input type="hidden" id="現金或匯款<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['現金或匯款']; ?>"> -->
            <input type="hidden" id="匯款日期<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款日期']; ?>">
            <input type="hidden" id="趴數<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $_SESSION['趴數']; ?>">
        </tr>
          <?php if (strlen($orders[$i]['備註']) > 0) { ?>
            <tr class="note-row" onclick="js_edit_note(<?php echo $orders[$i]['ID']?>)" title="編輯備註" data-popup-open="popup-2">
              <td colspan="5" class="n-tds-1"></td>
              <td colspan="100" class="n-tds-2">
                <?php echo $orders[$i]['備註']; ?>
                <input type="hidden" value="<?php echo $orders[$i]['備註']; ?>" id="<?php echo '備註'.$orders[$i]['ID']?>">
              </td>
            </tr>
          <?php } ?>

        <?php }
      } ?>

      </tbody>
      </table>
     </main>
    </div>
  </div>
   <div class="s-modal" data-popup="popup-1">
    <div class="modal-content">
     <div class="modal-header">
      <h3>編輯成交單</h3>
      <span class="s-close" data-popup-close="popup-1">&times;</span>
      </div>
      <form method="post" name="edit_order_info" action="edit_order_status" >
        <!-- 為修改成交單狀態,與edit_order不同 -->
        <div class="modal-main">
          <table>
            <tr>
              <td><label>成交單編號</label></td>
              <td><input readonly type="text" name="ID" value="" id="edit_id"></td>
              <td><label>客戶姓名</label></td>
              <td><input type="text" name="客戶姓名" value="" id="edit_name"></td>
            </tr>
            <tr>
              <td><label>身分證字號</label></td>
              <td><input type="text" name="身分證字號" value="" id="edit_F"></td>
              <td><label>聯絡地址</label></td>
              <td><input type="text" name="聯絡地址" value="" id="edit_address"></td>
              <td><label>聯絡電話</label></td>
              <td><input type="text" name="聯絡電話" value="" id="edit_phone"></td>
            </tr>
            <tr>
              <td><label>成交日期</label></td>
              <td><input class="" type="date" name="成交日期" value="" id="edit_成交日期" required=""></td>
              <td><label>過戶日期</label></td>
              <td><input class="" type="date" name="過戶日期" value="" id="edit_過戶日期"></td>
            </tr>
            <tr>
              <td><label>股票名稱</label></td>
              <td><input type="text" name="股票" value="" id="edit_company"></td>
              <td width="20px">
                <input type="radio" name="買賣" value="1" checked><label class="text-danger"><b>買</b></label>
                <input type="radio" name="買賣" value="0"><label class="text-primary"><b>賣</b></label>
              </td>
              <td></td>
              <td><label>張數</label></td>
              <td><input type="text" name="張數" value="" class="autochange" id="edit_amount"></td>
            </tr>
            <tr>
              <td><label>轉讓會員</label></td>
              <td>
                <select id="edit_轉讓會員" name="轉讓會員" class="form-control" required>
                  <!-- option></option -->
                    <?php
                    for ($j=0; $j < count($employees); $j++) {
                        echo "<option value=".$employees[$j]['NAME'].">".$employees[$j]['NAME']."</option>";
                    }
                    ?>
                </select>
              </td>
              <td><label>成交價</label></td>
              <td><input type="text" name="成交價" value="" class="autochange" id="edit_成交價"></td>
              <td><label>盤價</label></td>
              <td><input type="text" name="盤價" value="" id="edit_盤價"></td>
            </tr>
            <tr>
              <td><label>自行應付</label></td>
              <td>
                <input type="text" name="自行應付" value="" id="edit_自行應付">
              </td>
            </tr>
          </table>
        </div>
        <div class="">
          <label><h4>賣方需填</h4></label>
          <br>
          <table>
            <tr>
              <td><label>匯款銀行</label></td>
              <td><input type="text" name="匯款銀行" value="" id="edit_匯款銀行"></td>
              <td><label>匯款分行</label></td>
              <td><input type="text" name="匯款分行" value="" id="edit_匯款分行"></td>
              <td><label>匯款戶名</label></td>
              <td><input type="text" name="匯款戶名" value="" id="edit_匯款戶名"></td>
              <td><label>匯款帳號</label></td>
              <td><input type="text" name="匯款帳號" value="" id="edit_匯款帳號"></td>
            </tr>
            <tr>
              <td class="text-danger"><label><b>匯款/應收金額<b/></label></td>
              <td>
                <input type="text" name="匯款金額應收帳款" class="autochange" value="" id="edit_匯款金額應收帳款">
              </td>
              <!-- <td></td> -->
            </tr>
            <tr>
              <td><label>完稅人</label></td>
              <td>
                <input type="text" name="完稅人" value="" id="edit_完稅人" required="">
              </td>
              <td><label>過戶費</label></td>
              <td>
                <input type="text" name="過戶費" value="" id="edit_過戶費" required="">
              </td>
              <td><label>刻印</label></td>
              <td>
                <input type="text" name="刻印" value="" id="edit_刻印" required="">
              </td>
              <td><label>收送</label></td>
              <td>
                <input type="text" name="收送" class="autochange" value="" id="edit_收送">
              </td>
            </tr>
            <tr>
              <td></td>
              <td>
                <label class="text-danger">***記得選取成交單狀態***</label>
              </td>
            </tr>
            <tr>
              <td><label>成交單狀態</label></td>
              <td>
                <input type="radio" name="成交單狀態" value="審核完成" checked><label class="text-primary">審核完成</label>
                <input type="radio" name="成交單狀態" value="審核中"><label class="text-success">審核中</label>
              </td>
            </tr>
            <!-- <tr>
              <td><label>現金或匯款</label></td>
              <td>
                <input type="radio" name="現金或匯款" value="現金"><label class="">現金</label>
                <input type="radio" name="現金或匯款" value="匯款" checked><label class="">匯款</label>
              </td>
            </tr> -->
            <tr>
              <td><label>匯款日期</label></td>
              <td>
                <input class="paydate" type="date" min='1899-01-01' max="2100-12-31" name="匯款日期" value="" id="edit_匯款日期">
                <button type="button" onclick="getdealdate()">同成交日期</button>
              </td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td><input class="" type="submit" name="修改完成" value="修改完成" id=""></td>
            </tr>
          </table>
        </div>
      </form>
    </div>
  </div>

  <!-- 備註modal -->
  <div class="s-modal"data-popup="popup-2">
    <div class="modal-content">
      <div class="modal-header">
        <h3>編輯備註</h3>
         <span class="s-close" data-popup-close="popup-2">&times;</span>
      </div>
      <form method="post" name="" action="edit_note" id="編輯備註">
        <div class="modal-main">
          <!-- 再請修改,套參數 -->
          <p>備註內容:</p>
          <textarea id="edit_備註" name="edit_備註" cols="50" rows="5"></textarea>
          <input type="hidden" name="note_id" id="note_id" value="">
          <!-- <input type="text" id="edit_備註" name="edit_備註"> -->
          <button type="submit" form="編輯備註">送出</button>
        </div>
      </form>
    </div>
  </div>
<!-- End of 備註modal -->
<!-- modal function assets/js/action.js -->
        <style type="text/css">
          .clickable_hint {
            color: Steelblue;
            /*color: RebeccaPurple;*/
            text-decoration:underline;
          }
        </style>

        <script>

          // function selectByRange() {
          //   // alert($("#datePicker_2").val());
          //   if ($("#datePicker_1").val() && $("#datePicker_2").val() && $("#業務").val()) {
          //     document.location.href = "go_orders?業務=" + $("#業務").val() + "&date1=" + $("#datePicker_1").val() + "&date2=" + $("#datePicker_2").val();
          //   }
          //   document.getElementById("dateselectorinfo").innerHTML = $("#datePicker_1").val()+'~'+$("#datePicker_2").val();
          // }

          function selectByRange2() {
            if ($("#datePicker_1").val() && $("#datePicker_2").val() && $("#業務").val()) {
              document.location.href = "go_orders_before0701?業務=" + $("#業務").val() + "&date1=" + $("#datePicker_1").val() + "&date2=" + $("#datePicker_2").val();
            } else if ($("#datePicker_1").val() && $("#datePicker_2").val() && !$("#業務").val()) {
              document.location.href = "date1=" + $("#datePicker_1").val() + "&date2=" + $("#datePicker_2").val();
            } else {
              document.location.href = "go_orders_before0701?業務=" + $("#業務").val();
            }
            // document.getElementById("dateselectorinfo").innerHTML = $("#業務").val()+':'+$("#datePicker_1").val()+'~'+$("#datePicker_2").val();
          }

          function changefont(i) {
            document.getElementById("mousemove"+i).style.color="orange";
          }

          function changefont_back(i) {
            document.getElementById("mousemove"+i).style.color="black";
          }


          //計算獎金
          function showbonus(i){
            var id = i;
            var 成交價 = document.getElementById('成交價'+id).value;
            var 盤價 = document.getElementById('盤價'+id).value;
            var 張數 = document.getElementById('amount'+id).value;
            var 過戶費 = document.getElementById('過戶費'+id).value;
            var 自行應付 = document.getElementById('自行應付'+id).value
            // var 趴數 = document.getElementById('趴數'+id).value;
            // var employee = document.getElementById('業務'+id).value;
            // alert(employee);
            // url = "<?=base_url()?>index.php/orders/get_employee_byname";
            // $.ajax({
            //   url: url,
            //   type: 'post',
            //   data: {employee:employee},
            //   dataType: "json",
            //   success: function(data){
            //     alert("success");
            //     var 趴數 = data.趴數;
            //   },
            //   error:function(xhr, ajaxOptions, thrownError){
            //     alert("error");
            //   }
            // });

            var 稅金 = 0;
            // alert(document.getElementById('買賣'+id).value);
            if (document.getElementById('買賣'+id).value==1) {
              var 買賣 = '買';
            } else {
              var 買賣 = '賣';
            }
            if (買賣=='賣') {
              稅金 = 成交價*張數*1000*0.003;
            }
            alert('成交價 '+成交價+'\n盤價 '+盤價+'\n張數 '+張數+'\n'+買賣+'\n稅金 '+稅金+'\n過戶費 '+過戶費+'\n自行應付 '+自行應付);
          }

          //大姊一鍵將客戶為買的一審改為已匯
          function Buy_Edit(i) {
            var id = i;
            url = "<?=base_url()?>index.php/orders/Buy_Edit";
            go = "<?=base_url()?>index.php/orders/go_orders_before0701";
            $.ajax({
              url: url,
              type: 'post',
              data: {id:id},
              dataType: "json",
              success: function(data){
                // alert(data);
                window.location.replace(go);
              },
              error:function(xhr, ajaxOptions, thrownError){
              }
            });
          }

          //編輯備註
          function js_edit_note(i) {
            var source = document.getElementById('備註'+i).value;
            // alert(source);
            document.getElementById('edit_備註').value = source;
            document.getElementById('note_id').value = i;
          }

          //編輯成交單
          function Edit(i){
            var id = i;
            document.getElementById('edit_id').value = id;
            document.getElementById("edit_匯款金額應收帳款").value = 0;
            ['name', 'F', 'phone','address','company','amount','成交價','盤價','匯款銀行','匯款金額應收帳款','過戶費','匯款日期','刻印',
                '匯款分行','匯款戶名','轉讓會員','匯款帳號','完稅人','成交日期','過戶日期','自行應付','收送'
              ].forEach(function(field) {
              var source = document.getElementById(field+id);
              if (!source) {
                console.log('source not exist:' + field + id);
                return;
              }
              var edit = document.getElementById('edit_' + field);
              if (!edit) {
                console.log('not exist: edit_' + field);
                return;
              }
              edit.value = source.value;
            });

            var form = document.querySelector('form[name="edit_order_info"]');
            ['買賣','成交單狀態','現金或匯款'].forEach(function(field) {
              form.elements[field].value = document.getElementById(field+id).value;
            });
          }

          //複製成交單
          function Copy(i) {
            var id = i;
            // alert('確認是否複製 [成交單]編號['+id+']')
            if (str=prompt("確認複製成交單編號["+id+"]請輸入 y或Y ","")) {
              if (str=='Y'||str=='y') {
                url = "<?=base_url()?>index.php/orders/copy";
                go = "<?=base_url()?>index.php/orders/go_orders_before0701";
                $.ajax({
                  url: url,
                  type: 'post',
                  data: {id:id},
                  dataType: "json",
                  success: function(data){
                    // alert(data);
                    window.location.replace(go);
                  },
                  error:function(xhr, ajaxOptions, thrownError){
                  }
                });
              } else {
                alert("輸入字串錯誤，取消刪除");
              }
            } else {
              alert("取消刪除");
            }
          }

          //刪除成交單
          function Delete(i) {
            var id = i;
            // alert('是否確定刪除 [成交單]編號['+id+']。');
            if (str=prompt("確認刪除成交單編號["+id+"]請輸入 y或Y ","")) {
              if (str=='Y'||str=='y') {
                url = "<?=base_url()?>index.php/orders/delete";
                go = "<?=base_url()?>index.php/orders/go_orders_before0701";
                $.ajax({
                  url: url,
                  type: 'post',
                  data: {id:id},
                  dataType: "json",
                  success: function(data){
                    // alert(data);
                    window.location.replace(go);
                  },
                  error:function(xhr, ajaxOptions, thrownError){
                  }
                });
              } else {
                alert("輸入字串錯誤，取消刪除");
              }
            } else {
              alert("取消刪除");
            }

          }

          //計算匯款金額與自行應付
          function calculate_sell() {
            document.getElementById("edit_匯款金額應收帳款").value = document.getElementById('edit_amount').value*document.getElementById('edit_成交價').value*1000*0.997;
            document.getElementById('edit_自行應付').value = document.getElementById("edit_匯款金額應收帳款").value - (document.getElementById('edit_amount').value*document.getElementById('edit_成交價').value*1000*0.997);
          }
          function calculate_buy() {
            document.getElementById("edit_匯款金額應收帳款").value = document.getElementById('edit_amount').value*document.getElementById('edit_成交價').value*1000;
            document.getElementById('edit_自行應付').value = document.getElementById("edit_匯款金額應收帳款").value - (document.getElementById('edit_amount').value*document.getElementById('edit_成交價').value*1000);
          }

          //自行應付變動=匯款金額-股票金額
          $(document).ready(function(){
            $(".autochange").change(function(){
              var a = document.getElementById('edit_收送').value;
              if (!a) {
                a = 0;
              } else {
                a = parseInt(a);
              }
              document.getElementById('edit_自行應付').value = document.getElementById("edit_匯款金額應收帳款").value - (document.getElementById('edit_amount').value*document.getElementById('edit_成交價').value*1000*0.997)+(document.getElementById('edit_刻印').value*40) + a;
            });
          });

          //匯款日期抓成交日期
          function getdealdate() {
            document.getElementById("edit_匯款日期").value = document.getElementById("edit_成交日期").value;
            var pay = document.getElementById("edit_匯款日期").value;
            var paydate = new Date(pay);
            month = '' + (paydate.getMonth()+1),
            day = '' + (paydate.getDate()+3),
            year = paydate.getFullYear();
            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;
            result = [year, month, day].join('-');
            document.getElementById('edit_過戶日期').value = result;
          }

          //過戶日期=匯款日期+3
          $(document).ready(function(){
            $(".paydate").change(function(){
              var pay = document.getElementById("edit_匯款日期").value;
              var paydate = new Date(pay);
              month = '' + (paydate.getMonth()+1),
              day = '' + (paydate.getDate()+3),
              year = paydate.getFullYear();
              if (month.length < 2) month = '0' + month;
              if (day.length < 2) day = '0' + day;
              result = [year, month, day].join('-');
              document.getElementById('edit_過戶日期').value = result;
            });
          });

          feather.replace()

        </script>
    </body>
</html>