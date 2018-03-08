<body>


<div id="container">
	<div id="body">
		<form action="add_account" method="POST" name="" style= "display:inline">

			<div>
				<table style="width:100%" border="1">
					<tr>
						<th nowrap="nowrap">名稱</th>
						<th nowrap="nowrap">帳號</th>
						<th nowrap="nowrap">密碼</th>
						<th nowrap="nowrap">等級</th>
					</tr>
					<tr>
						<td>
							<input type="text" name="name" value="">
						</td>
						<td>
							<input type="text" name="account" value="">
						</td>
						<td>
							<input type="text" name="password" value="">
						</td>
						<td>
							<select name="level">
								<option value="1">1</option>
								<option value="2">2</option>
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