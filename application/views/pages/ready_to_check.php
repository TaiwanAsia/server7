
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
		<div>
			<br><br>
			<table class="table-ch-money" style="width:100%" border="1">
				<tr>
					<th nowrap="nowrap">編號</th>
					<th nowrap="nowrap">匯款人</th>
					<th nowrap="nowrap">匯款帳號末5碼</th>
					<th nowrap="nowrap">入帳金額</th>
					<th nowrap="nowrap"></th>
				</tr>
				<?php
				if ($data) {
					for ($i=0; $i<count($data); $i++) {
						echo "<tr>";
						echo "<td>".$data[$i]['ID']."</td>";
						echo "<td>".$data[$i]['匯款人']."</td>";
						echo "<td>".$data[$i]['匯款帳號末5碼']."</td>";
						echo '<td nowrap="nowrap">'.$data[$i]['已匯金額已收金額']."</td>";
						echo '<td>
							<form action="" method="POST" name="" style= "display:inline">
							<input type="hidden" name="account_id" value="'.$data[$i]['ID'].'">
							<input type="submit" name="" data-popup-open="popup-2" value="動作">
							</form>
							</td>';
						echo "</tr>";
					}
				}
				?>
			</table>
		</div>
	</main>
	<div class="s-modal" data-popup="popup-2">
            <div class="modal-content-2">
            	<form>
            	<span class="s-close" data-popup-close="popup-2">&times;</span>
              <div class="modal-header">
                <h3>待查帳</h3>
              </div>
              <div class="modal-main">
              	<div class="modal-sec-1">
								<table>
									<tbody>
									<tr>
										<td><h6>確認日期</h6></td>
										<td>
											<select>
											<option>2018/1/1</option>
											<option>2018/1/1</option>
											<option>2018/1/1</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>資料</td>
										<td>資料</td>
									</tr>
									<tr>
										<td>資料</td>
										<td>資料</td>
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
</html>