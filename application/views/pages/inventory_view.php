
                <main role="main" style="flex: 1 0 auto;" >
                  <div class="t-form-h">
                    <div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

                        <h1 class="h2">成交單</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                              <!-- <button class="btn btn-sm btn-outline-secondary" id="new_order">新增成交單</button> -->
                              <button class="btn btn-sm btn-outline-secondary">所有</button>
                              <button class="btn btn-sm btn-outline-secondary">未審核</button>
                              <button class="btn btn-sm btn-outline-secondary">審核完</button>
                              <button id="inventory" class="btn btn-sm btn-outline-secondary">庫存</button>
                              <input class="btn btn-sm btn-outline-secondary" type="button" onclick="location.href='new_order';" value="新增成交單" />
                              <button class="btn btn-sm btn-outline-secondary">匯出</button>
                              <!-- <button class="btn btn-primary">匯出</button> -->
                            </div>
                            <!-- <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                              <span data-feather="calendar"></span>
                              This week
                            </button>
 -->                        </div>
                    </div>

                <!-- <canvas class="my-4" id="myChart" width="900" height="380"></canvas> -->

                  <div class="t-form-t">
                    <!-- <button id="pnAdvancerLeft" class="pn-Advancer pn-Advancer_Left" type="button">
                      <svg class="pn-Advancer_Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 551 1024"><path d="M445.44 38.183L-2.53 512l447.97 473.817 85.857-81.173-409.6-433.23v81.172l409.6-433.23L445.44 38.18z"/></svg>
                    </button>
                    <button id="pnAdvancerRight" class="pn-Advancer pn-Advancer_Right" type="button">
                      <svg class="pn-Advancer_Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 551 1024"><path d="M105.56 985.817L553.53 512 105.56 38.183l-85.857 81.173 409.6 433.23v-81.172l-409.6 433.23 85.856 81.174z"/></svg>
                    </button> -->
                    <!-- <h2>成交單清冊</h2> -->
                  </div>


                    <div class="t-form">
                        <table id="eoTable" class="table table-md table-hover table-responsive" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>
                            <thead class="thead-light">
                                <tr>
                                    <th data-tablesaw-priority="persist"></th>
                                    <th data-tablesaw-priority="2">編號</th>
                                    <th data-tablesaw-priority="2" scope="col">成交日期</th>
                                    <th data-tablesaw-priority="2">業務</th>
                                    <th data-tablesaw-priority="2">客戶姓名</th>
                                    <th data-tablesaw-priority="2">身分證字號</th>
                                    <th data-tablesaw-priority="2">聯絡電話</th>
                                    <th data-tablesaw-priority="2">聯絡人</th>
                                    <th data-tablesaw-priority="2">聯絡住址</th>
                                    <th data-tablesaw-priority="2">買賣</th>
                                    <th data-tablesaw-priority="2">股票</th>
                                    <th data-tablesaw-priority="2">張數</th>
                                    <th data-tablesaw-priority="2">成交價</th>
                                    <th data-tablesaw-priority="2">盤價</th>
                                    <th data-tablesaw-priority="2">匯款/應收金額</th>
                                    <th data-tablesaw-priority="2">匯款銀行</th>
                                    <th data-tablesaw-priority="2">匯款分行</th>
                                    <th data-tablesaw-priority="2">匯款戶名</th>
                                    <th data-tablesaw-priority="2">匯款帳號</th>
                                    <th data-tablesaw-priority="2">轉讓會員</th>
                                    <th data-tablesaw-priority="2">完稅人</th>
                                    <th data-tablesaw-priority="2">一審</th>
                                    <th data-tablesaw-priority="2">二審</th>
                                    <!-- <th>成交單狀態</th> -->
                                    <th data-tablesaw-priority="2">新舊</th>
                                    <th data-tablesaw-priority="2">自行應付</th>
                                    <th data-tablesaw-priority="2">刻印</th>
                                    <th data-tablesaw-priority="2">過戶費</th>
                                    <th data-tablesaw-priority="2">媒合</th>
                                    <th data-tablesaw-priority="2">收付款</th>
                                    <th data-tablesaw-priority="2">過戶日期</th>
                                    <th data-tablesaw-priority="2">通知查帳</th>
                                    <th data-tablesaw-priority="2">上傳契約-要記得選擇檔案</th>
                                    <th data-tablesaw-priority="2">上傳稅單-要記得選擇檔案</th>
                                    <th data-tablesaw-priority="2">是否結案</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($orders) {
                                    for($i=0; $i<count($orders); $i++) { ?>
                                <tr>
                                    <td>
                                      <form method="GET" action="go_edit">
                                        <button type="submit">編輯</button>
                                        <input type="hidden" name="id" value="<?php echo ($orders[$i]['ID']) ?>">
                                      </form>
                                    </td>
                                    <td><?php echo ($orders[$i]['ID']) ?></td>
                                    <td>
                                      <?php echo ($orders[$i]['成交日期']) ?>
                                      <input type="hidden" id="成交日期<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['成交日期']; ?>">
                                    </td>
                                    </td>
                                    <td><?php echo ($orders[$i]['業務']) ?></td>
                                    <td>
                                      <?php echo ($orders[$i]['客戶姓名']) ?>
                                      <input type="hidden" id="name<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['客戶姓名']; ?>">
                                    </td>
                                    <td>
                                      <?php echo ($orders[$i]['身分證字號']) ?>
                                      <input type="hidden" id="F<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['身分證字號']; ?>">
                                    </td>
                                    <td>
                                      <?php echo ($orders[$i]['聯絡電話']) ?>
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
                                    ?></p></td>
                                    <td>
                                      <?php echo ($orders[$i]['股票']) ?>
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
                                      <?php echo ($orders[$i]['匯款金額']) ?>
                                      <input type="hidden" id="匯款金額<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款金額']; ?>">
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
                                    <td>
                                      <?php echo ($orders[$i]['轉讓會員']) ?></td>
                                      <input type="hidden" id="轉讓會員<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['轉讓會員']; ?>">
                                    <td>
                                      <?php echo ($orders[$i]['完稅人']) ?>
                                      <input type="hidden" id="完稅人<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['完稅人']; ?>">
                                    </td>
                                    <?php
                                      if ($orders[$i]['成交單狀態']!='審核完成') {
                                    ?>
                                    <!-- Trigger/Open The Modal -->
                                    <td>
                                      <button data-popup-open="popup-1" class="edit_btn1" onclick="Edit(<?php echo $orders[$i]['ID']; ?>)" >一審</button>
                                    </td>
                                    <?php
                                      } else {
                                        echo "<td><p class='text-primary'><b>審完</b></td>";
                                      }
                                    ?>
                                    <td>
                                      <form method="POST" action="go_edit2">
                                        <button type="submit">二審</button>
                                        <input type="hidden" name="id" value="<?php echo ($orders[$i]['ID']) ?>">
                                      </form>
                                    </td>
                                    <?php
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
                                    <td><?php
                                    if($orders[$i]['新舊']==1){
                                      echo "新";
                                    } else {
                                      echo "舊";
                                    }
                                    ?></td>
                                    <td><?php echo ($orders[$i]['自行應付']) ?></td>
                                    <td>
                                      <?php echo ($orders[$i]['刻印']) ?>
                                      <input type="hidden" id="刻印<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['刻印']; ?>">
                                    </td>
                                    <td><?php echo ($orders[$i]['過戶費']) ?></td>
                                    <?php if ($_SESSION['權限名稱']=='最高權限') { ?>
                                      <td style="min-width: 100px;">
                                        <?php if($orders[$i]['媒合']==0){ ?>
                                          <form method="post" action="match">
                                            <select id="inputState" name="欲媒合對方ID" class="form-control">
                                                <option selected value="0">尚無</option>
                                                <?php
                                                for ($j=0; $j < count($orders); $j++) {
                                                    echo "<option>".$orders[$j]['ID']."</option>";
                                                }
                                                ?>
                                            </select>
                                            <input type="hidden" name="欲媒合自身ID" value="<?php echo $orders[$i]['ID']?>">
                                            <button type="submit" id="" name="" class="">確認</button>
                                          </form>
                                        <?php } else {
                                          echo $orders[$i]['媒合'];
                                        }
                                        ?>
                                      </td>
                                    <?php } else {
                                      if ($orders[$i]['媒合']==0) {
                                        echo "<td>未媒合</td>";
                                      } else {
                                        echo $orders[$i]['媒合'];
                                      }
                                     }?>

                                    <td><?php echo ($orders[$i]['匯款日期']) ?></td>
                                    <td>
                                      <?php echo ($orders[$i]['過戶日期']) ?>
                                      <input type="hidden" id="過戶日期<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['過戶日期']; ?>">
                                    </td>
                                    <td>
                                        <form method="post" action="checkbill">
                                            <button type="submit">通知查帳</button>
                                        </form>
                                    </td>
                                    <td style="min-width:100px;">
                                        <?php if (file_exists("upload/contact/" . $orders[$i]['ID'])){
                                          ?>
                                        <a href="<?=base_url('upload/contact/'.$orders[$i]['ID'])?>" target="_blank">檢視</a>
                                        <?php } else {?>
                                        <form method="post" action="upload_contact" enctype="multipart/form-data">
                                          <div class="form-group">
                                              <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                                              <input type="hidden" name="id" value="<?php echo $orders[$i]['ID']?>">
                                              <button type="submit" id="" name="" class="">上傳</button>
                                          </div>
                                        </form>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if (file_exists("upload/tax/" . $orders[$i]['ID'])){
                                          ?>
                                        <a href="<?=base_url('upload/tax/'.$orders[$i]['ID'])?>" target="_blank">檢視</a>
                                        <?php  } else {?>
                                        <form method="post" action="upload_tax" enctype="multipart/form-data">
                                          <div class="form-group">
                                              <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                                              <input type="hidden" name="id" value="<?php echo $orders[$i]['ID']?>">
                                              <button type="submit" id="" name="" class="">上傳</button>
                                          </div>
                                        </form>
                                        <?php } ?>
                                    </td>
                                    <td class="text-danger">
                                      <?php
                                        if($orders[$i]['已結案']==1){
                                          echo "已結";
                                        } else {
                                          echo "未結";
                                        }
                                      ?>
                                    </td>

                                    <!-- 沒顯示出來的欄位 -->
                                    <input type="hidden" id="自行應付<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['自行應付']; ?>">
                                    <input type="hidden" id="匯款金額<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款金額']; ?>">
                                    <input type="hidden" id="過戶費<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['過戶費']; ?>">
                                    <input type="hidden" id="刻印收送<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['刻印收送']; ?>">
                                    <input type="hidden" id="現金或匯款<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['現金或匯款']; ?>">
                                    <input type="hidden" id="匯款日期<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['匯款日期']; ?>">

                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
