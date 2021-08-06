            <main role="main" style="margin-left: 142px !important; width: 100%;">
                <form method="post" name="edit_order_info" action="edit_order">
                    <div style="display: flex; flex-direction: column; justify-content: space-around">
                        <div style="height: 50px; margin-bottom: 10px;margin-top: 40px; align-self: center;">
                            <label style="font-size: 30px; font-weight: bold">成交單 <?php echo $result['ID'] ?></label>
                        </div>
                        <input type="hidden" name="ID" value="<?php echo $result['ID'] ?>">
                        <div style="display:flex; flex-direction: row; border-style: double;">
                            <div id="container1">
                                <div class="container-items container-title">
                                    <label>成交日期</label>
                                    <label>業務</label>
                                    <label>客戶姓名</label>
                                    <label>身分證字號</label>
                                    <label>聯絡電話</label>
                                    <label>聯絡人</label>
                                    <label>聯絡地址</label>
                                    <label>買賣</label>
                                    <label>股票</label>
                                    <label>張數</label>
                                    <label>成交價</label>
                                    <label>盤價</label>
                                </div>
                                <div class="container-items container-value">
                                    <input type="date" name="成交日期" value="<?php echo $result['成交日期'] ?>" id="date" required>
                                    <input readonly type="text" name="業務" value="<?php echo $result['業務'] ?>" style="cursor: not-allowed">
                                    <input type="text" name="客戶姓名" id="" value="<?php echo $result['客戶姓名']; ?>" required>
                                    <input type="text" name="身分證字號" id="" value="<?php echo $result['身分證字號']; ?>">
                                    <input type="tel" name="聯絡電話" id="" value="<?php echo $result['聯絡電話']; ?>" required>
                                    <input type="text" name="聯絡人" id="" value="<?php echo $result['聯絡人']; ?>" required>
                                    <input type="text" name="聯絡地址" id="" value="<?php echo $result['聯絡地址']; ?>"style="width: 400px;" required>
                                    <select name="買賣" id="sel1" required>
                                        <?php if ($result['買賣']==1) { ?>
                                            <option value="1" selected="selected">買</option>
                                            <option value="0">賣</option>
                                        <?php } else { ?>
                                            <option value="1">買</option>
                                            <option value="0" selected="selected">賣</option>
                                        <?php }?>
                                    </select>
                                    <input type="text" name="股票" id="" value="<?php echo $result['股票']; ?>" required>
                                    <input type="text" name="張數" id="" value="<?php echo $result['張數']; ?>" required>
                                    <input type="text" name="成交價" id="" value="<?php echo $result['成交價']; ?>" required>
                                    <input type="text" name="盤價" id="" value="<?php echo $result['盤價']; ?>">
                                </div>
                            </div>

                            <div id="container2">
                                <div class="container-items container-title">
                                    <label>匯款/應收金額</label>
                                    <label>匯款銀行</label>
                                    <label>匯款分行</label>
                                    <label>匯款帳號</label>
                                    <label>匯款戶名</label>
                                    <label style="height: 64px;">轉讓會員</label>
<!--                                    <label style="height: 64px;">轉讓會員2</label>-->
                                    <label>完稅人</label>
                                    <label>新舊</label>
                                    <label>自行應付</label>
                                    <label>刻印</label>
                                    <label>過戶費</label>
                                    <label>備註</label>
                                </div>
                                <div class="container-items container-value">
                                    <input type="text" name="匯款金額應收帳款" id="" value="<?php echo $result['匯款金額應收帳款']; ?>">
                                    <input type="text" name="匯款銀行" id="" value="<?php echo $result['匯款銀行']; ?>">
                                    <input type="text" name="匯款分行" id="" value="<?php echo $result['匯款分行']; ?>" >
                                    <input type="text" name="匯款帳號" id="" value="<?php echo $result['匯款帳號']; ?>" >
                                    <input type="text" name="匯款戶名" id="" value="<?php echo $result['匯款戶名']; ?>">
                                    <select id="edit_轉讓會員" name="轉讓會員" required>
                                        <option value="<?php echo $result['轉讓會員'] ?>"><?php echo $result['轉讓會員'] ?></option>
                                        <?php
                                        for ($j=0; $j < count($employees); $j++) {
                                            echo "<option value=".$employees[$j]['NAME'].">".$employees[$j]['NAME']."</option>";
                                        }
                                        ?>
                                    </select>
                                    <span style="color: #FF0000">★轉讓會員為此成交單與你的交易方</span>
<!--                                    <select id="edit_轉讓會員2" name="轉讓會員2" required>-->
<!--                                        --><?php //if ($result['轉讓會員2']=='null') { ?>
<!--                                            <option value="null">--><?php //echo '無第二轉讓會員'; ?><!--</option>-->
<!--                                        --><?php //} else { ?>
<!--                                            <option value="--><?php //echo $result['轉讓會員2'] ?><!--">--><?php //echo $result['轉讓會員2'] ?><!--</option>-->
<!--                                        --><?php //} ?>
<!--                                        --><?php
//                                        for ($j=0; $j < count($employees); $j++) {
//                                            echo "<option value=".$employees[$j]['NAME'].">".$employees[$j]['NAME']."</option>";
//                                        }
//                                        ?>
<!--                                    </select>-->
<!--                                    <span style="color: #FF0000">★轉讓會員為此成交單與你的第二交易方</span>-->
                                    <input type="text" name="完稅人" id="" value="<?php echo $result['完稅人']; ?>" required>
                                    <select name="新舊" id="new1" equired>
                                        <?php if ($result['新舊']==1) { ?>
                                            <option value="1" selected="selected">新</option>
                                            <option value="0">舊</option>
                                        <?php } else { ?>
                                            <option value="1">新</option>
                                            <option value="0" selected="selected">舊</option>
                                        <?php }?>
                                    </select>
                                    <input type="text" name="自行應付" value="<?php echo $result['自行應付']; ?>" >
                                    <input type="text" name="刻印" value="<?php echo $result['刻印']; ?>" >
                                    <input type="text" name="過戶費" value="<?php echo $result['過戶費']; ?>" >
                                    <textarea cols="80" name="備註" style="width: fit-content;"><?php echo $result['備註']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div style="align-self: center; margin-top: 15px;">
                            <button class="btn btn-primary btn-lg" type="submit">保存</button>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
</body>

<style>
    #container1 {
        display: flex;
        flex-direction: row;
        flex: 1;
        justify-content: center;
    }

    .container-items{
        margin: 5px;
    }

    .container-title{
        display: flex;
        flex-direction: column;
    }

    .container-value{
        display: flex;
        flex-direction: column;
        max-width: 150px;
    }

    #container2 {
        display: flex;
        flex-direction: row;
        flex: 1;
        justify-content: flex-start;
    }

    th, td, form {
        white-space: wrap;
    }

    label{
        margin-bottom: 5px;
        line-height: 40px;
    }

    input, select {
        margin: 0px 3px 5px 3px;
        height: 40px;
    }

    select{
        height: 40px;
        width: 144px;
        align-self: center;
    }

</style>

