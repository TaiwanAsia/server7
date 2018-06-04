<body>

<div id="container">
	<div id="body">
		<div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
			<h1 class="h2">新增完稅資料</h1>
	 	</div>
		<form action="add_dealer" method="POST" name="" style= "display:inline">
			<div>
				<table class="table table-md table-hover table-responsive fax-table">
					<thead class="thead-light">
						<tr>
							<th nowrap="nowrap">盤商名</th>
							<th nowrap="nowrap">盤商傳真</th>
							<th nowrap="nowrap" colspan="2">盤商電話</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<input type="text" name="name" value="">
							</td>
							<td>
								<input type="text" name="fax" value="">
							</td>
							<td>
								<input type="text" name="tel" value="">
							</td>

							<td>
								<input type="submit" name="" value="確認">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</form>

	</div>
</div>

</body>
</html>