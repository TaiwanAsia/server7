
                <main role="main" style="flex: 1 0 auto;" >
                  <div class="t-form-h">
                    <div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">

                        <h1 class="h2">成交單</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                              <!-- <button class="btn btn-sm btn-outline-secondary" id="new_order">新增成交單</button> -->
                              <!-- <button class="btn btn-sm btn-outline-secondary">所有</button> -->
                              <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/index'" value="所有"></input>
                              <button class="btn btn-sm btn-outline-secondary">未審核</button>
                              <button class="btn btn-sm btn-outline-secondary">審核完</button>
                              <form action="go_inventory" method="post">
                                <button id="inventory" class="btn btn-sm btn-outline-secondary">庫存</button>
                              </form>
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
                                  <th data-tablesaw-priority="0">編號</th>
                                  <th data-tablesaw-priority="1" scope="col">成交日期</th>
                                  <th data-tablesaw-priority="0">業務</th>
                                  <th data-tablesaw-priority="1">客戶姓名</th>
                                  <th data-tablesaw-priority="0">身分證字號</th>
                                  <th data-tablesaw-priority="1">聯絡電話</th>
                                  <th data-tablesaw-priority="0">聯絡人</th>
                                  <th data-tablesaw-priority="0">聯絡住址</th>
                                  <th data-tablesaw-priority="0">買賣</th>
                                  <th data-tablesaw-priority="1">股票</th>
                                  <th data-tablesaw-priority="1">張數</th>
                                  <th data-tablesaw-priority="1">成交價</th>
                                  <th data-tablesaw-priority="1">盤價</th>
                                  <th data-tablesaw-priority="0">匯款/應收金額</th>
                                  <th data-tablesaw-priority="0">匯款銀行</th>
                                  <th data-tablesaw-priority="0">匯款分行</th>
                                  <th data-tablesaw-priority="0">匯款戶名</th>
                                  <th data-tablesaw-priority="0">匯款帳號</th>
                                  <th data-tablesaw-priority="0">轉讓會員</th>
                                  <th data-tablesaw-priority="0">完稅人</th>
                                  <th data-tablesaw-priority="0">一審</th>
                                  <th data-tablesaw-priority="0">二審</th>
                                  <!-- <th>成交單狀態</th> -->
                                  <th data-tablesaw-priority="0">新舊</th>
                                  <th data-tablesaw-priority="0">自行應付</th>
                                  <th data-tablesaw-priority="0">刻印</th>
                                  <th data-tablesaw-priority="0">過戶費</th>
                                  <th data-tablesaw-priority="0">媒合</th>
                                  <th data-tablesaw-priority="0">收付款</th>
                                  <th data-tablesaw-priority="0">過戶日期</th>
                                  <th data-tablesaw-priority="0">通知查帳</th>
                                  <th data-tablesaw-priority="0">上傳契約-要記得選擇檔案</th>
                                  <th data-tablesaw-priority="0">上傳稅單-要記得選擇檔案</th>
                                  <th data-tablesaw-priority="1">是否結案</th>
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
                                    ?></p>
                                   </td>
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
                                      <?php echo ($orders[$i]['轉讓會員']) ?>
                                      <input type="hidden" id="轉讓會員<?php echo $orders[$i]['ID']; ?>" name="" value="<?php echo $orders[$i]['轉讓會員']; ?>">
                                    </td>
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
                                    </td>

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



        <div class="s-modal" data-popup="popup-1">
            <div class="modal-content">
              <div class="modal-header">
                <h3>編輯成交單</h3>
              </div>
              <form method="post" name="edit_order_info" action="edit_order_status" >
                <!-- 為修改成交單狀態,與edit_order不同 -->
                <div class="">
                  <table>
                    <tr>
                      <td><label>成交單編號</label></td>
                      <td><input readonly type="text" name="ID" value="" id="edit_id"></td>
                      <td><label>客戶姓名</label></td>
                      <td><input type="text" name="客戶姓名" value="" id="edit_name"></td>
                      <!-- <td>
                        <button id="autofill" type="button">自動填入</button>
                      </td> -->
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
                      <td><input class="" type="date" name="過戶日期" value="" id="edit_過戶日期" required=""><label class="text-danger"><b>(自動)</b></label></td>
                    </tr>
                    <tr>
                      <td><label>股票名稱</label></td>
                      <td><input type="text" name="股票" value="" id="edit_company"></td>
                      <td width="200px">
                        <input type="radio" name="買賣" value="1" checked><label class="text-danger"><b>買</b></label>
                        <input type="radio" name="買賣" value="0"><label class="text-primary"><b>賣</b></label>
                      </td>
                      <td><label>張數</label></td>
                      <td><input type="text" name="張數" value="" id="edit_amount"></td>
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
                      <td></td>
                      <td><label>成交價</label></td>
                      <td><input type="text" name="成交價" value="" id="edit_成交價"></td>
                      <td><label>盤價</label></td>
                      <td><input type="text" name="盤價" value="" id="edit_盤價"></td>
                    </tr>
                    <tr>
                      <td><label>自行應付</label></td>
                      <td>
                        <input type="text" name="自行應付" value="" id="edit_自行應付">
                      </td>
                      <td colspan="3">
                        <label class="text-danger"><b>(預設為賣　匯款金額 - 盤價x張數x0.997)</b></label>
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
                        <input type="text" name="匯款金額" class="autochange" value="" id="edit_匯款金額">
                        <button type="button" onclick="calculate_sell()">賣</button>
                        <button type="button" onclick="calculate_buy()">買</button>
                      </td>
                      <!-- <td></td> -->
                    </tr>
                    <tr>
                      <td><label>完稅人</label></td>
                      <td><input type="text" name="完稅人" value="" id="edit_完稅人" required=""></td>
                      <td><label>過戶費</label></td>
                      <td>
                        <select id="edit_過戶費" name="過戶費" class="form-control">
                          <option value="0">0</option>
                          <option value="500">500</option>
                          <option value="1000">1000</option>
                          <option value="1500">1500</option>
                          <option value="2000">2000</option>
                        </select>
                      </td>
                      <td><label>刻印</label></td>
                      <td>
                        <select id="edit_刻印" name="刻印" class="form-control">
                            <?php
                              for($j=0; $j<=10; $j++) {
                                echo "<option value=".$j.">".$j."</option>";
                              }
                            ?>
                        </select>
                      </td>
                      <td><label>收送</label></td>
                      <td>
                        <input type="text" name="刻印收送" value="" id="edit_刻印收送">
                      </td>
                    </tr>
                    <tr>
                      <td><label>成交單狀態</label></td>
                      <td>
                        <input type="radio" name="成交單狀態" value="審核完成" checked><label class="text-primary">審核完成</label>
                        <input type="radio" name="成交單狀態" value="審核中"><label class="text-success">審核中</label>
                        <input type="radio" name="成交單狀態" value="審核不通過"><label class="text-danger">審核不通過</label>
                      </td>
                    </tr>
                    <tr>
                      <td><label>現金或匯款</label></td>
                      <td>
                        <input type="radio" name="現金或匯款" value="未付款" checked><label class="">未付款</label>
                        <input type="radio" name="現金或匯款" value="現金"><label class="">現金</label>
                        <input type="radio" name="現金或匯款" value="匯款"><label class="">匯款</label>
                      </td>
                    </tr>
                    <tr>
                      <td><label>匯款日期</label></td>
                      <td>
                        <input class="paydate" type="date" min='1899-01-01' max="2100-12-31" name="匯款日期" value="" id="edit_匯款日期">
                        <button type="button" onclick="getdealdate()">同成交日期</button>
                      </td>
                      <!-- <td></td> -->
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
                <span class="s-close" data-popup-close="popup-1">&times;</span>
            </div>
        </div>

<!-- modal function -> assets/js/action.js -->


        <script>


          //編輯資料
          function Edit(i){
            var id = i;

            document.getElementById('edit_id').value = id;
            document.getElementById("edit_匯款金額").value = 0;
            ['name', 'F', 'phone','address','company','amount','成交價','盤價','匯款銀行','匯款金額','過戶費','匯款日期','刻印',
                '匯款分行','匯款戶名','轉讓會員','匯款帳號','完稅人','成交日期','過戶日期','自行應付','刻印收送'
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

          //計算匯款金額與自行應付
          function calculate_sell() {
            document.getElementById("edit_匯款金額").value = document.getElementById('edit_amount').value*document.getElementById('edit_成交價').value*1000*0.997;
            document.getElementById('edit_自行應付').value = document.getElementById("edit_匯款金額").value - (document.getElementById('edit_amount').value*document.getElementById('edit_成交價').value*1000*0.997);
          }
          function calculate_buy() {
            document.getElementById("edit_匯款金額").value = document.getElementById('edit_amount').value*document.getElementById('edit_成交價').value*1000;
            document.getElementById('edit_自行應付').value = document.getElementById("edit_匯款金額").value - (document.getElementById('edit_amount').value*document.getElementById('edit_成交價').value*1000);
          }

          //自行應付變動=匯款金額-股票金額
          $(document).ready(function(){
            $(".autochange").change(function(){
              document.getElementById('edit_自行應付').value = document.getElementById("edit_匯款金額").value - (document.getElementById('edit_amount').value*document.getElementById('edit_成交價').value*1000*0.997);
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

          //自動填入客戶資訊
          $("#autofill").click(function() {
            var name = document.getElementById('edit_name').value;
            url = "<?=base_url()?>index.php/orders/autofill";
            // go = "<?=base_url()?>orders/index";
            $.ajax({
              url: url,
              type: 'post',
              data: {name:name},
              // dataType:'json',
              success: function(data){
                console.log(data);
                  // window.location.replace(go);
              },
              error:function(xhr, ajaxOptions, thrownError){
              }
            });
          })


          feather.replace()

        </script>
    </body>
</html>
