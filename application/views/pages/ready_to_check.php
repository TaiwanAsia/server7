

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
		<div>
			<br><br>
			<table  id="eoTable" class="table table-md table-hover table-responsive" >
				<tr>
					<th nowrap="nowrap">編號</th>
					<th nowrap="nowrap">匯款人</th>
					<th nowrap="nowrap">匯款帳號末5碼</th>
					<th nowrap="nowrap">入帳金額</th>
          <th nowrap="nowrap">查帳狀態</th>
					<th nowrap="nowrap"></th>
				</tr>
				<?php
				if ($data) {
					for ($i=0; $i<count($data); $i++) {
						echo "<tr>";
  						echo "<td id='o_id'>".$data[$i]['ID']."</td>";
  						echo "<td>".$data[$i]['匯款人']."</td>";
  						echo "<td>".$data[$i]['匯款帳號末5碼']."</td>";
  						echo '<td nowrap="nowrap">'.$data[$i]['已匯金額已收金額']."</td>";
              echo "<td>";
              if ($data[$i]['通知查帳']=='待對帳') { ?>
                <img src="<?php echo base_url(); ?>static/待對帳.png" width="80" height="40">
              <?php } elseif ($data[$i]['通知查帳']=='待確認') { ?>
                <img src="<?php echo base_url(); ?>static/待確認.png" width="80" height="40">
              <?php }
              echo "</td>"; ?>
  						<td>
                <button data-popup-open="popup-2" onclick="Check(<?php echo $data[$i]['ID']; ?>)">動作</button>
  						</td>
						</tr>
          <?php
					}
				}
				?>
			</table>
		</div>
	</main>
	<div class="s-modal" data-popup="popup-2">
            <div class="modal-content-2">
            	<form action="check_end" method="post">
            	<span class="s-close" data-popup-close="popup-2">&times;</span>
              <div class="modal-header">
                <h3>待查帳</h3>
              </div>
              <div class="modal-main">
              	<div class="modal-sec-1">
								<table>
									<tbody>
                    <tr>
                      <td>編號</td>
                      <td><input readonly type="text" name="ID" value="" id="t_id"></td>
                    </tr>
  									<tr>
  										<td><h6>確認日期</h6></td>
  										<td>
  											<input type="date" id="date" name="確認日期">
  										</td>
                      <td><button type="button" onclick="gettoday()">今天</button></td>
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
      
      function Check(i) {
        var id = i;
        document.getElementById('t_id').value = id;
      }

      function gettoday() {
        document.getElementById("date").valueAsDate = new Date()
      }

    </script>

</html>
