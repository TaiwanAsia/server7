<body>


<div id="container">
	
	<div id="body">

		<form action="edit_account" method="POST" name="" style= "display:inline">

			<div>
				<table style="width:100%" border="1">
					<tr>
						<th nowrap="nowrap">編號</th>
						<th nowrap="nowrap">名稱</th>
						<th nowrap="nowrap">帳號</th>
						<th nowrap="nowrap">密碼</th>
						<th nowrap="nowrap">權限</th>
						<th nowrap="nowrap">趴數</th>
					</tr>
					<tr>
						<td>
							<label><?php echo($data[0]['ID']); ?></label>
							<input type="hidden" name="id" value="<?php echo($data[0]['ID']); ?>">
						</td>
						<td>
							<input type="text" name="name" value="<?php echo($data[0]['NAME']); ?>">
						</td>
						<td>
							<input type="text" name="account" value="<?php echo($data[0]['ACCOUNT']); ?>">
						</td>
						<td>
							<input type="text" name="password" value="<?php echo($data[0]['PASSWORD']); ?>">
						</td>
						<td>
							<select name="權限名稱">
								<option value="<?php echo($data[0]['權限名稱']); ?>" checked>
									<?php echo($data[0]['權限名稱']); ?>
								</option>
								<option value="最高權限">最高權限</option>
								<option value="次高權限">次高權限</option>
								<option value="會計">會計</option>
								<option value="行政">行政</option>
								<option value="業務">業務</option>
								<option value="工讀">工讀</option>
							</select>
						</td>
						<td>
							<input type="text" name="趴數" value="<?php echo($data[0]['趴數']); ?>">
						</td>
						<td>
							<input type="submit" name="" value="確認">
						</td>
					</tr>
				</table>
			</div>
		</form>

	</div>
</div>

</body>
</html>