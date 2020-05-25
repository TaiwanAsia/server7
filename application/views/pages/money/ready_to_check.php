

<!-- 	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="t-form-h">
      <div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">應收帳款</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                  <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/checkbill'" value="所有應收"></input>
                  <?php if ($_SESSION['權限名稱']=='最高權限') { ?>
                  <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/boss_check_money'" value="尚未對帳"></input>
                  <?php } ?>
                  <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/check_record'" value="紀錄"></input>
                  <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/pay_error'" value="轉出異常"></input>
              </div>
          </div>
      </div>
    </div> -->
		<div class="t-form" style="font-family:微軟正黑體;">
			<div class="t-form-h">
      <?php if ($_SESSION['權限名稱']=='最高權限') { ?>
        <font color="red" size="5">對帳請按</font>
        <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/reconcile'" value="對帳">
      <?php } ?>
    </div>
			<table  id="eoTable" class="table table-md table-hover table-responsive" >
				<tr>
          <th nowrap="nowrap">成交單編號</th>
          <th nowrap="nowrap">股票</th>
          <th nowrap="nowrap">支付方式</th>
          <th nowrap="nowrap">支付人</th>
          <th nowrap="nowrap">匯款帳號末5碼</th>
          <th nowrap="nowrap">轉入日期</th>
          <th nowrap="nowrap">已收金額</th>
          <th nowrap="nowrap">查帳狀態</th>
					<th nowrap="nowrap"></th>
				</tr>

				<?php
				if ($data) {
					for ($i=0; $i<count($data); $i++) { ?>
            <input type="hidden" id="o_id<?php echo $data[$i]['id']; ?>" value="<?php echo $data[$i]['id']; ?>">
				<?php
            echo "<tr>";
  						echo "<td>".$data[$i]['成交單編號']."</td>";
              echo "<td>".$data[$i]['股票']."</td>";
              echo "<td>".$data[$i]['支付方式']."</td>";
  						echo "<td>".$data[$i]['支付人']."</td>";
  						echo "<td>".$data[$i]['匯款帳號末5碼']."</td>";
              echo "<td>".$data[$i]['轉出日期轉入日期']."</td>"; ?>
  						<td nowrap="nowrap">
                <label><?php echo $data[$i]['待查帳金額'];?></label>
                <input type="hidden" name="" id="o_money<?php echo $data[$i]['id']; ?>" value="<?php echo $data[$i]['待查帳金額']; ?>">
              </td>
              <?php
              echo "<td>";
              if ($data[$i]['查帳狀態']=='待對帳') { ?>
                <img src="<?php echo base_url(); ?>static/待對帳.png" width="80" height="40">
              <?php } elseif ($data[$i]['查帳狀態']=='待確認') { ?>
                <img src="<?php echo base_url(); ?>static/待確認.png" width="80" height="40">
              <?php }
              echo "</td>"; ?>
  						<td>
                <button data-popup-open="popup-2" onclick="Check(<?php echo $data[$i]['成交單編號'].','.$data[$i]['id']; ?>)">動作</button>
  						</td>
						</tr>
          <?php
					}
				}
				?>
			</table>
		</div>
	</main>
	<div class="s-modal" data-popup="popup-2" style="font-family:微軟正黑體;">
        <div class="modal-content-2">
          <span class="s-close" data-popup-close="popup-2">&times;</span>
        	<form action="check_end" method="post">
          <div class="modal-header">
            <h3>待查帳</h3>
          </div>
          <div class="modal-main">
          	<div class="modal-sec-1">
						<table>
							<tbody>
                <tr>
                  <td>成交單編號</td>
                  <td><input readonly type="text" name="成交單編號" value="" id="t_order_id"></td>
                  <td><input type="hidden" name="id" id="id" value=""></td>
                </tr>
								<tr>
									<td><h6>確認日期</h6></td>
									<td>
										<input type="date" id="date" name="確認日期">
									</td>
                  <td><button type="button" onclick="gettoday()">今天</button></td>
								</tr>
                <tr>
                  <td><h6>金額</h6></td>
                  <td>
                    <input type="text" id="t_money" name="money">
                  </td>
                </tr>
						</tbody>
						</table>
          </div>
				</div>
				<div class="modal-footer">
					<input type="submit" value="submit">
				</div>
				</form>
        </div>
    </div>
</body>

    <script>

      function Check(order_id, id) {
        var order_id = order_id;
        document.getElementById('t_order_id').value = order_id;
        document.getElementById('id').value = document.getElementById('o_id'+id).value;
        document.getElementById('t_money').value = document.getElementById('o_money'+id).value;
      }

      function gettoday() {
        document.getElementById("date").valueAsDate = new Date()
      }

    </script>

</html>
