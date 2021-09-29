 <main id="mainSection" role="main" style="font-family:微軟正黑體;">
        <div id="body" style="display: flex; justify-content: center;">
            <form action="edit_employee" method="POST" name="" style= "display:flex; flex-direction: column; width: 75vw; margin-top: 50px;">

                <div class="form-content" style="margin-bottom: 5px;">
                    <span>名稱</span>
                    <span>帳號</span>
                    <span>新密碼</span>
                    <?php if ($_SESSION['權限名稱'] == '最高權限'){ ?>
                        <span>權限</span>
                    <?php } ?>
                    <span>趴數</span>
                    <span>勞保</span>
                    <span>健保</span>
                    <span>勞退</span>
                    <?php if ($_SESSION['權限名稱'] == '最高權限'){ ?>
                    <span>是否隱藏</span>
                    <?php } ?>
                </div>
                <div class="form-content">
                    <input type="hidden" id="errorMsg" value="<?=$msg?>">
                    <input type="hidden" name="id" value="<?=$data[0]['ID']?>">
                    <input type="text" name="name" value="<?php echo($data[0]['NAME']); ?>">
                    <input type="text" name="account" value="<?php echo($data[0]['ACCOUNT']); ?>">
                    <input type="password" name="password" value="">
                    <?php if ($_SESSION['權限名稱'] == '最高權限'){ ?>
                    <select name="權限名稱" style="width: 160px;">
                        <option value="<?php echo($data[0]['權限名稱']); ?>" selected>
                            <?php echo($data[0]['權限名稱']); ?>
                        </option>
                        <option value="最高權限">最高權限</option>';
                        <option value="次高權限">次高權限</option>';
                        <option value="會計">會計</option>';
                        <option value="行政">行政</option>';
                        <option value="業務">業務</option>';
                        <option value="工讀">工讀</option>';
                    </select>
                    <input type="text" name="趴數" value="<?php echo($data[0]['趴數']); ?>">
                    <input type="text" name="勞保" value="<?php echo($data[0]['勞保']); ?>">
                    <input type="text" name="健保" value="<?php echo($data[0]['健保']); ?>">
                    <input type="text" name="勞退" value="<?php echo($data[0]['勞退']); ?>">
                    <input type="text" name="隱藏" value="<?php echo($data[0]['隱藏']); ?>">
                    <?php } else { ?>
                        <input type="hidden" name="權限名稱" value="<?php echo($data[0]['權限名稱']); ?>">
                        <input type="text" name="趴數" value="<?php echo($data[0]['趴數']); ?>" readonly="readonly" style="cursor: not-allowed; background-color: #DCDCDC">
                        <input type="text" name="勞保" value="<?php echo($data[0]['勞保']); ?>" readonly="readonly" style="cursor: not-allowed; background-color: #DCDCDC">
                        <input type="text" name="健保" value="<?php echo($data[0]['健保']); ?>" readonly="readonly" style="cursor: not-allowed; background-color: #DCDCDC">
                        <input type="text" name="勞退" value="<?php echo($data[0]['勞退']); ?>" readonly="readonly" style="cursor: not-allowed; background-color: #DCDCDC">
                        <input type="hidden" name="隱藏" value="<?php echo($data[0]['隱藏']); ?>">

                    <?php } ?>

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
            width: 160px;
            padding: 5px;
            text-align: right;
        }
        span{
            width: 160px;
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