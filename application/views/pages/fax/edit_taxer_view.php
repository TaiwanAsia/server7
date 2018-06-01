<body>


<div id="container">
	
	<div id="body">

		<form action="edit_taxer" method="GET" name="" style= "display:inline">

			<div>
				<table style="width:100%" border="1">
					<tr>
						<th nowrap="nowrap">盤商名</th>
						<th nowrap="nowrap">完稅姓名</th>
						<th nowrap="nowrap">完稅ID</th>
						<th nowrap="nowrap">完稅地址</th>
						<th nowrap="nowrap">匯款姓名</th>
						<th nowrap="nowrap">匯款銀行</th>
						<th nowrap="nowrap">匯款帳號</th>
					</tr>
					<tr>
						<td>
							<input type="hidden" name="id" value="<?php echo($data[0]['id']); ?>">
							<input type="text" name="盤商名" value="<?php echo($data[0]['盤商名']); ?>">
						</td>
						<td>
							<input type="text" name="完稅姓名" value="<?php echo($data[0]['完稅姓名']); ?>">
						</td>
						<td>
							<input type="text" name="完稅ID" value="<?php echo($data[0]['完稅ID']); ?>">
						</td>
						<td>
							<input type="text" name="完稅地址" value="<?php echo($data[0]['完稅地址']); ?>">
						</td>
						<td>
							<input type="text" name="匯款姓名" value="<?php echo($data[0]['匯款姓名']); ?>">
						</td>
						<td>
							<input type="text" name="匯款銀行" value="<?php echo($data[0]['匯款銀行']); ?>">
						</td>
						<td>
							<input type="text" name="匯款帳號" value="<?php echo($data[0]['匯款帳號']); ?>">
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