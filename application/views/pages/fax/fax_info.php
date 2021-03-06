<main id="mainSection" role="main" style="font-family:微軟正黑體;">
    <div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
        <h1 class="h2">傳真資料</h1>
<!--        <form action="go_dealer" method="POST" class="t-form-t" name="">-->
<!--            <input type="submit" name="" value="盤商資料" class="btn btn-sm btn-outline-secondary">-->
<!--        </form>-->
<!--        <form action="go_taxer" method="POST" class="t-form-t" name="">-->
<!--            <input type="submit" name="" value="完稅資料" class="btn btn-sm btn-outline-secondary">-->
<!--        </form>-->
    </div>
    <div class="t-form" style="display: flex; justify-content: center;">
        <table id="faxTable">
            <form method="post" name="fax_info" action="fax_exported">
                <tr>
                    <td>盤商名</td>
                    <td><input id="dealer_name" type="text" name="dealer_name"></td>
                    <td><button type="button" id="import_dealer">匯入</button></td>
                </tr>
                <tr>
                    <td>傳　　真</td>
                    <td><input id="dealer_fax" type="text" name="dealer_fax"></td>
                    <td></td>
                    <td>電　話</td>
                    <td><input id="dealer_tel" type="text" name="dealer_tel"></td>
                </tr>

                <tr>
                    <td style="border-style: double; text-align: center;"><b>成交交易明細</b></td>
                </tr>

                <tr>
                    <td>成交單編號</td>
                    <td><input id="order_id" type="text" name="order_id"></td>
                    <td><button type="button" id="import_order">匯入</button></td>
                    <td colspan="2"><p class="text-danger">★請先匯入成交單編號</p></td>
                    <input type="hidden" id="transaction_date" name="transaction_date" value="">
                </tr>
                <tr>
                    <td>股票名稱</td>
                    <td><input id="stock_name" type="text" name="stock_name"></td>
                    <td></td>
                    <td>方　式</td>
                    <td><input id="way" type="text" name="way"></td>
                </tr>
                <tr>
                    <td>成交價格</td>
                    <td><input id="stock_price" type="text" name="stock_price"></td>
                    <td></td>
                    <td>張　數</td>
                    <td><input id="stock_amount" type="text" name="stock_amount"></td>
                </tr>

                <tr>
                    <td>完稅姓名</td>
                    <td><input id="taxer_name" type="text" name="taxer_name"></td>
                    <td><button type="button" id="import_taxer">匯入</button></td>
                    <td>　ID</td>
                    <td><input id="taxer_id" type="text" name="taxer_id"></td>
                </tr>
                <tr>
                <td>完稅地址</td>
                    <td><input id="taxer_address" type="text" name="taxer_address"></td>
                </tr>
                <tr>
                    <td>戶　　名</td>
                    <td><input id="payer_name" type="text" name="payer_name"></td>
                    <td><button type="button" id="import_payer">匯入</button></td>
                </tr>
                <tr>
                    <td>匯款銀行</td>
                    <td><input id="payer_bank" type="text" name="payer_bank"></td>
                    <td></td>
                    <td>帳　號</td>
                    <td><input id="payer_account" type="text" name="payer_account"></td>
                </tr>
                <tr>
                    <td>過戶日期</td>
                    <td><input id="transfer_date" type="date" name="transfer_date"></td>
                </tr>
                <tr>
                    <td>匯款金額</td>
                    <td><input id="payer_amount" type="text" name="payer_amount"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <p class="text-danger">★輸入完畢請點下方按鈕</p>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="Fax_exported">產生檔案</button></td>
                </tr>
            </form>
        </table>
    </div>
</main>

<style>
    tr{
        height: 45px;
    }
    td{
        width: 120px;
    }
</style>

<script type="text/javascript">

    $("#import_order").click(function() {
        $.ajax({
            type: "GET",
            url: "<?=base_url()?>index.php/orders/import_order_info?order_id="+ $("#order_id").val(),
            dataType: "json",
            success: function(data) {
                if (data.ID) {
                    $("#stock_name").val(data.股票);
                    if (data.買賣 == 1) {
                        $("#way").val("買");
                    } else {
                        $("#way").val("賣");
                    }
                    $("#transaction_date").val(data.成交日期);
                    $("#stock_price").val(data.成交價);
                    $("#stock_amount").val(data.張數);
                    $('#transfer_date').val(data.過戶日期);
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
