
                <!-- <main role="main" style="flex: 1 0 auto;" >
                  <div class="t-form-h">
                    <div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
                        <h1 class="h2">應收帳款</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/checkbill'" value="所有應收"></input>
                                <?php if ($_SESSION['權限名稱']=='最高權限') { ?>
                                    <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/boss_check_money'" value="尚未對帳"></input>
                                <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/check_record'" value="紀錄"></input>
                                <?php } ?>
                                <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/pay_error'" value="轉出異常"></input>
                            </div>
                        </div>
                    </div> -->



  <div class="t-form">
    <div class="t-form-h">
      <?php if ($_SESSION['權限名稱']=='最高權限') { ?>
          <form class="form-horizontal well" action="import" method="post" name="upload_excel" enctype="multipart/form-data" style= "display:inline;">
          <div class="upload-files">
              <label for="receFileUpload" class="btn btn-sm btn-outline-secondary">選擇檔案</label>
              <input id="receFileUpload" type="file" name="file[]" class="input-large" multiple>
              <span class="filename_zone"></span>
            </div>
            <button type="submit" id="submit" name="Import" class="btn btn-sm btn-outline-secondary">上傳</button>
          </form>
          <div class="total-zone">
            <span>
              <?php if ($_SESSION['權限名稱'] == '最高權限') {
                echo "目前範圍 <font color='red' size='4'>".$first_dateofdata."~".$last_dateofdata."</font";
              } ?>
            </span>
            <span>
                <?php if ($_SESSION['權限名稱']=='最高權限') {
                  echo "總應收: ".$total_info['total_receivable'];
                  } ?>
            </span>
            <span>
                <?php if ($_SESSION['權限名稱']=='最高權限') {
                  echo "總已收:".$total_info['total_received'];
                  } ?>
            </span>
            <span>
                <?php if ($_SESSION['權限名稱']=='最高權限') {
                  echo "總尚餘:".$total_info['total_left'];
                  } ?>
            </span>
          </div>

          <!-- <input class="btn btn--s1 btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/reconcile'" value="對帳"> -->
      <?php } ?>
    </div>
      <?php if ($_SESSION['NAME'] == '小祿'){
          echo "<span><b>此處資料來源為orders表，而非check_money_record表！！！！！！！！！！！</b></span>";
      } ?>
      <table id="receivTable" class="table table-md table-hover table-responsive" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>
        <thead class="thead-light">
          <tr>
          <th data-tablesaw-priority="1">編號</th>
          <th data-tablesaw-priority="1" scope="col">成交日期</th>
          <th data-tablesaw-priority="1">業務</th>
          <th data-tablesaw-priority="1">客戶姓名</th>
          <th data-tablesaw-priority="1">股票</th>
          <th data-tablesaw-priority="0">身分證字號</th>
          <th data-tablesaw-priority="0">聯絡電話</th>
          <th data-tablesaw-priority="0">聯絡人</th>
          <th data-tablesaw-priority="0">聯絡住址</th>
          <th data-tablesaw-priority="0">買賣</th>
          <th data-tablesaw-priority="0">股票</th>
          <th data-tablesaw-priority="1">張數</th>
          <th data-tablesaw-priority="1">成交價</th>
          <th data-tablesaw-priority="0">盤價</th>
          <th data-tablesaw-priority="1">應收金額</th>
          <th data-tablesaw-priority="1">已收金額</th>
          <th data-tablesaw-priority="1">尚餘應收</th>
          <!-- <th data-tablesaw-priority="1">待查帳金額</th> -->
          <th data-tablesaw-priority="0">匯款戶名</th>
          <th data-tablesaw-priority="0">匯款帳號</th>
          <th data-tablesaw-priority="0">轉讓會員</th>
          <th data-tablesaw-priority="1">完稅人</th>
          <th data-tablesaw-priority="1">過戶日期</th>
          <!-- <th data-tablesaw-priority="1">匯款日期</th> -->
          <?php if ($_SESSION['權限名稱']=='最高權限') { ?>
          <th data-tablesaw-priority="1">查帳狀態</th>
          <?php } else { ?>
          <th data-tablesaw-priority="1">通知查帳</th>
          <?php } ?>
          </tr>
        </thead>
      <tbody>
          <?php if($orders) {
              for($i=0; $i<count($orders); $i++) { ?>
          <tr>
              <td><?php echo ($orders[$i]['ID']) ?></td>
              <td>
                <?php echo ($orders[$i]['成交日期']) ?>
                <input type="hidden" id="成交日期<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['成交日期']; ?>">
              </td>
              </td>
              <td>
                <a class="clickable_hint" href="javascript:location.href='
                  <?php
                  echo base_url()."index.php/orders/checkbill?業務=".$orders[$i]['業務'];
                  ?>'"
                  title="<?php echo ($orders[$i]['業務']) ?>"><?php echo ($orders[$i]['業務']) ?></a>
              </td>
              <td>
                <a class="clickable_hint" href="javascript:location.href='
                  <?php
                  echo base_url()."index.php/orders/checkbill?客戶姓名=".$orders[$i]['客戶姓名'];
                  ?>'"
                  title="<?php echo ($orders[$i]['客戶姓名']) ?>"><?php echo ($orders[$i]['客戶姓名']) ?></a>
                <input type="hidden" id="name<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['客戶姓名']; ?>">
              </td>
              <td>
                <a class="clickable_hint" href="javascript:location.href='
                  <?php
                  echo base_url()."index.php/orders/checkbill?股票=".$orders[$i]['股票'];
                  ?>'"
                  title="<?php echo ($orders[$i]['股票']) ?>"><?php echo ($orders[$i]['股票']) ?></a>
                <input type="hidden" id="name<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['股票']; ?>">
              </td>
              <td>
                <?php echo ($orders[$i]['身分證字號']) ?>
                <input type="hidden" id="F<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['身分證字號']; ?>">
              </td>
              <td>
                <a class="clickable_hint" href="javascript:location.href='
                  <?php
                  echo base_url()."index.php/orders/checkbill?聯絡電話=".$orders[$i]['聯絡電話'];
                  ?>'"
                  title="<?php echo ($orders[$i]['聯絡電話']) ?>"><?php echo ($orders[$i]['聯絡電話']) ?></a>
                <input type="hidden" id="phone<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['聯絡電話']; ?>">
              </td>
              <td>
                <?php echo ($orders[$i]['聯絡人']) ?>
              </td>
              <td>
                <?php echo ($orders[$i]['聯絡地址']) ?>
                <input type="hidden" id="address<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['聯絡地址']; ?>">
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
                  echo base_url()."index.php/orders/checkbill?股票=".$orders[$i]['股票'];
                  ?>'"
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
                <?php echo ($orders[$i]['盤價']) ?>
                <input type="hidden" id="盤價<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['盤價']; ?>">
              </td>
              <td>
                <?php echo ($orders[$i]['匯款金額應收帳款']) ?>
                <input type="hidden" id="匯款金額應收帳款<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款金額應收帳款']; ?>">
              </td>
              <td>
                <label class="text-primary"><p><?php echo ($orders[$i]['已匯金額已收金額']) ?></p></label>
                <input type="hidden" id="已匯金額已收金額<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['已匯金額已收金額']; ?>">
              </td>
              <td>
                <label class="text-success"><?php echo (($orders[$i]['匯款金額應收帳款']-$orders[$i]['已匯金額已收金額'])) ?></label>
                <input type="hidden" id="尚餘應收<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款金額應收帳款']-$orders[$i]['已匯金額已收金額']; ?>">
              </td>
              <!-- <td>
                <label class="text-primary"><p><?php echo ($orders[$i]['待查帳金額']) ?></p></label>
                <input type="hidden" id="待查帳金額<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['待查帳金額']; ?>">
              </td> -->
              <td>
                <?php echo ($orders[$i]['匯款戶名']) ?>
                <input type="hidden" id="匯款戶名<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款戶名']; ?>">
              </td>
              <td>
                <?php echo ($orders[$i]['匯款帳號']) ?>
                <input type="hidden" id="匯款帳號<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款帳號']; ?>">
              </td>
              <td class="<?php if($orders[$i]['轉讓會員'] =='庫存') { echo "td-cs-1"; } ?>">
                <?php echo ($orders[$i]['轉讓會員']) ?>
                <input type="hidden" id="轉讓會員<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['轉讓會員']; ?>">
              </td>
              <td>
                <?php echo ($orders[$i]['完稅人']) ?>
                <input type="hidden" id="完稅人<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['完稅人']; ?>">
              </td>
              <td>
                <?php echo ($orders[$i]['過戶日期']) ?>
                <input type="hidden" id="過戶日期<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['過戶日期']; ?>">
              </td>
              <!-- <td>
                <?php echo ($orders[$i]['匯款日期']) ?>
                <input type="hidden" id="匯款日期<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款日期']; ?>">
              </td> -->
              <td>
              <?php
                  if ($orders[$i]['通知查帳']=='未通知') { ?>
                      <form method="get" action="salesman_check_money">
                          <input type="hidden" name="ID" value="<?php echo $orders[$i]['ID']; ?>">
                          <button type="submit">未通知</button>
                      </form>
              <?php
                  } elseif ($orders[$i]['通知查帳']=='待對帳') { ?>
                      <img src="<?php echo base_url(); ?>uploads/static/待對帳.png" width="80" height="40">
              <?php
                  } elseif ($orders[$i]['通知查帳']=='待確認') { ?>
                      <p>sss</p><img src="<?php echo base_url(); ?>uploads/static/待確認.png" width="80" height="40">
              <?php
                  } else { ?>
                      <label><b><?php echo $orders[$i]['通知查帳']; ?></b></label>
              <?php }
              ?>
              </td>

              <!-- <td class="text-danger">
                <?php
                  if($orders[$i]['已結案']==1){
                    echo "已結";
                  } else {
                    echo "未結";
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

              </td> -->

              <!-- 沒顯示出來的欄位 -->
              <input type="hidden" id="自行應付<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['自行應付']; ?>">
              <input type="hidden" id="匯款金額應收帳款<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款金額應收帳款']; ?>">
              <input type="hidden" id="過戶費<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['過戶費']; ?>">
              <input type="hidden" id="收送<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['收送']; ?>">
              <!-- <input type="hidden" id="現金或匯款<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['現金或匯款']; ?>"> -->
              <!-- <input type="hidden" id="匯款日期<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款日期']; ?>"> -->

          </tr>
          <?php }} ?>
      </tbody>
    </table>
    </div>
  </main>
</div>
</div>
    <script type="text/javascript">

    $("#receFileUpload").change(function(){
      fileName = $(this)[0].files[0].name;
       $('.filename_zone').html(fileName);
      console.log("fileName" + fileName);
      });
    </script>
