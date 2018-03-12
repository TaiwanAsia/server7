
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                        <h1 class="h2">成交單</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                              <!-- <button class="btn btn-sm btn-outline-secondary" id="new_order">新增成交單</button> -->
                              <button class="btn btn-sm btn-outline-secondary">所有</button>
                              <button class="btn btn-sm btn-outline-secondary">未審核</button>
                              <button class="btn btn-sm btn-outline-secondary">審核完</button>
                              <button class="btn btn-sm btn-outline-secondary">審核不過</button>
                              <button class="btn btn-sm btn-outline-secondary">庫存</button>
                              <button class="btn btn-sm btn-outline-secondary">公司自營</button>
                              <input class="btn btn-sm btn-outline-secondary" type="button" onclick="location.href='new_order';" value="新增成交單" />
                              <button class="btn btn-sm btn-outline-secondary">匯出</button>
                              <!-- <button class="btn btn-primary">匯出</button> -->
                            </div>
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                              <span data-feather="calendar"></span>
                              This week
                            </button>
                        </div>
                    </div>

                <!-- <canvas class="my-4" id="myChart" width="900" height="380"></canvas> -->

                    <h2>成交單清冊</h2>
                    <div class="">
                        <table class="table table-md table-hover table-responsive">
                            <thead class="thead-light">
                                <tr>
                                    <th>編號</th>
                                    <th scope="col">日期</th>
                                    <th>業務</th>
                                    <th>客戶姓名</th>
                                    <th>編輯</th>
                                    <th>身分證字號</th>
                                    <th>聯絡電話</th>
                                    <th>聯絡人</th>
                                    <th>聯絡住址</th>
                                    <th>買賣</th>
                                    <th>股票</th>
                                    <th>張數</th>
                                    <th>完稅價</th>
                                    <th>成交價</th>
                                    <th>盤價</th>
                                    <th>匯款金額</th>
                                    <th>匯款銀行</th>
                                    <th>匯款分行</th>
                                    <th>匯款帳號</th>
                                    <th>匯款戶名</th>
                                    <th>轉讓會員</th>
                                    <th>完稅人</th>
                                    <th>一審</th>
                                    <th>二審</th>
                                    <th>新舊</th>
                                    <th>自行應付</th>
                                    <th>刻印</th>
                                    <th>過戶費</th>
                                    <th>媒合</th>
                                    <th>收付款</th>
                                    <th>過戶日</th>
                                    <th>通知查帳</th>
                                    <th>上傳契約-要記得選擇檔案</th>
                                    <th>上傳稅單-要記得選擇檔案</th>
                                    <th>是否結案</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($orders){for($i=0; $i<count($orders); $i++) {?>
                                <tr>
                                    <td><?php echo ($orders[$i]['ID']) ?></td>
                                    <td><?php echo ($orders[$i]['日期']) ?></td>
                                    <td><?php echo ($orders[$i]['業務']) ?></td>
                                    <td><?php echo ($orders[$i]['客戶姓名']) ?></td>
                                    <td><!-- Trigger/Open The Modal --><button id="myBtn">編輯</button></td>
                                    <td><?php echo ($orders[$i]['身分證字號']) ?></td>
                                    <td><?php echo ($orders[$i]['聯絡電話']) ?></td>
                                    <td><?php echo ($orders[$i]['聯絡人']) ?></td>
                                    <td><?php echo ($orders[$i]['聯絡地址']) ?></td>
                                    <td><?php
                                    if($orders[$i]['買賣']==1){
                                      echo "買";
                                    } else {
                                      echo "賣";
                                    }
                                    ?></td>
                                    <td><?php echo ($orders[$i]['股票']) ?></td>
                                    <td><?php echo ($orders[$i]['張數']) ?></td>
                                    <td><?php echo ($orders[$i]['完稅價']) ?></td>
                                    <td><?php echo ($orders[$i]['成交價']) ?></td>
                                    <td><?php echo ($orders[$i]['盤價']) ?></td>
                                    <td><?php echo ($orders[$i]['匯款金額']) ?></td>
                                    <td><?php echo ($orders[$i]['匯款銀行']) ?></td>
                                    <td><?php echo ($orders[$i]['匯款分行']) ?></td>
                                    <td><?php echo ($orders[$i]['匯款帳號']) ?></td>
                                    <td><?php echo ($orders[$i]['匯款戶名']) ?></td>
                                    <td><?php echo ($orders[$i]['轉讓會員']) ?></td>
                                    <td><?php echo ($orders[$i]['完稅人']) ?></td>
                                    <?php
                                      if ($orders[$i]['一審']==0) {
                                        echo "<td></td>";
                                      } else {
                                        echo "<td><?php echo ($orders[$i]['一審']) ?></td>";
                                      }
                                    ?>
                                    <td><?php echo ($orders[$i]['二審']) ?></td>
                                    <td><?php
                                    if($orders[$i]['新舊']==1){
                                      echo "新";
                                    } else {
                                      echo "舊";
                                    }
                                    ?></td>
                                    <td><?php echo ($orders[$i]['自行應付']) ?></td>
                                    <td><?php echo ($orders[$i]['刻印']) ?></td>
                                    <td><?php echo ($orders[$i]['過戶費']) ?></td>
                                    <?php if ($_SESSION['LEVEL']>=2) { ?>
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
                                    
                                    <td><?php echo ($orders[$i]['收付款']) ?></td>
                                    <td><?php echo ($orders[$i]['過戶日']) ?></td>
                                    <td>
                                        <form method="post" action="checkbill">
                                            <button type="submit">通知查帳</button>
                                        </form>
                                    </td>
                                    <td style="min-width:100px;">
                                        <?php if (file_exists("upload/contact/" . $orders[$i]['ID'])){ 
                                          ?>
                                        <a href="<?=base_url('upload/contact/'.$orders[$i]['ID'])?>" target="_blank">檢視</a>
                                        <?php  } else {?>
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
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>


        

        <!-- The Modal 按下編輯後跳出的畫面 -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
              <div class="modal-header">
                <h2>編輯成交單</h2>
              </div>
              <div class="">
                <table>
                  <tr>
                    <td><label>個人姓名</label></td>
                    <td><input type="text" name="個人姓名" value=""></td>
                    <td><label>身分證字號</label></td>
                    <td><input type="text" name="身分證字號" value=""></td>
                    <td><label>聯絡地址</label></td>
                    <td><input type="text" name="聯絡地址" value=""></td>
                    <td><label>聯絡電話</label></td>
                    <td><input type="text" name="聯絡電話" value=""></td>
                  </tr>
                  <tr>
                    <td><label>成交日期</label></td>
                    <td><input type="text" name="成交日期" value=""></td>
                    <td><label>過戶日期</label></td>
                    <td><input type="text" name="過戶日期" value=""></td>
                    <td><label>股票名稱</label></td>
                    <td><input type="text" name="股票名稱" value=""></td>
                    <td><label>張數</label></td>
                    <td><input type="text" name="張數" value=""></td>
                  </tr>
                  <tr>
                    <td><label>轉讓會員</label></td>
                    <td>
                      <select id="inputState" name="轉讓會員" class="form-control">
                          <option selected value="0">尚無</option>
                          <option>1</option>
                          <?php
                          // for ($j=0; $j < count($orders); $j++) { 
                          //     echo "<option>".$orders[$j]['ID']."</option>";
                          // }
                          ?>
                      </select>
                    </td>
                    <td><label>完稅價</label></td>
                    <td><input type="text" name="完稅價" value=""></td>
                    <td><label>成交價</label></td>
                    <td><input type="text" name="成交價" value=""></td>
                    <td><label>盤價</label></td>
                    <td><input type="text" name="盤價" value=""></td>
                  </tr>
                  <tr>
                    <td><label>自付額</label></td>
                    <td><input type="text" name="自付額" value=""></td>
                  </tr>
                </table>
              </div>
              <div class="">
                <label><h3>賣方需填</h3></label>
                <br>
                <table>
                  <tr>
                    <td><label>成交日期</label></td>
                    <td><input type="text" name="成交日期" value=""></td>
                    <td><label>過戶日期</label></td>
                    <td><input type="text" name="過戶日期" value=""></td>
                    <td><label>股票名稱</label></td>
                    <td><input type="text" name="股票名稱" value=""></td>
                    <td><label>張數</label></td>
                    <td><input type="text" name="張數" value=""></td>
                  </tr>
                </table>
              </div>
                
                
                
                
                <span class="close">&times;</span>
            </div>

        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
        <script src="../../../../assets/js/vendor/popper.min.js"></script>
        <script src="../../../../dist/js/bootstrap.min.js"></script>

        <!-- Icons -->
        <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
        <script>
          feather.replace()
        </script>

        <!-- Graphs -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
        <script>

          // Get the modal
          var modal = document.getElementById('myModal');

          // Get the button that opens the modal
          var btn = document.getElementById("myBtn");

          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("close")[0];

          // When the user clicks the button, open the modal 
          btn.onclick = function() {
              modal.style.display = "block";
          }

          // When the user clicks on <span> (x), close the modal
          span.onclick = function() {
              modal.style.display = "none";
          }

          // When the user clicks anywhere outside of the modal, close it
          window.onclick = function(event) {
              if (event.target == modal) {
                  modal.style.display = "none";
              }
          }
      
        </script>
    </body>
</html>
