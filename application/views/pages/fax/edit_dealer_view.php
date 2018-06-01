<body>


<div id="container">
	
	<div id="body">

		<form action="edit_dealer" method="GET" name="" style= "display:inline">

			<div>
				<table style="width:100%" border="1">
					<tr>
						<th nowrap="nowrap">盤商名</th>
						<th nowrap="nowrap">盤商傳真</th>
						<th nowrap="nowrap">盤商電話</th>
					</tr>
					<tr>
						<td>
							<input type="hidden" name="id" value="<?php echo($data[0]['id']); ?>">
							<input type="text" name="name" value="<?php echo($data[0]['盤商名']); ?>">
						</td>
						<td>
							<input type="text" name="fax" value="<?php echo($data[0]['盤商傳真']); ?>">
						</td>
						<td>
							<input type="text" name="tel" value="<?php echo($data[0]['盤商電話']); ?>">
						</td>
						<td>
							<input type="submit" name="" value="確認">
						</td>
					</tr>
				</table>
			</div>
		</form>

	</div>
</div>

</body>
</html>