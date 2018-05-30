            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div>
                    <form method="post" name="" action="inform_check_money" >
                        <div class="offset-md-1">
                            <table>
                                <tr>
                                    <td></td>
                                    <td><label for="" class=""><b>成交單編號</b></label></td>
                                    <td><label for="" class="text-danger"><?php echo $order[0]['ID']; ?></label></td>
                                    <td><input class="" type="hidden" name="ID" id="" value="<?php echo $order[0]['ID']; ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">支付日期</label></td>
                                    <td><input class="" type="date" name="轉出日期轉入日期" id="" value=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">支付方式</label></td>
                                    <td>
                                        <input type="radio" name="支付方式" value="匯款"><label class="text-danger"><b>匯款</b></label>
                                        <input type="radio" name="支付方式" value="現金"><label class="text-primary"><b>現金</b></label>
                                    </td>
                                    <td><label for="" class="text-info">★匯款請填匯款人及帳號末5碼</label></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">金額</label></td>
                                    <td><input class="" type="text" name="待查帳金額" id="" value="" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">支付人</label></td>
                                    <td><input class="" type="text" name="支付人" id="支付人" value=""></td>
                                    <td><button onclick="Set('<?php echo $order[0]['客戶姓名']; ?>')">同客戶姓名</button></td>
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
                                    <td><button type="submit">送出</button></td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>    
    <script>
        function Set(name) {
            var n = name;
            document.getElementById("支付人").value = n;
        }
    </script>
</body>



