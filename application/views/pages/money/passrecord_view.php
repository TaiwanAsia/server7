
	<main role="main" class="col-md-9 col-lg-10 pt-3 px-4">

		<div class="t-form">
			
			<table class="table">
				<thead class="thead-light">
					<?php if ($_SESSION['NAME'] == '小祿' || $_SESSION['NAME'] == 'Anthony') { ?>
					<tr>
						<td>
							<form action="turn_passrecord" method="post" id="turn_passrecord">
								<button type="submit" form="turn_passrecord">補齊轉讓紀錄</button>
							</form>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<th nowrap="nowrap">成交單編號</th>
						<th nowrap="nowrap">日期</th>
						<th nowrap="nowrap">姓名</th>
						<th nowrap="nowrap">買賣</th>
						<th nowrap="nowrap">業務</th>
						<th nowrap="nowrap">標的名稱</th>
						<th nowrap="nowrap">張數</th>
						<th nowrap="nowrap">成交價</th>
						<th nowrap="nowrap">盤價</th>
						<th nowrap="nowrap">價差</th>
						<th nowrap="nowrap">稅金</th>
						<th nowrap="nowrap">過戶費</th>
						<th nowrap="nowrap">金額</th>
						<th nowrap="nowrap">自得比率</th>
						<th nowrap="nowrap">自行應付</th>
						<th nowrap="nowrap">扣款利息</th>
						<th nowrap="nowrap">個人實得</th>
						<th nowrap="nowrap">營業支出</th>
						<th nowrap="nowrap">公司</th>
						<th nowrap="nowrap">匯款日期</th>
						<th nowrap="nowrap">轉讓會員</th>
						<th nowrap="nowrap">備註</th>
						<th nowrap="nowrap">狀態</th>
						<th nowrap="nowrap">修改</th>
						<th nowrap="nowrap">刪除</th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($data)>=1) { 
					for ($i=0; $i < count($data); $i++) { ?>
					<tr>
						<td>
							<?php echo $data[$i]['ID']; ?>
						</td>
						<td>
							<?php echo $data[$i]['日期']; ?>
						</td>
						<td>
							<?php echo $data[$i]['姓名']; ?>
						</td>
						<td>
							<?php if ($data[$i]['買賣'] == 1) {
								echo "買";
							} elseif($data[$i]['買賣'] == 0) {
								echo "賣"; 
							} ?>
						</td>
						<td>
							<?php echo $data[$i]['業務']; ?>
						</td>
						<td>
							<?php echo $data[$i]['標的名稱']; ?>
						</td>
						<td>
							<?php echo $data[$i]['張數']; ?>
						</td>
						<td>
							<?php echo $data[$i]['成交價']; ?>
						</td>
						<td>
							<?php echo $data[$i]['盤價']; ?>
						</td>
						<td>
							<?php echo $data[$i]['價差']; ?>
						</td>
						<td>
							<?php echo $data[$i]['稅金']; ?>
						</td>
						<td>
							<?php echo $data[$i]['過戶費']; ?>
						</td>
						<td>
							<?php echo $data[$i]['金額']; ?>
						</td>
						<td>
							<?php echo $data[$i]['自得比率']; ?>
						</td>
						<td>
							<?php echo $data[$i]['自行應付']; ?>
						</td>
						<td>
							<?php echo $data[$i]['扣款利息']; ?>
						</td>
						<td>
							<?php echo $data[$i]['個人實得']; ?>
						</td>
						<td>
							<?php echo $data[$i]['營業支出']; ?>
						</td>
						<td>
							<?php echo $data[$i]['公司']; ?>
						</td>
						<td>
							<?php echo $data[$i]['匯款日期']; ?>
						</td>
						<td>
							<?php echo $data[$i]['轉讓會員']; ?>
						</td>
						<td>
							<?php echo $data[$i]['備註']; ?>
						</td>
						<td>
							<?php echo $data[$i]['狀態']; ?>
						</td>
					</tr>

					<?php }
					}?>
				</tbody>
			</table>
		</div>
	</main>


</body>
</html>