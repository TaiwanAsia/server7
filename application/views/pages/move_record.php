
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
		<div>

			<br><br>
			<table style="width:100%" border="1">
				<tr>
					<th nowrap="nowrap">編號</th>
					<th nowrap="nowrap">員工</th>
					<th nowrap="nowrap">時間</th>
					<th nowrap="nowrap">動作</th>
					<th nowrap="nowrap">影響</th>
					<th nowrap="nowrap"></th>
					<th nowrap="nowrap"></th>
				</tr>
				<?php 
				if (isset($data)) {
					for ($i=0; $i<count($data); $i++) {
						echo "<tr>";
						echo '<td style="min-width: 50px;">'.$data[$i]['ID']."</td>";
						echo '<td style="min-width: 100px;">'.$data[$i]['員工']."</td>";
						echo '<td style="min-width: 200px;">'.$data[$i]['時間']."</td>";
						echo '<td style="min-width: 100px;">'.$data[$i]['動作']."</td>";
						echo '<td style="min-width: 100px;">'.$data[$i]['影響']."</td>";
						echo "</tr>";
					}
				}
				?>
			</table>
		</div>
	</main>


</body>
</html>