
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
		<div>
			<br><br>
			<table style="width:100%" border="1">
				<tr>
					<th nowrap="nowrap">編號</th>
					<th nowrap="nowrap">匯款人</th>
					<th nowrap="nowrap">匯款帳號末5碼</th>
					<th nowrap="nowrap">入帳金額</th>
					<th nowrap="nowrap"></th>
					<th nowrap="nowrap"></th>
				</tr>
				<?php 
				if ($data) {
					for ($i=0; $i<count($data); $i++) {
						echo "<tr>";
						echo "<td>".$data[$i]['ID']."</td>";
						echo "<td>".$data[$i]['匯款人']."</td>";
						echo "<td>".$data[$i]['匯款帳號末5碼']."</td>";
						echo '<td nowrap="nowrap">'.$data[$i]['已匯金額已收金額']."</td>";
						echo '<td>
							<form action="" method="POST" name="" style= "display:inline">
							<input type="hidden" name="account_id" value="'.$data[$i]['ID'].'">
							<input type="submit" name="" value="確認">
							</form>
							</td>';
						echo '<td>
							<form action="" method="POST" name="" style= "display:inline">
							<input type="hidden" name="account_id" value="'.$data[$i]['ID'].'">
							<input type="submit" name="" value="駁回">
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