            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div>
                    <form method="post" name="new_order_info" action="add_order" >
                        <div class="offset-md-1">
                            <table>
                                <tr>
                                    <td class="text-danger"><p><b>☝紅色為必填欄位　　</b></p></td>
                                    <td><label for="" class="text-danger">成交日期</label></td>
                                    <td><input class="" type="date" name="成交日期" value="" id="date" required></td>
                                    <td><button type="button" onclick="gettoday()">今天</button></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">業務</label></td>       
                                    <td><input readonly type="text" name="業務" value="<?php echo $_SESSION['NAME'] ?>" id=""></td>
                                </td>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="text-danger">客戶姓名</label></td>
                                    <td><input class="" type="text" name="客戶姓名" value="" id="customer_name" required></td>
                                    <td><button id="import_customer">匯入</button></td>
                                    <td><p id="createResult"></p></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">身分證字號</label></td>
                                    <td><input class="" type="text" name="身分證字號" value="" id="customer_id"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="text-danger">聯絡電話</label></td>
                                    <td><input class="" type="tel" name="聯絡電話" value="" id="customer_tel" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="text-danger">聯絡人</label></td>
                                    <td><input class="" type="text" name="聯絡人" value="" id="customer_man" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="text-danger">聯絡地址</label></td>
                                    <td><input class="" type="text" name="聯絡地址" value="" id="customer_address" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="text-danger">買賣</label></td>
                                    <td>
                                        <input type="radio" name="買賣" value="1" checked><label class="text-danger"><b>買</b></label>
                                        <input type="radio" name="買賣" value="0"><label class="text-primary"><b>賣</b></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="text-danger">股票</label></td>
                                    <td><input class="" type="text" name="股票" value="" id="" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="text-danger">張數</label></td>
                                    <td><input class="" type="text" name="張數" value="" id="" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="text-danger">成交價</label></td>
                                    <td><input class="" type="text" name="成交價" value="" id="" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">盤價</label></td>
                                    <td><input class="" type="text" name="盤價" value="" id=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">匯款/應收金額</label></td>
                                    <td><input class="" type="text" name="匯款金額應收帳款" value="" id=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">匯款銀行</label></td>
                                    <td><input class="" type="text" name="匯款銀行" value="" id=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">匯款分行</label></td>
                                    <td><input class="" type="text" name="匯款分行" value="" id=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">匯款戶名</label></td>
                                    <td><input class="" type="text" name="匯款戶名" value="" id=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">匯款帳號</label></td>
                                    <td><input class="" type="text" name="匯款帳號" value="" id=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="text-danger">轉讓會員</label></td>
                                    <td>
                                        <select id="轉讓會員" name="轉讓會員" class="form-control" required onchange="myFunction()">
                                            <?php
                                            for ($j=0; $j < count($employees); $j++) {
                                                echo "<option value=".$employees[$j]['NAME'].">".$employees[$j]['NAME']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><p class="text-info">★轉讓會員為此成交單與你的交易方</p></td>
                                    <td id="盤商資料" style="display:none">
                                        <table>
                                            <tr>
                                                <td>盤商名</td>
                                                <td><input id="dealer_name" type="text" name=""></td>
                                                <td><button id="import_dealer">匯入</button></td>
                                            </tr>
                                            <tr>
                                                <td>傳　真</td>
                                                <td><input id="dealer_fax" type="text" name=""></td>
                                            </tr>
                                            <tr>
                                                <td>電　話</td>
                                                <td><input id="dealer_tel" type="text" name=""></td>
                                            </tr>
                                            <tr>
                                                <td>完稅姓名</td>
                                                <td><input id="taxer_name" type="text" name=""></td>
                                                <td><button id="import_taxer">匯入</button></td>
                                            </tr>
                                            <tr>
                                                <td>完稅ID</td>
                                                <td><input id="taxer_id" type="text" name=""></td>
                                            </tr>
                                            <tr>
                                                <td>完稅地址</td>
                                                <td><input id="taxer_address" type="text" name=""></td>
                                            </tr>
                                            <tr>
                                                <td>匯款姓名</td>
                                                <td><input id="payer_name" type="text" name=""></td>
                                                <td><button id="import_payer">匯入</button></td>
                                            </tr>
                                            <tr>
                                                <td>匯款銀行</td>
                                                <td><input id="payer_bank" type="text" name=""></td>
                                            </tr>
                                            <tr>
                                                <td>匯款帳號</td>
                                                <td><input id="payer_account" type="text" name=""></td>
                                            </tr>
                                            <tr>
                                                <td>匯款金額</td>
                                                <td><input id="payer_money" type="text" name=""></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="text-danger">完稅人</label></td>
                                    <td><input class="" type="text" name="完稅人" value="" id="" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="text-danger">新舊</label></td>
                                    <td>
                                        <input type="radio" name="新舊" value="1" checked><label class="text-danger"><b>新</b></label>
                                        <input type="radio" name="新舊" value="0"><label class="text-success"><b>舊</b></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">自行應付</label></td>
                                    <td><input class="" type="text" name="自行應付" value="" id=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">刻印</label></td>
                                    <td><input class="" type="text" name="刻印" value="" id=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">過戶費</label></td>
                                    <td><input class="" type="text" name="過戶費" value="" id=""></td>
                                </tr>
                                <!-- <tr>
                                    <td><?php echo form_error('媒合'); ?></td>
                                    <td><label for="" class="">媒合</label></td>
                                    <td>
                                        <select id="inputState" name="媒合" class="form-control">
                                            <option selected value="0">尚無媒合</option>
                                            <?php
                                            for ($i=0; $i < count($orders); $i++) { 
                                                echo "<option>".$orders[$i]['ID']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr> -->
                                <!-- <tr>
                                    <td><?php echo form_error('收付款'); ?></td>
                                    <td><label for="" class="">收付款</label></td>
                                    <td><input class="" type="text" name="收付款" value="" id="" required></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('過戶日'); ?></td>
                                    <td><label for="" class="">過戶日</label></td>
                                    <td><input class="" type="date" name="過戶日" value="" id="" required></td>
                                </tr> -->
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><button type="submit">送出</button></td>
                                </tr>
                            </table>
                        </div>>
                    </form>
                </div>
            </main>
        </div>
    </div>    
</body>

<script>

    function gettoday() {
        document.getElementById("date").valueAsDate = new Date()
    }

    function myFunction() {
        var x = document.getElementById("轉讓會員").value;
        if (x == '盤商') {
            document.getElementById("盤商資料").style.display = "table-row";

        } else {
            document.getElementById("盤商資料").style.display = "none";
        }
    }

    $("#import_customer").click(function() {
        $.ajax({
            type: "GET",
            url: "<?=base_url()?>index.php/orders/import_customer_info?customer_name="+ $("#customer_name").val(),
            dataType: "json",
            success: function(data) {
                if (data.客戶姓名) {
                    $("#customer_id").val(data.身分證字號);
                    $("#customer_tel").val(data.聯絡電話);
                    $("#customer_man").val(data.聯絡人);
                    $("#customer_address").val(data.聯絡地址);
                    $("#createResult").html('');
                } else {
                    $("#createResult").html('此客戶未出現在您的成交資料過！');
                }
            },
            error: function(jqXHR,data) {
                alert("發生錯誤: " + jqXHR.status);
            }
        })
    })

    $("#import_dealer").click(function() {
        $.ajax({
            type: "GET",
            url: "<?=base_url()?>index.php/orders/import_dealer_info?dealer_name="+ $("#dealer_name").val(),
            dataType: "json",
            success: function(data) {
                if (data.盤商名) {
                    $("#dealer_fax").val(data.盤商傳真);
                    $("#dealer_tel").val(data.盤商電話);
                    // $("#createResult").html('盤商：' + data.盤商名稱 + '，匯入成功！');
                } else {
                    $("#createResult").html(data.msg);
                }                   
            },
            error: function(jqXHR,data) {
                // alert("發生錯誤: " + jqXHR.status);
                alert(data);
            }
        })
    })

    $("#import_taxer").click(function() {
        $.ajax({
            type: "GET",
            url: "<?=base_url()?>index.php/orders/import_taxer_info?taxer_name="+ $("#taxer_name").val(),
            dataType: "json",
            success: function(data) {
                if (data.完稅姓名) {
                    $("#taxer_id").val(data.完稅ID);
                    $("#taxer_address").val(data.完稅地址);
                } else {
                    $("#createResult").html(data.msg);
                }                   
            },
            error: function(jqXHR,data) {
                alert("發生錯誤: " + jqXHR.status);
            }
        })
    })

    $("#import_payer").click(function() {
        $.ajax({
            type: "GET",
            url: "<?=base_url()?>index.php/orders/import_payer_info?payer_name="+ $("#payer_name").val(),
            dataType: "json",
            success: function(data) {
                if (data.匯款姓名) {
                    $("#payer_bank").val(data.匯款銀行);
                    $("#payer_account").val(data.匯款帳號);
                    $("#payer_money").val(data.匯款金額應收帳款);
                } else {
                    $("#createResult").html(data.msg);
                }                   
            },
            error: function(jqXHR,data) {
                alert("發生錯誤: " + jqXHR.status);
            }
        })
    })

</script>