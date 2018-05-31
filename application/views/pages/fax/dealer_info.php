
	<main role="main" class="col-md-9 col-lg-10 pt-3 px-4">
			<form action="go_add_dealer" method="POST" class="t-form-t" name="">
				<input type="submit" name="" value="新增">
			</form>
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
							<form action="delete_dealer" method="POST" name="" style= "display:inline">
							<input type="hidden" name="dealer_id" value="'.$data[$i]['id'].'">
							<input type="submit" name="" value="刪除">
							</form>
							</td>';
						echo '<td>
							<form action="go_edit_dealer" method="POST" name="" style= "display:inline">
							<input type="hidden" name="dealer_id" value="'.$data[$i]['id'].'">
							<input type="submit" name="" value="編輯">
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