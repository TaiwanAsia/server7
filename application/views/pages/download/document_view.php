
	<main role="main" class="col-md-9 col-lg-10 pt-3 px-4">
	<div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
     <h1 class="h2">文件下載</h1>
			<!-- <form action="go_add_taxer" method="POST" class="t-form-t" name="">
				<input type="submit" name="" value="新增" class="btn btn-sm btn-outline-secondary">
			</form>
 -->
			<input type ="button" onclick="history.back()" value="回到上一頁" class="btn btn-sm btn-outline-secondary">
		</div>

		<div class="t-form">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th nowrap="nowrap">文件編號</th>
						<th nowrap="nowrap">文件名稱</th>
						<th nowrap="nowrap">下載</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>身分證版本</td>
						<td>
							<form action="document_download" method="POST">
								<input type="hidden" name="type" value="身分證">
								<button type="submit">下載</button>
							</form>
						</td>
					</tr>
					<tr>
						<td>2</td>
						<td>轉讓過戶申請書</td>
						<td>
							<form action="document_download" method="POST">
								<input type="hidden" name="type" value="轉讓過戶申請書">
								<button type="submit">下載</button>
							</form>
						</td>
					</tr>
					<tr>
						<td>2</td>
						<td>股票成交單</td>
						<td>
							<form action="document_download" method="POST">
								<input type="hidden" name="type" value="股票成交單">
								<button type="submit">下載</button>
							</form>
						</td>
					</tr>
					<tr>
						<td>2</td>
						<td>委託掛單明細</td>
						<td>
							<form action="document_download" method="POST">
								<input type="hidden" name="type" value="委託掛單明細">
								<button type="submit">下載</button>
							</form>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</main>


</body>
</html>