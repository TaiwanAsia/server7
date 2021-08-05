<main id="mainSection" role="main" style="font-family:微軟正黑體;">
	<div id="body" style="display: flex; justify-content: center;">
		<form action="add_employee" method="POST" name="" style= "display:flex; flex-direction: column; width: 75vw; margin-top: 50px;">

			<div class="form-content" style="margin-bottom: 5px;">
                <input type="hidden" name="隱藏" value="0">
                <span>名稱</span>
                <span>帳號</span>
                <span>密碼</span>
                <span>權限</span>
                <span>趴數</span>
                <span>勞保</span>
                <span>健保</span>
                <span>勞退</span>
			</div>
            <div class="form-content">
                <input type="hidden" id="errorMsg" value="<?=$msg?>">
                <input type="text" name="name" value="<?php echo set_value('name[]'); ?>">
                <input type="text" name="account" value="<?php echo set_value('account[]'); ?>">
                <input type="password" name="password" value="">
                <select name="權限名稱" style="width: 170px;">
                    <option value=""></option>';
                    <option value="最高權限">最高權限</option>';
                    <option value="次高權限">次高權限</option>';
                    <option value="會計">會計</option>';
                    <option value="行政">行政</option>';
                    <option value="業務">業務</option>';
                    <option value="工讀">工讀</option>';
                </select>
                <input type="text" name="趴數" value="<?php echo set_value('趴數[]'); ?>">
                <input type="text" name="勞保" value="<?php echo set_value('勞保[]'); ?>">
                <input type="text" name="健保" value="<?php echo set_value('健保[]'); ?>">
                <input type="text" name="勞退" value="<?php echo set_value('勞退[]'); ?>">

            </div>
            <button type="submit" class="btn btn-primary" style="width: fit-content;align-self: center; margin-top: 50px;">確認</button>

		</form>

	</div>
</main>

<style>
    .form-content{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    input{
        width: 170px;
        padding: 5px;
    }
    span{
        width: 170px;
        text-align: center;
        font-weight: bolder;
        font-size: larger;
    }
</style>

<script>
    $(document).ready(function() {
        var msg = $('#errorMsg').val();
        if (msg){
            alert(msg)
        }
    })

</script>