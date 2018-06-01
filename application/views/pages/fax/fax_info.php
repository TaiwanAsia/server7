
	<main role="main" class="col-md-9 col-lg-10 pt-3 px-4">
		<div class="t-form">
			<table class="">
            	<tr>
            		<td>
            			<form action="go_dealer" method="POST" class="t-form-t" name="">
							<input type="submit" name="" value="盤商資料">
						</form>
            		</td>
            		<td>
						<form action="go_taxer" method="POST" class="t-form-t" name="">
						<input type="submit" name="" value="完稅資料">
					</form>
            		</td>
            	</tr>


                <tr>
                    <td>盤商名</td>
                    <td><input id="dealer_name" type="text" name=""></td>
                    <td><button id="import_dealer">匯入</button></td>
                </tr>
                <tr>
                    <td>傳　　真</td>
                    <td><input id="dealer_fax" type="text" name=""></td>
                    <td></td>
                    <td>電　話</td>
                    <td><input id="dealer_tel" type="text" name=""></td>
                </tr>

                <tr>
                    <td>成交交易明細</td>
                </tr>

                <tr>
                    <td>股票名稱</td>
                    <td><input id="" type="text" name=""></td>
                    <td><button id="">匯入</button></td>
                    <td>方　式</td>
                    <td><input id="" type="text" name=""></td>
                </tr>
                <tr>
                    <td>成交價格</td>
                    <td><input id="" type="text" name=""></td>
                    <td></td>
                    <td>張　數</td>
                    <td><input id="" type="text" name=""></td>
                </tr>


                
                <tr>
                    <td>完稅姓名</td>
                    <td><input id="taxer_name" type="text" name=""></td>
                    <td><button id="import_taxer">匯入</button></td>
                    <td>　ID</td>
                    <td><input id="" type="text" name=""></td>
                </tr>
                <tr>
                    <td>完稅地址</td>
                    <td><input id="taxer_address" type="text" name=""></td>
                </tr>
                <tr>
                    <td>戶　　名</td>
                    <td><input id="payer_name" type="text" name=""></td>
                    <td><button id="import_payer">匯入</button></td>
                </tr>
                <tr>
                    <td>匯款銀行</td>
                    <td><input id="payer_bank" type="text" name=""></td>
                    <td></td>
                    <td>帳　號</td>
                    <td><input id="payer_account" type="text" name=""></td>
                </tr>
                <tr>
                    <td>過戶日期</td>
                    <td><input id="" type="text" name=""></td>
                </tr>
                <tr>
                    <td>匯款金額</td>
                    <td><input id="payer_amount" type="text" name=""></td>
                </tr>
			</table>
            <div>
                <button>產生檔案</button>
            </div>
	   </div>
	</main>


</body>

<script type="text/javascript">
	
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


</html>