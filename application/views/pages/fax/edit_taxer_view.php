	<main id="mainSection" role="main" class="col-md-9 col-lg-10 pt-3 px-4">
	 	<div id="body">
	  		<div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
				<h1 class="h2">編輯完稅資料</h1>
				<input type ="button" onclick="javascript:location.href='go_taxer'" value="回到上一頁" class="btn btn-sm btn-outline-secondary">
			</div>
			<form action="edit_taxer" method="GET" name="" style= "display:inline">
				<div>
					<table class="table table-md table-hover table-responsive fax-table">
						<thead class="thead-light">
							<tr>
								<th nowrap="nowrap">盤商名</th>
								<th nowrap="nowrap">完稅姓名</th>
								<th nowrap="nowrap">完稅ID</th>
								<th nowrap="nowrap">完稅地址</th>
								<th nowrap="nowrap">匯款姓名</th>
								<th nowrap="nowrap">匯款銀行</th>
								<th nowrap="nowrap" colspan="2">匯款帳號</th>
							</tr>
						</thead>
						<tbody>
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
							</tr>
						</tbody>
					</table>
					<input type="submit" name="" value="確認">
				</div>
			</form>

		</div>
	</main>