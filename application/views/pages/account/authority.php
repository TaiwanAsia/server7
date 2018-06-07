
	<main role="main" class="col-md-9 col-lg-10 pt-3 px-4">
		<div>
			<form action="go_add_account" method="POST" class="t-form-t" name="">
				<input type="submit" name="" value="新增">
			</form>
			<ul>
				<li style="display:inline;">
					<a href="account"><font size="4">帳號編輯</font></a>
				</li>
				<li style="display:inline;">
					<a href="authority"><font size="4">權限編輯</font></a>
				</li>
			</ul>
		</div>
		
		<div class="t-form">
			
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th nowrap="nowrap">名稱</th>
						<th nowrap="nowrap">帳號設定</th>
						<th nowrap="nowrap">編輯</th>
						<th nowrap="nowrap">刪除</th>
						<th nowrap="nowrap">成交日期</th>
						<th nowrap="nowrap">業務</th>
						<th nowrap="nowrap">客戶姓名</th>
					</tr>
				</thead>
				<tbody>
				<?php //print_r($data);
				if (isset($data)) { 
					for ($i=0; $i < count($data); $i++) { ?>
						<tr>
							<td>
								<input type="" name="" value="<?php echo $data[$i]['權限名稱']; ?>">
							</td>
							<td>
								<input type="" name="" value="<?php echo $data[$i]['帳號設定權限']; ?>">
							</td>
							<td>
								<input type="" name="" value="<?php echo $data[$i]['編輯權限']; ?>">
							</td>
							<td>
								<input type="" name="" value="<?php echo $data[$i]['刪除權限']; ?>">
							</td>
							<td>
								<input type="" name="" value="<?php echo $data[$i]['成交日期權限']; ?>">
							</td>
							<td>
								<input type="" name="" value="<?php echo $data[$i]['業務權限']; ?>">
							</td>
							<td>
								<input type="" name="" value="<?php echo $data[$i]['客戶姓名權限']; ?>">
							</td>
						</tr>
				<?php
					}
				}
				?>
				</tbody>
			</table>
		</div>
	</main>


</body>
</html>