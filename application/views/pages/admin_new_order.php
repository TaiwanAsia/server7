<body>


<div id="container">
	<div id="body">
		<form action="add_order_id" method="POST" name="" style= "display:inline;" >
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
						<th><font color='green' size="5"><b>主要</b></font></th>
						<th colspan="" nowrap="nowrap"><font color='blue'><b>賣</b></font></th>
						<th nowrap="nowrap"><font color='red'><b>買</b></font></th>
					</tr>
					<tr>
						<td></td>
						<td colspan="">
			 				<?php for ($i=0; $i < count($employees); $i++) { 
			 					if ($employees[$i]['NAME']!='盤商'&&$employees[$i]['NAME']!='庫存'&&$employees[$i]['NAME']!='KO') { ?>
			 					<input class="" type="radio" name="客戶主賣" value="<?php echo $employees[$i]['NAME'] ?>"><?php echo $employees[$i]['NAME'] ?>
			 				<?php	}
			 				} ?>
						</td>
						<td colspan="">
			 				<?php for ($i=0; $i < count($employees); $i++) { 
			 					if ($employees[$i]['NAME']!='盤商'&&$employees[$i]['NAME']!='庫存'&&$employees[$i]['NAME']!='KO') { ?>
			 					<input class="" type="radio" name="客戶主買" value="<?php echo $employees[$i]['NAME'] ?>"><?php echo $employees[$i]['NAME'] ?>
			 				<?php	}
			 				} ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<th>張數</th>
						<th>張數</th>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="text" name="主賣張數">
						</td>
						<td>
							<input type="text" name="主買張數">
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<hr>
						</td>
					</tr>
					<tr>
						<th><font color='green' size="5"><b>副</b></font></th>
						<th colspan="" nowrap="nowrap"><font color='blue'><b>賣</b></font></th>
						<th nowrap="nowrap"><font color='red'><b>買</b></font></th>
					</tr>
					<tr>
						<td></td>
						<td>
			 				<?php for ($i=0; $i < count($employees); $i++) { 
			 					if ($employees[$i]['NAME']!='盤商'&&$employees[$i]['NAME']!='庫存'&&$employees[$i]['NAME']!='KO') { ?>
			 					<input class="" type="radio" name="客戶副賣" value="<?php echo $employees[$i]['NAME'] ?>"><?php echo $employees[$i]['NAME'] ?>
			 				<?php	}
			 				} ?>
						</td>
						<td>
			 				<?php for ($i=0; $i < count($employees); $i++) { 
			 					if ($employees[$i]['NAME']!='盤商'&&$employees[$i]['NAME']!='庫存'&&$employees[$i]['NAME']!='KO') { ?>
			 					<input class="" type="radio" name="客戶副買" value="<?php echo $employees[$i]['NAME'] ?>"><?php echo $employees[$i]['NAME'] ?>
			 				<?php	}
			 				} ?>
						</td>
					</tr>
					<tr>
						<td></td>
						<th>張數</th>
						<th>張數</th>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="text" name="副賣張數" placeholder="沒有則不用填">
						</td>
						<td>
							<input type="text" name="副買張數" placeholder="沒有則不用填">
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

<script type="text/javascript">
	var limit = 2;
	$('input.single-checkbox').on('change', function(evt) {
	   if($(this).siblings(':checked').length >= limit) {
	       this.checked = false;
	   }
	});
</script>

</body>
</html>