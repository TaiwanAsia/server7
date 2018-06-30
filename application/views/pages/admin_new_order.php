<body>


<div id="container">
	<div id="body">
		<form action="add_order_ID" method="POST" name="" style= "display:inline;" >
			<div>
				<table style="width:100%;" border="0">
					<tr>
						<th nowrap="nowrap">編號</th>
						<td>
							<input readonly="" type="text" name="媒合編號" value="<?php echo($新媒合編號); ?>">
						</td>
					</tr>
					<tr>
						<th nowrap="nowrap">日期</th>
						<td>
							<input type="date" name="成交日期" value="<?php echo date('Y-m-d'); ?>">
						</td>
					</tr>
					<tr>
						<th nowrap="nowrap">股票</th>
						<td>
							<input type="text" name="股票名稱" value="">
						</td>
					</tr>
					<tr>
						<th nowrap="nowrap">業務</th>
						<td>
							<ul>
				 				<?php for ($i=0; $i < count($employees); $i++) { 
				 					if ($employees[$i]['NAME']!='盤商'&&$employees[$i]['NAME']!='庫存') { ?>
				 					<input type="checkbox" name="業務[]" value="<?php echo $employees[$i]['NAME'] ?>"><?php echo $employees[$i]['NAME'] ?>
				 				<?php	}
				 				} ?>
				 			</ul>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan="3">
							<input type="submit" name="送出">
						</td>
					</tr>
				</table>
			</div>
		</form>

	</div>
</div>

</body>
</html>