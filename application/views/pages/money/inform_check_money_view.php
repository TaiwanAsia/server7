<main id="mainSection" role="main">
    <div style="justify-content: center; display: flex;">
        <form method="post" name="" action="inform_check_money" >
            <div style="margin-top: 80px;">
                <table style="table-layout: fixed">
                    <tr>
                        <td></td>
                        <td><label><b>成交單編號</b></label></td>
                        <td><H3 for="" class="text-danger"><?php echo $order[0]['ID']; ?></H3></td>
                        <td><input class="" type="hidden" name="ID" id="" value="<?php echo $order[0]['ID']; ?>"></td>
                        <td><input type="hidden" name="媒合" value="<?php echo $order[0]['媒合']; ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><label for="" class="">支付日期</label></td>
                        <td><input class="" type="date" name="轉出日期轉入日期" id="支付日期" value=""></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><label for="" class="">支付方式</label></td>
                        <td>
                            <input type="radio" name="支付方式" value="匯款" checked="" style="margin-right: 5px;"><label class="text-danger" style="margin-right: 5px;"><b>匯款</b></label>
                            <input type="radio" name="支付方式" value="現金" style="margin-left: 10px; margin-right: 5px;"><label class="text-primary"><b>現金</b></label>
                        </td>
                        <td><label for="" class="text-info">★匯款請填匯款人及帳號末5碼</label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><label for="" class="">金額</label></td>
                        <td><input class="" type="text" name="待查帳金額" id="金額" value="" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><label for="" class="">支付人</label></td>
                        <td><input class="" type="text" name="支付人" id="支付人" value=""></td>
                        <td><label style="text-decoration:underline; cursor: pointer;" onclick="Set_payname('<?php echo $order[0]['客戶姓名']; ?>', '<?php echo $order[0]['匯款金額應收帳款']; ?>', '<?php echo $order[0]['成交日期']; ?>')">匯入日期、金額與支付人</label></td>
                    </tr>
                    <!-- <?php print_r($order);?> -->
                    <tr>
                        <td></td>
                        <td><label for="" class="">匯款帳號末5碼</label></td>
                        <td><input class="" type="text" name="匯款帳號末5碼" id="" value=""></td>
                    </tr>


                    <tr></tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td><button type="submit" class="btn btn-secondary" style="margin-top: 40px;">送出</button></td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</main>
</div>
</div>
<style>
    td{
        height: 50px;
        width: 100px;
    }
</style>
<script>
    function Set_payname(name, money, date) {
        var n = name;
        document.getElementById("支付人").value = n;
        document.getElementById("金額").value = money;
        document.getElementById("支付日期").value = date;
    }
</script>
</body>



