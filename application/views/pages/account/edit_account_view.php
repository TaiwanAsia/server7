<main id="mainSection" role="main">
		<div id="body">
		<form action="edit_account" method="POST" name="" style= "display:inline">

			<div style="position: absolute; top: 100px; padding-right: 30px ">
				<table style="">
					<tr bgcolor="#e4bc7c">
						<th nowrap="nowrap">編號</th>
						<th nowrap="nowrap">名稱</th>
						<th nowrap="nowrap">帳號</th>
						<th nowrap="nowrap">密碼</th>
						<th nowrap="nowrap">權限</th>
						<th nowrap="nowrap">趴數</th>
						<th nowrap="nowrap">勞保</th>
						<th nowrap="nowrap">健保</th>
						<th nowrap="nowrap">勞退</th>
						<th nowrap="nowrap">隱藏</th>
					</tr>
					<tr>
						<td>
							<label><?php echo($data[0]['ID']); ?></label>
							<input type="hidden" name="id" value="<?php echo($data[0]['ID']); ?>">
						</td>
						<td>
							<input type="text" name="name" value="<?php echo($data[0]['NAME']); ?>">
						</td>
						<td>
							<input type="text" name="account" value="<?php echo($data[0]['ACCOUNT']); ?>">
						</td>
						<td>
							<input type="text" name="password" value="">
						</td>
						<td>
							<select name="權限名稱">
								<option value="<?php echo($data[0]['權限名稱']); ?>" checked>
									<?php echo($data[0]['權限名稱']); ?>
								</option>
								<option value="最高權限">最高權限</option>
								<option value="次高權限">次高權限</option>
								<option value="會計">會計</option>
								<option value="行政">行政</option>
								<option value="業務">業務</option>
								<option value="工讀">工讀</option>
							</select>
						</td>
						<td>
							<input type="text" name="趴數" value="<?php echo($data[0]['趴數']); ?>">
						</td>
						<td>
							<input type="text" name="勞保" value="<?php echo($data[0]['勞保']); ?>">
						</td>
						<td>
							<input type="text" name="健保" value="<?php echo($data[0]['健保']); ?>">
						</td>
						<td>
							<input type="text" name="勞退" value="<?php echo($data[0]['勞退']); ?>">
						</td>
						<td>
							<input type="radio" name="隱藏" value="0" <?php echo $data[0]['隱藏']==0 ? 'checked' : '' ?>>關閉<br>
							<input type="radio" name="隱藏" value="1" <?php echo $data[0]['隱藏']==1 ? 'checked' : '' ?>>開啟<br>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="" value="確認">
						</td>
					</tr>
						
					
				</table>
			</div>
		</form>

	</div>
</main>
