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
						<th nowrap="nowrap">等級</th>
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
							<select name="level">
								<?php
								if ($data[0]['LEVEL'] == 1) {
									echo '
									<option value="1" selected >1</option>
									<option value="2">2</option>';
								} else {
									echo '
									<option value="1">1</option>
									<option value="2" selected >2</option>';
								}
								?>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<div>		
				<div class="button" style="line-height:100px;">
					<input type="submit" name="" value="確認">
				</div>
			</div>
		</form>

	</div>
</div>

</body>
</html>