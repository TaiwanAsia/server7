 <main id="mainSection" role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div style="margin: 40px 0px 50px 30px;">
   <form method="post" name="new_order_info" action="add_order" >
    <div style="display: flex;">
     <table>
        <tr>
            <td class="text-danger"><p><b>☝紅色為必填欄位　　</b></p></td>
            <td><label for="" class="text-danger">成交日期</label></td>
            <td><input class="" type="date" id="成交日期" name="成交日期" id="date" required></td>
            <td><button type="button" onclick="gettoday()">今天</button></td>
            <?php if ($_SESSION['NAME'] == '小祿'){ ?>
            <td><button type="button" onclick="loadtestdata()">測試資料</button></td>
            <?php } ?>
        </tr>
        <tr>
            <td></td>
            <td><label for="" class="">業務</label></td>
            <td>
                <?php if ($_SESSION['權限名稱'] == '最高權限') { ?>
                <select name="業務" class="form-control" required onchange="myFunction()">
                    <option value="null">-請選擇-</option>
                    <?php
                    foreach ($employees as $k => $v){
                        echo "<option value=".$v['NAME'].">".$v['NAME']."</option>";
                    }
                    ?>
                </select>
                <?php } else { ?>
                    <input readonly type="text" name="業務" value="<?php echo $_SESSION['NAME'] ?>" id="">
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td><p id="createResult"></p></td>
            <td><label for="" class="text-danger">客戶姓名</label></td>
            <td><input class="" type="text" name="客戶姓名" value="" id="customer_name" required></td>
<!--            <td><button type="button" id="import_customer">匯入</button></td>-->
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <input type="checkbox" onchange="count_selfpay()" name="" id="是否盤商" value="人家是盤商">此客戶姓名為盤商
            </td>
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
                <input type="radio" name="買賣" value="1" checked>
                <label class="text-danger"><b>買</b></label>
                <input type="radio" name="買賣" value="0">
                <label class="text-primary"><b>賣</b></label>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><label for="" class="text-danger">股票</label></td>
            <td><input class="" type="text" name="股票" id="股票" required></td>
            <td><span class="text-danger"><b>***名稱必須與本公司網站的該公司名稱一樣***</b></span> >> <a href="http://www.kcc668.com/">點此進入本公司網站</a></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td><label for="" class="text-danger">張數</label></td>
            <td><input class="" type="text" name="張數" id="張數" required></td>
            <td><p class="text-info">★低於1000股 / 張，請再新增零股部分成交單</p></td>
        </tr>
        <tr>
            <td></td>
            <td><label for="" class="text-danger">成交價</label></td>
            <td><input class="" type="text" name="成交價" value="" id="成交價" required></td>
            <td><p class="text-info">★與持股人交易之股價</p></td>
        </tr>
        <tr>
            <td></td>
            <td><label for="" class="text-danger">盤價</label></td>
            <!-- <td><input readonly="" class="" type="text" name="盤價" value="" id=""></td> -->
            <td><p class="text-info">★系統自動運算</p></td>
        </tr>
        <tr>
            <td></td>
            <td><label for="" class="text-danger">金額</label></td>
            <td><input class="" type="text" onchange="count_selfpay()" name="匯款金額應收帳款" value="" id="填寫金額" required=""></td>
            <td><button type="button" onclick="accounting()">驗算金額</button></td>
            <td><input type="hidden" id="驗算金額" value=""></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="" id="order_info" class="text-danger">
                <p class="text-danger"><b>★客戶賣出 / 買進股票，按一下驗算匯款金額圖示，系統會幫你自動驗算喔！</b></p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td id="money_info" class="text-danger"></td>
        </tr>
        <tr>
            <td></td>
            <td><label for="" class="text-danger">匯款日期</label></td>
            <td><input class="" type="date" id="匯款日期" name="匯款日期"></td>
<!--            <td><button type="button" onclick="getdealdate()">同成交日期</button></td>-->
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
                    <option value="null">-請選擇-</option>
                    <?php
                    foreach ($employees as $k => $v){
                        echo "<option value=".$v['NAME'].">".$v['NAME']."</option>";
                    }
                    ?>
                </select>
            </td>
            <td><p class="text-info">★轉讓會員為此成交單與你的交易方</p></td>
        </tr>
<!--        <tr>-->
<!--            <td></td>-->
<!--            <td><label for="" class="text-danger">轉讓會員2</label></td>-->
<!--            <td>-->
<!--                <select id="轉讓會員2" name="轉讓會員2" class="form-control" required onchange="myFunction()">-->
<!--                    <option value="null">-複數轉讓請選擇-</option>-->
<!--                    --><?php
//                    foreach ($employees as $k => $v){
//                        echo "<option value=".$v['NAME'].">".$v['NAME']."</option>";
//                    }
//                    ?>
<!--                </select>-->
<!--            </td>-->
<!--            <td><p class="text-info">★轉讓會員2為此成交單與你的第二交易方</p></td>-->
<!--        </tr>-->
        <tr>
            <td></td>
            <td><label for="" class="text-danger">完稅人</label></td>
            <td><input class="" type="text" name="完稅人" value="鄧喬尹" id="" required></td>
        </tr>
        <tr>
            <td></td>
            <td><label for="" class="text-danger">新舊</label></td>
            <td>
                <input type="radio" name="新舊" value="1"><label class="text-danger"><b>新</b></label>
                <input type="radio" name="新舊" value="0" checked><label class="text-success"><b>舊</b></label>
            </td>
            <td colspan="2"><p class="text-info">★客戶第一次買賣此公司股票則為新戶，需繳交身分影本 & 代刻印章</p></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2"><p class="text-info">★客戶若非第一次買賣此公司股票則為舊戶，需將上次購入時原留印章寄回</p></td>
        </tr>
        <tr>
            <td></td>
            <td><label>自行應付</label></td>
            <td><input type="text" name="自行應付" value="" id="自行應付"></td>
            <td><p class="text-danger"><b>★由業務全額支付</b></p></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><p class="text-danger"> ★幫客戶負擔稅金、快遞費 ★ 刻印 、收送、寫錯稅單、第二次以上過戶</p></td>
        </tr>
        <tr>
            <td></td>
            <td><label for="" class="">刻印</label></td>
            <td><input class="" type="text" name="刻印" value="" id=""></td>
        </tr>
        <tr>
            <td></td>
            <td><label for="" class="">收送</label></td>
            <td><input class="" type="text" name="收送" value="" id=""></td>
        </tr>
        <tr>
            <td></td>
            <td><label for="" class="text-danger">過戶日期</label></td>
            <td><input class="" type="date" id="過戶日期" name="過戶日期" required></td>
            <td><labe>預設為匯款日期後第3天</labe></td>
        </tr>
        <tr>
            <td></td>
            <td><label for="" class="">過戶費</label></td>
            <td><input class="" type="text" name="過戶費" value="500" id=""></td>
            <td><p class="text-danger"> ★請記得填寫過戶費</p></td>
        </tr>
        <tr>
            <td></td>
            <td><label for="noteField">備註</label></td>
            <td colspan="2">
                <textarea rows="4" cols="70" name="備註" id="noteField"></textarea>
            </td>
        </tr>
        <tr></tr>
        <tr>
            <td></td>
            <td><button type="submit">送出</button></td>
            <td></td>
        </tr>
       </table>

        <div id="msg">
            <?php if (isset($_GET['code']) && $_GET['code'] == 1) {
                echo "<span style='font-size: xx-large; background: red; color: white; font-weight: 600;'>新增失敗，尚未選取業務。</span>";
            } elseif (isset($_GET['code']) && $_GET['code'] == 2) {
                echo "<span style='font-size: xx-large; background: red; color: white; font-weight: 600;'>新增失敗，尚未選取轉讓會員。</span>";
            }?>
        </div>

     </div>
   </form>
 </div>
</main>
        </div>
    </div>
</body>

<script>

    function gettoday() {
        document.getElementById("成交日期").valueAsDate = new Date();
    }

    function loadtestdata() {
        var today = new Date();
        document.getElementById("成交日期").valueAsDate = today;
        document.getElementById("匯款日期").valueAsDate = today;
        document.getElementById("過戶日期").valueAsDate = today;
        document.getElementById("customer_name").value = '測試王';
        document.getElementById("customer_tel").value = '0912345678';
        document.getElementById("customer_man").value = '測試王';
        document.getElementById("customer_address").value = '台北區台北街27巷5號3樓';
        document.getElementById("股票").value = '台積G';
        document.getElementById("張數").value = '3';
        document.getElementById("成交價").value = '100';
        document.getElementById("填寫金額").value = 3*100*1000;
        document.getElementById("轉讓會員").value = 'qito';
    }

    function myFunction() {
        var x = document.getElementById("轉讓會員").value;
        if (x == '盤商') {
            document.getElementById("盤商資料").style.display = "table-row";

        } else {
            document.getElementById("盤商資料").style.display = "none";
        }
    }

    function accounting() {

        var checkbox = document.getElementById('是否盤商');
        var checked = checkbox.checked;

        var 張數 = document.getElementById("張數").value;
        var 成交價 = document.getElementById("成交價").value;
        // var 張數 = document.getElementById("張數").value;
        // alert(document.getElementById("買賣").value);
        var 買賣value = $("input:checked").val();
        if (買賣value == 1) {
            var 買賣方 = '買';
            document.getElementById("order_info").innerHTML = '張數 : '+document.getElementById("張數").value +
        ' 成交價 : '+document.getElementById("成交價").value + '  客戶[買進]';
        } else {
            var 買賣方 = '賣';
            if (買賣value == 0) {
                if (checked) {
                    //客戶為盤商,不用扣稅
                    document.getElementById("order_info").innerHTML = '張數 : '+document.getElementById("張數").value + ' 成交價 : '+document.getElementById("成交價").value + '  客戶[賣出]但因為是盤商，毋需扣千分之三金額';
                } else {
                    document.getElementById("order_info").innerHTML = '張數 : '+document.getElementById("張數").value + ' 成交價 : '+document.getElementById("成交價").value + '  且客戶[賣出]，需扣掉千分之三金額';
                }
            }
        }

        if (買賣方 == '買') {
            if (張數 >= 1) {
                document.getElementById("money_info").innerHTML = '[公式] =>  '+張數+'(張數) * 1000 * '+成交價+'(成交價) = '+張數*1000*成交價;
                document.getElementById("驗算金額").value = 張數*1000*成交價;
            } else {
                document.getElementById("money_info").innerHTML = '[公式] =>  '+張數+'(張數) * 1000 * '+成交價+'(成交價) * 0.9(零股) = '+張數*1000*成交價*0.9;
                document.getElementById("驗算金額").value = 張數*1000*成交價*0.9;
            }
        } else {
            if (張數 >= 1) {
                if (checked) {
                    document.getElementById("money_info").innerHTML = '[公式] =>  '+張數+'(張數) * 1000 * '+成交價+'(成交價) = '+(張數*1000*成交價);
                    document.getElementById("驗算金額").value = (張數*1000*成交價);
                } else {
                    document.getElementById("money_info").innerHTML = '[公式] =>  '+張數+'(張數) * 1000 * '+成交價+'(成交價) * 0.997 = '+(張數*1000*成交價)*0.997;
                    document.getElementById("驗算金額").value = (張數*1000*成交價)*0.997;
                }
            } else {
                if (checked) {
                    document.getElementById("money_info").innerHTML = '[公式] =>  '+張數+'(張數) * 1000 * '+成交價+'(成交價) * 0.9(零股) = '+(張數*1000*成交價)*0.9;
                    document.getElementById("驗算金額").value = (張數*1000*成交價)*0.9;
                } else {
                    document.getElementById("money_info").innerHTML = '[公式] =>  '+張數+'(張數) * 1000 * '+成交價+'(成交價) * 0.997 * 0.9(零股) = '+(張數*1000*成交價)*0.997*0.9;
                    document.getElementById("驗算金額").value = (張數*1000*成交價)*0.997*0.9;
                }
            }

        }
    }

    function count_selfpay() {
        var 填寫金額 = document.getElementById("填寫金額").value;
        var 驗算金額 = document.getElementById("驗算金額").value;
        var 自行應付 = 填寫金額 - 驗算金額;
        // alert(填寫金額+'-'+驗算金額+'='+自行應付);
        document.getElementById("自行應付").value = 自行應付;
    }

    Date.prototype.addDays = function(days) {
        var dat = new Date(this.valueOf());
        dat.setDate(dat.getDate() + days);
        return dat;
    }

    //匯款日期抓成交日期
    function getdealdate() {
        document.getElementById("匯款日期").value = document.getElementById("成交日期").value;
        var pay = document.getElementById("匯款日期").value;
        var paydate = new Date(pay);
        過戶日期 = paydate.addDays(3);
        month = 過戶日期.getMonth()+1,
        day = 過戶日期.getDate(),
        year = 過戶日期.getFullYear();
        if (month.toString().length < 2) month = '0' + month;
        if (day.toString().length < 2) day = '0' + day;
        result = [year, month, day].join('-');
        // alert(result);
        document.getElementById('過戶日期').value = result;
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
                    $("#createResult").html('未成交過此客戶！');
                }
            },
            error: function(jqXHR,data) {
                alert("發生錯誤: " + jqXHR.status);
            }
        })
    })

</script>