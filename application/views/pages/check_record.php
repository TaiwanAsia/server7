

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

    <div class="t-form-h">
      <div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">應收帳款</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                  <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/checkbill'" value="所有應收"></input>
                  <?php if ($_SESSION['權限名稱']=='最高權限') { ?>
                  <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/boss_check_money'" value="上傳/確認"></input>
                  <?php } ?>
                  <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/check_record'" value="分匯紀錄"></input>
                  <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/reconcile'" value="對帳"></input>
              </div>
          </div>
      </div>
    </div>

		<div>
			<br><br>
			<table  id="eoTable" class="table table-md table-hover table-responsive" >
				<tr>
					<!-- <th nowrap="nowrap">編號</th> -->
					<th nowrap="nowrap">成交單編號</th>
          <th nowrap="nowrap">支付方式</th>
          <th nowrap="nowrap">支付人</th>
          <th nowrap="nowrap">匯款帳號末5碼</th>
          <th nowrap="nowrap">轉入日期</th>
          <th nowrap="nowrap">已收金額</th>
          <th nowrap="nowrap">通知日期</th>
          <th nowrap="nowrap">查帳日期</th>
					<th nowrap="nowrap">動作時間</th>
				</tr>
				<?php
				if ($data) {
					for ($i=0; $i<count($data); $i++) {
						echo "<tr>";
  						echo "<td>".$data[$i]['成交單編號']."</td>";
              echo "<td>".$data[$i]['支付方式']."</td>";
              echo "<td>".$data[$i]['支付人']."</td>";
              echo "<td>".$data[$i]['匯款帳號末5碼']."</td>";
              echo "<td>".$data[$i]['轉出日期轉入日期']."</td>";
              echo "<td>".$data[$i]['已匯金額已收金額']."</td>";
              echo "<td>".$data[$i]['通知日期']."</td>";
  						echo "<td>".$data[$i]['查帳日期']."</td>";
  						echo "<td>".$data[$i]['最後動作時間']."</td>";
          ?>
						</tr>
          <?php
					}
				}
				?>
			</table>
		</div>
	</main>

    </body>

    <script>
      


    </script>

</html>
