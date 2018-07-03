
	<main id="mainSection" role="main" class="col-md-9 col-lg-10 pt-3 px-4">
		<div class="t-form-t">
     		<h1 class="h2">完稅資料</h1>
			<form action="go_add_taxer" method="POST" class="t-form-t" name="">
				<input type="submit" name="" value="新增" class="btn btn-sm btn-outline-secondary">
			</form>

			<input type ="button" onclick="javascript:location.href='fax_info'" value="回到上一頁" class="btn btn-sm btn-outline-secondary">
		</div>

		<div class="t-form">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th nowrap="nowrap">盤商名</th>
						<th nowrap="nowrap">完稅姓名</th>
						<th nowrap="nowrap">完稅ID</th>
						<th nowrap="nowrap">完稅地址</th>
						<th nowrap="nowrap">匯款姓名</th>
						<th nowrap="nowrap">匯款銀行</th>
						<th nowrap="nowrap">匯款帳號</th>
						<th nowrap="nowrap"></th>
						<th nowrap="nowrap"></th>
					</tr>
				</thead>
				<tbody>
				<?php
				if (isset($data)) {
					for ($i=0; $i<count($data); $i++) {
						echo "<tr>";
						echo "<td>".$data[$i]['盤商名']."</td>";
						echo "<td>".$data[$i]['完稅姓名']."</td>";
						echo "<td>".$data[$i]['完稅ID']."</td>";
						echo "<td>".$data[$i]['完稅地址']."</td>";
						echo "<td>".$data[$i]['匯款姓名']."</td>";
						echo "<td>".$data[$i]['匯款銀行']."</td>";
						echo "<td>".$data[$i]['匯款帳號']."</td>";


						echo '<td>
							<form action="go_edit_taxer" method="GET" name="" style= "display:inline">
							<input type="hidden" name="taxer_id" value="'.$data[$i]['id'].'">
							<input type="submit" name="" value="編輯">
							</form>
							</td>';

						echo '<td>
							<form action="delete_taxer" method="GET" name="" style= "display:inline">
							<input type="hidden" name="taxer_id" value="'.$data[$i]['id'].'">
							<input type="submit" name="" value="刪除">
							</form>
							</td>';

						echo "</tr>";
					}
				}
				?>
				</tbody>
			</table>
		</div>
	</main>


</body>
</html>