	<main id="mainSection" role="main" class="col-md-9 col-lg-10 pt-3 px-4">
		<div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
     		<h1 class="h2">選擇欲新增成交單</h1>
		</div>
		<div class="t-form">
			
			<form action="new_order" method="post">
				<table class="table" id="tblEditor">
					<tr>
						<select name="id">
							<?php for ($i=0; $i < count($add_quene); $i++) { ?>
								<option value="<?=$add_quene[$i]['id']?>" ><?php if($add_quene[$i]['買賣']==1) {
									echo "[買單]"; } else { echo "[賣單]"; } echo $add_quene[$i]['股票名稱'].$add_quene[$i]['張數'].'張'; if($add_quene[$i]['主要']==2) {
									echo "進庫存"; } ?>
										
								</option>
							<?php } ?>
							
						</select>
					</tr>
				</table>
				<input type="submit" name="">
			</form>
		</div>
	</main>

</body>
</html>