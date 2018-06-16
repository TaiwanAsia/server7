

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

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
    </div>

		<div>
			<br><br>
			<table  id="eoTable" class="table table-md table-hover table-responsive" >
				<tr>
					<!-- <th nowrap="nowrap">編號</th> -->
					<th nowrap="nowrap">日期</th>
          <th nowrap="nowrap">轉出</th>
          <th nowrap="nowrap">轉入</th>
          <th nowrap="nowrap">帳號</th>
          <th nowrap="nowrap">備註</th>
				</tr>
				<?php
				if ($data) {
					for ($i=0; $i<count($data); $i++) {
						echo "<tr>";
  					echo "<td>".$data[$i]['日期']."</td>";
            echo "<td>".$data[$i]['轉出']."</td>";
            echo "<td>".$data[$i]['轉入']."</td>";
            echo "<td>".$data[$i]['帳號']."</td>";
            echo "<td>".$data[$i]['備註']."</td>";
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
