            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div>
                    <form method="post" name="" action="check_money" >
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
                                    <td><label for="" class="">入帳日期</label></td>
                                    <td><input class="" type="date" name="轉出日期轉入日期" id="" value=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">匯款人</label></td>
                                    <td><input class="" type="text" name="匯款人" id="" value=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">匯款帳號末5碼</label></td>
                                    <td><input class="" type="text" name="匯款帳號末5碼" id="" value=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">入帳金額</label></td>
                                    <td><input class="" type="text" name="已匯金額已收金額" id="" value=""></td>
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
</body>

