
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
		<div>
			<form action="go_add_account" method="POST" name="" style= "display:inline">
				<input type="submit" name="" value="新增">
			</form>
			<br><br>
			<table style="width:100%" border="1">
				<tr>
					<th nowrap="nowrap">編號</th>
					<th nowrap="nowrap">名稱</th>
					<th nowrap="nowrap">帳號</th>
					<th nowrap="nowrap">密碼</th>
					<th nowrap="nowrap">等級</th>
					<th nowrap="nowrap"></th>
					<th nowrap="nowrap"></th>
				</tr>
				<?php 
				if (isset($data)) {
					for ($i=0; $i<count($data); $i++) {
						echo "<tr>";
						echo "<td>".$data[$i]['ID']."</td>";
						echo "<td>".$data[$i]['NAME']."</td>";
						echo "<td>".$data[$i]['ACCOUNT']."</td>";
						echo '<td nowrap="nowrap">'.$data[$i]['PASSWORD']."</td>";
						echo "<td>".$data[$i]['權限名稱']."</td>";
						echo '<td>
							<form action="delete_account" method="POST" name="" style= "display:inline">
							<input type="hidden" name="account_id" value="'.$data[$i]['ID'].'">
							<input type="submit" name="" value="刪除">
							</form>
							</td>';
						echo '<td>
							<form action="go_edit_account" method="POST" name="" style= "display:inline">
							<input type="hidden" name="account_id" value="'.$data[$i]['ID'].'">
							<input type="submit" name="" value="編輯">
							</form>
							</td>';
						echo "</tr>";
					}
				}
				?>
			</table>
		</div>
	</main>


</body>
</html>