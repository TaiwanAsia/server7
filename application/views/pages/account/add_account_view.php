<main id="mainSection" role="main">
	<div id="body">
		<form action="add_account" method="POST" name="" style= "display:inline">

			<div>
				<table style="width:100%" border="1">
					<tr>
						<th nowrap="nowrap">名稱</th>
						<th nowrap="nowrap">帳號</th>
						<th nowrap="nowrap">密碼</th>
						<th nowrap="nowrap">權限</th>
						<th nowrap="nowrap">趴數</th>
						<th nowrap="nowrap">勞保</th>
						<th nowrap="nowrap">健保</th>
						<th nowrap="nowrap">勞退</th>
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
							<select name="權限名稱">
								<option value=""></option>';
								<option value="最高權限">最高權限</option>';
								<option value="次高權限">次高權限</option>';
								<option value="會計">會計</option>';
								<option value="行政">行政</option>';
								<option value="業務">業務</option>';
								<option value="工讀">工讀</option>';
							</select>
						</td>
						<td>
							<input type="text" name="趴數" value="">
						</td>
						<td>
							<input type="text" name="勞保" value="">
						</td>
						<td>
							<input type="text" name="健保" value="">
						</td>
						<td>
							<input type="text" name="勞退" value="">
						</td>
						<td>
							<input type="submit" name="" value="確認">
						</td>
					</tr>
				</table>
			</div>
		</form>

	</div>
</main>