            <main id="mainSection" role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div>
                    <form method="post" name="edit_order_info" action="admin_edit_order" >
                        <div class="offset-md-1">
                            <table>
                                <tr>
                                    <td></td>
                                    <td>
                                        <label for="" class="">編號</label>
                                        <input type="hidden" name="ID" value="<?php echo $result[0]['ID'] ?>">
                                    </td>
                                    <td><h3><label for="" class="text-success"><?php echo $result[0]['ID'] ?></label></h3></td>
                                </td>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">成交日期</label></td>
                                    <td><input class="" type="date" name="成交日期" value="<?php echo $result[0]['成交日期'] ?>" id="date" ></td>
                                    <td><input type="hidden" id="" value="<?php echo $result[0]['成交日期'] ?>"></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('業務'); ?></td>
                                    <td><label for="" class="">業務</label></td>
                                    <td><input type="text" name="業務" value="<?php echo $result[0]['業務'] ?>" id=""></td>
                                </td>
                                <tr>
                                    <td><?php echo form_error('客戶姓名'); ?></td>
                                    <td><label for="" class="">客戶姓名</label></td>
                                    <td><input class="" type="text" name="客戶姓名" id="" value="<?php echo $result[0]['客戶姓名']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">身分證字號</label></td>
                                    <td><input class="" type="text" name="身分證字號" id="" value="<?php echo $result[0]['身分證字號']; ?>"></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('聯絡電話'); ?></td>
                                    <td><label for="" class="">聯絡電話</label></td>
                                    <td><input class="" type="tel" name="聯絡電話" id="" value="<?php echo $result[0]['聯絡電話']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('聯絡人'); ?></td>
                                    <td><label for="" class="">聯絡人</label></td>
                                    <td><input class="" type="text" name="聯絡人" id="" value="<?php echo $result[0]['聯絡人']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('聯絡地址'); ?></td>
                                    <td><label for="" class="">聯絡地址</label></td>
                                    <td><input class="" type="text" name="聯絡地址" id="" value="<?php echo $result[0]['聯絡地址']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('買賣'); ?></td>
                                    <td><label for="" class="">買賣</label></td>
                                    <td>
                                        <select class="form-control" name="買賣" id="sel1" equired>
                                        <?php if ($result[0]['買賣']==1) { ?>
                                            <option value="1" selected="selected">買</option>
                                            <option value="0">賣</option>
                                        <?php } else { ?>
                                            <option value="1">買</option>
                                            <option value="0" selected="selected">賣</option>
                                        <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('股票'); ?></td>
                                    <td><label for="" class="">股票</label></td>
                                    <td><input class="" type="text" name="股票" id="" value="<?php echo $result[0]['股票']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('張數'); ?></td>
                                    <td><label for="" class="">張數</label></td>
                                    <td><input class="" type="text" name="張數" id="" value="<?php echo $result[0]['張數']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('成交價'); ?></td>
                                    <td><label for="" class="">成交價</label></td>
                                    <td><input class="" type="text" name="成交價" id="" value="<?php echo $result[0]['成交價']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('盤價'); ?></td>
                                    <td><label for="" class="">盤價</label></td>
                                    <td><input class="" type="text" name="盤價" id="" value="<?php echo $result[0]['盤價']; ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">金額</label></td>
                                    <td><input class="" type="text" name="匯款金額應收帳款" id="" value="<?php echo $result[0]['匯款金額應收帳款']; ?>"></td>
                                </tr>

                                <input class="" type="hidden" name="已匯金額已收金額" id="" value="<?php echo $result[0]['已匯金額已收金額']; ?>">

                                <!-- <tr>
                                    <td></td>
                                    <td><label for="" class="">已匯/已收金額</label></td>
                                    <td><input class="" type="hidden" name="已匯金額已收金額" id="" value="<?php echo $result[0]['已匯金額已收金額']; ?>"></td>
                                </tr> -->
                                <!-- <tr>
                                    <td></td>
                                    <td><label for="" class="">待查帳金額</label></td>
                                    <td><input class="" type="text" name="待查帳金額" id="" value="<?php echo $result[0]['待查帳金額']; ?>"></td>
                                </tr> -->
                                <!-- <tr>
                                    <td></td>
                                    <td><label for="" class="">轉出/轉入日期</label></td>
                                    <td><input class="" type="date" name="轉出日期轉入日期" value="<?php echo $result[0]['轉出日期轉入日期'] ?>" id="date" ></td>
                                    <td><input type="hidden" id="" value="<?php echo $result[0]['轉出日期轉入日期'] ?>"></td>
                                </tr> -->
                                <!-- <tr>
                                    <td></td>
                                    <td><label for="" class="">匯款人</label></td>
                                    <td><input class="" type="text" name="匯款人" id="" value="<?php echo $result[0]['匯款人']; ?>"></td>
                                </tr> -->
                                <tr>
                                    <td><?php echo form_error('匯款銀行'); ?></td>
                                    <td><label for="" class="">匯款銀行</label></td>
                                    <td><input class="" type="text" name="匯款銀行" id="" value="<?php echo $result[0]['匯款銀行']; ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">匯款分行</label></td>
                                    <td><input class="" type="text" name="匯款分行" id="" value="<?php echo $result[0]['匯款分行']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">匯款帳號</label></td>
                                    <td><input class="" type="text" name="匯款帳號" id="" value="<?php echo $result[0]['匯款帳號']; ?>" ></td>
                                </tr>
                                <!-- <tr>
                                    <td></td>
                                    <td><label for="" class="">匯款帳號末5碼</label></td>
                                    <td><input class="" type="text" name="匯款帳號末5碼" id="" value="<?php echo $result[0]['匯款帳號末5碼']; ?>" ></td>
                                </tr> -->
                                <tr>
                                    <td><?php echo form_error('匯款戶名'); ?></td>
                                    <td><label for="" class="">匯款戶名</label></td>
                                    <td><input class="" type="text" name="匯款戶名" id="" value="<?php echo $result[0]['匯款戶名']; ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">轉讓會員</label></td>
                                    <td>
                                        <select id="edit_轉讓會員" name="轉讓會員" class="form-control" >
                                            <option value="<?php echo $result[0]['轉讓會員'] ?>"><?php echo $result[0]['轉讓會員'] ?></option>
                                            <?php
                                            for ($j=0; $j < count($employees); $j++) {
                                                echo "<option value=".$employees[$j]['NAME'].">".$employees[$j]['NAME']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><p class="text-info">★轉讓會員為此成交單與你的交易方</p></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('完稅人'); ?></td>
                                    <td><label for="" class="">完稅人</label></td>
                                    <td><input class="" type="text" name="完稅人" id="" value="<?php echo $result[0]['完稅人']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('新舊'); ?></td>
                                    <td><label for="" class="">新舊</label></td>
                                    <td>
                                        <select class="form-control" name="新舊" id="new1" equired>
                                        <?php if ($result[0]['新舊']==1) { ?>
                                            <option value="1" selected="selected">新</option>
                                            <option value="0">舊</option>
                                        <?php } else { ?>
                                            <option value="1">新</option>
                                            <option value="0" selected="selected">舊</option>
                                        <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">自行應付</label></td>
                                    <td><input class="" type="text" name="自行應付" id="" value="<?php echo $result[0]['自行應付']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">刻印</label></td>
                                    <td><input class="" type="text" name="刻印" id="" value="<?php echo $result[0]['刻印']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">收送</label></td>
                                    <td><input class="" type="text" name="收送" id="" value="<?php echo $result[0]['收送']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">過戶日期</label></td>
                                    <td><input class="" type="date" name="過戶日期" value="<?php echo $result[0]['過戶日期'] ?>" id="date" ></td>
                                    <td><input type="hidden" id="" value="<?php echo $result[0]['過戶日期'] ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">匯款日期</label></td>
                                    <td><input class="" type="date" name="匯款日期" value="<?php echo $result[0]['匯款日期'] ?>" id="p_date" ></td>
                                    <td><input type="hidden" id="" value="<?php echo $result[0]['匯款日期'] ?>"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">過戶費</label></td>
                                    <td><input class="" type="text" name="過戶費" id="" value="<?php echo $result[0]['過戶費']; ?>" ></td>
                                </tr>
                                <input type="hidden" name="媒合" value="<?php echo $result[0]['媒合']; ?>">
                                <!-- <tr>
                                    <td></td>
                                    <td><label for="" class="">媒合</label></td>
                                    <td>
                                        <select id="inputState" name="媒合" class="form-control">
                                            <option selected value="0">尚無媒合</option>
                                            <?php
                                            for ($i=0; $i < count($all_orders); $i++) {
                                                if ($result[0]['股票'] == $all_orders[$i]['股票'] && $result[0]['買賣'] != $all_orders[$i]['買賣']) {
                                                    echo "<option>".$all_orders[$i]['ID']."</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><p class="text-info">★請確認所選無誤</p></td>
                                </tr> -->
                                <!-- <tr>
                                    <td></td>
                                    <td><label for="" class="">匯款日期</label></td>
                                    <td><input class="" type="date" name="匯款日期" value="<?php echo $result[0]['匯款日期'] ?>" id="date" ></td>
                                    <td><input type="hidden" id="" value="<?php echo $result[0]['匯款日期'] ?>"></td>
                                </tr> -->
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">通知查帳</label></td>
                                    <td><input class="" type="text" name="通知查帳" id="通知查帳日期" value="<?php echo $result[0]['通知查帳']; ?>" ></td>
                                    <td><button type="button" onclick="gettoday()">今天</button></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">成交單狀態</label></td>
                                    <td><input class="" type="text" name="成交單狀態" id="" value="<?php echo $result[0]['成交單狀態']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">二審</label></td>
                                    <td>
                                        <select class="form-control" name="二審" id="">
                                        <?php if ($result[0]['二審']==1) { ?>
                                            <option value="1" selected="selected">審完</option>
                                            <option value="0">未審</option>
                                        <?php } else { ?>
                                            <option value="1">審完</option>
                                            <option value="0" selected="selected">未審</option>
                                        <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">已結案</label></td>
                                    <td>
                                        <select class="form-control" name="已結案" id="">
                                        <?php if ($result[0]['已結案']==1) { ?>
                                            <option value="1" selected="selected">已結案</option>
                                            <option value="0">未結案</option>
                                        <?php } else { ?>
                                            <option value="1">已結案</option>
                                            <option value="0" selected="selected">未結案</option>
                                        <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">備註</label></td>
                                    <td><textarea name="備註" id=""><?php echo $result[0]['備註']; ?></textarea></td>
                                </tr>
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

<script type="text/javascript">
    function gettoday() {
        myDate = new Date();
        // var strDate = myDate.getDate().toString();
        //處理月 位數=1則補0至前
        var Month = myDate.getMonth()+1;
        Month = Month.toString();
        if (Month.length==1) {
            Month = '0'+Month;
        }
        //處理日 位數=1則補0至前
        var dDate = myDate.getDate();
        dDate = dDate.toString();
        if (dDate.length==1) {
            dDate = '0'+dDate;
        }
        if (myDate.getDate().length == 1) {
            document.getElementById("通知查帳日期").value = myDate.getFullYear()+'-'+Month+'-'+dDate;
        } else {
            document.getElementById("通知查帳日期").value = myDate.getFullYear()+'-'+Month+'-'+dDate;
        }
    }
</script>