<main id="mainSection" role="main" style="font-family:微軟正黑體;">
	<div id="body">
		<form action="add_employee" method="POST" name="" style= "display:inline">

			<div>
                <input type="hidden" id="errorMsg" value="<?=$msg?>">
				<table style="width:100%" border="1">
					<tr bgcolor="#e4bc7c">
						<th nowrap="nowrap">名稱</th>
						<th nowrap="nowrap">帳號</th>
						<th nowrap="nowrap">密碼</th>
						<th nowrap="nowrap">權限</th>
						<th nowrap="nowrap">趴數</th>
						<th nowrap="nowrap">勞保</th>
						<th nowrap="nowrap">健保</th>
						<th nowrap="nowrap">勞退</th>
					</tr>
					<tr>
						<td>
							<input type="text" name="name" value="<?php echo set_value('name[]'); ?>">
						</td>
						<td>
							<input type="text" name="account" value="<?php echo set_value('account[]'); ?>">
						</td>
						<td>
							<input type="password" name="password" value="">
						</td>
						<td>
							<select name="權限名稱">
								<option value=""></option>';
								<option value="最高權限">最高權限</option>';
								<option value="次高權限">次高權限</option>';
								<option value="會計">會計</option>';
								<option value="行政">行政</option>';
								<option value="業務">業務</option>';
								<option value="工讀">工讀</option>';
							</select>
						</td>
						<td>
							<input type="text" name="趴數" value="<?php echo set_value('趴數[]'); ?>">
						</td>
						<td>
							<input type="text" name="勞保" value="<?php echo set_value('勞保[]'); ?>">
						</td>
						<td>
							<input type="text" name="健保" value="<?php echo set_value('健保[]'); ?>">
						</td>
						<td>
							<input type="text" name="勞退" value="<?php echo set_value('勞退[]'); ?>">
						</td>
						<td>
							<input type="submit" name="" value="確認">
						</td>
						<input type="hidden" name="隱藏" value="1">
					</tr>
				</table>
			</div>
		</form>

	</div>
</main>

<script>
    $(document).ready(function() {
        var msg = $('#errorMsg').val();
        if (msg){
            alert(msg)
        }
    })

</script>