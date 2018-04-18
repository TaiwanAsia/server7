            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div>
                    <form method="post" name="edit_order_info" action="edit_order" >
                        <div class="offset-md-1">
                            <table>
                                <tr>
                                    <td><?php echo form_error('編號'); ?></td>
                                    <td><label for="" class="">編號</label></td>       
                                    <td><input readonly type="text" name="ID" value="<?php echo $result[0]['ID'] ?>" id=""></td>
                                </td>
                                <tr>
                                    <td><?php echo form_error('日期'); ?></td>
                                    <td><label for="" class="">日期</label></td>
                                    <td><input class="" type="date" name="日期" value="" id="date" value="<?php echo $result[0]['日期']; ?>" required></td>
                                    <td>原為<?php echo $result[0]['日期']; ?></td>
                                    <td><button type="button" onclick="gettoday()">今天</button></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('業務'); ?></td>
                                    <td><label for="" class="">業務</label></td>       
                                    <td><input readonly type="text" name="業務" value="<?php echo $_SESSION['NAME'] ?>" id=""></td>
                                </td>
                                <tr>
                                    <td><?php echo form_error('客戶姓名'); ?></td>
                                    <td><label for="" class="">客戶姓名</label></td>
                                    <td><input class="" type="text" name="客戶姓名" id="" value="<?php echo $result[0]['客戶姓名']; ?>" required></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('身分證字號'); ?></td>
                                    <td><label for="" class="">身分證字號</label></td>
                                    <td><input class="" type="text" name="身分證字號" id="" value="<?php echo $result[0]['身分證字號']; ?>" required></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('聯絡電話'); ?></td>
                                    <td><label for="" class="">聯絡電話</label></td>
                                    <td><input class="" type="tel" name="聯絡電話" id="" value="<?php echo $result[0]['聯絡電話']; ?>" required></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('聯絡人'); ?></td>
                                    <td><label for="" class="">聯絡人</label></td>
                                    <td><input class="" type="text" name="聯絡人" id="" value="<?php echo $result[0]['聯絡人']; ?>" required></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('聯絡地址'); ?></td>
                                    <td><label for="" class="">聯絡地址</label></td>
                                    <td><input class="" type="text" name="聯絡地址" id="" value="<?php echo $result[0]['聯絡地址']; ?>" required></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('買賣'); ?></td>
                                    <td><label for="" class="">買賣</label></td>
                                    <td>
                                        <select class="form-control" name="買賣" id="sel1" equired>
                                        <?php if ($result[0]['買賣']==1) { ?>
                                            <option value="1">買</option>
                                        <?php } else { ?>
                                            <option value="0">賣</option>
                                        <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('股票'); ?></td>
                                    <td><label for="" class="">股票</label></td>
                                    <td><input class="" type="text" name="股票" id="" value="<?php echo $result[0]['股票']; ?>" required></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('張數'); ?></td>
                                    <td><label for="" class="">張數</label></td>
                                    <td><input class="" type="text" name="張數" id="" value="<?php echo $result[0]['張數']; ?>" required></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('成交價'); ?></td>
                                    <td><label for="" class="">成交價</label></td>
                                    <td><input class="" type="text" name="成交價" id="" value="<?php echo $result[0]['成交價']; ?>" required></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('盤價'); ?></td>
                                    <td><label for="" class="">盤價</label></td>
                                    <td><input class="" type="text" name="盤價" id="" value="<?php echo $result[0]['盤價']; ?>"></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('匯款金額'); ?></td>
                                    <td><label for="" class="">匯款金額</label></td>
                                    <td><input class="" type="text" name="匯款金額" id="" value="<?php echo $result[0]['匯款金額']; ?>"></td>
                                </tr>
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
                                    <td><input class="" type="text" name="匯款帳號" id="" value="<?php echo $result[0]['匯款分行']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('匯款戶名'); ?></td>
                                    <td><label for="" class="">匯款戶名</label></td>
                                    <td><input class="" type="text" name="匯款戶名" id="" value="<?php echo $result[0]['匯款戶名']; ?>"></td>
                                </tr>
                                <!-- <tr>
                                    <td><?php echo form_error('轉讓會員'); ?></td>
                                    <td><label for="" class="">轉讓會員</label></td>
                                    <td><input class="" type="text" name="轉讓會員" id="" required></td>
                                </tr> -->
                                <tr>
                                    <td><?php echo form_error('完稅人'); ?></td>
                                    <td><label for="" class="">完稅人</label></td>
                                    <td><input class="" type="text" name="完稅人" id="" value="<?php echo $result[0]['完稅人']; ?>" required></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('新舊'); ?></td>
                                    <td><label for="" class="">新舊</label></td>
                                    <td>
                                        <select class="form-control" name="新舊" id="" required>
                                            <option value="1">新</option>
                                            <option value="0">舊</option>
                                        </select>
                                    </td>
                                    <td>
                                        <?php if ($result[0]['新舊']==1) {
                                            echo "原為新";
                                        } else {
                                            echo "原為舊";
                                        }?>
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
                                    <td><label for="" class="">過戶費</label></td>
                                    <td><input class="" type="text" name="過戶費" id="" value="<?php echo $result[0]['過戶費']; ?>" ></td>
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
                                    <td><input class="" type="text" name="收付款" id="" required></td>
                                </tr>
                                <tr>
                                    <td><?php echo form_error('過戶日'); ?></td>
                                    <td><label for="" class="">過戶日</label></td>
                                    <td><input class="" type="date" name="過戶日" id="" required></td>
                                </tr> -->
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

<script>
    function gettoday() {
        document.getElementById("date").valueAsDate = new Date()
    }
</script>