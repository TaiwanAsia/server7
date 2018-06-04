
<main role="main" class="col-md-9 col-lg-10 pt-3 px-4">
  <div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
     <h1 class="h2">盤商資料</h1>
			<form action="go_add_dealer" method="POST" class="t-form-t" name="">
				<input type="submit" name="" value="新增" class="btn btn-sm btn-outline-secondary">
			</form>

			<input type ="button" onclick="history.back()" value="回到上一頁" class="btn btn-sm btn-outline-secondary">
	</div>

		<div class="t-form">
			<table class="table">
				<thead class="thead-light">
				<tr>
					<th nowrap="nowrap">盤商名</th>
					<th nowrap="nowrap">盤商傳真</th>
					<th nowrap="nowrap">盤商電話</th>
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
						echo "<td>".$data[$i]['盤商傳真']."</td>";
						echo "<td>".$data[$i]['盤商電話']."</td>";

						echo '<td>
							<form action="go_edit_dealer" method="GET" name="" style= "display:inline">
							<input type="hidden" name="dealer_id" value="'.$data[$i]['id'].'">
							<input type="submit" name="" value="編輯">
							</form>
							</td>';

						echo '<td>
							<form action="delete_dealer" method="GET" name="" style= "display:inline">
							<input type="hidden" name="dealer_id" value="'.$data[$i]['id'].'">
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