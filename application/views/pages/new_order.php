            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div>
                    <form method="post" name="new_order_info" action="add_order" >
                        <div class="offset-md-1">
                            <table>
                                <tr>
                                    <td></td>
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
                                    <td><input class="" type="text" name="客戶姓名" value="" id="" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">身分證字號</label></td>
                                    <td><input class="" type="text" name="身分證字號" value="" id=""></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="text-danger">聯絡電話</label></td>
                                    <td><input class="" type="tel" name="聯絡電話" value="" id="" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="text-danger">聯絡人</label></td>
                                    <td><input class="" type="text" name="聯絡人" value="" id="" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="text-danger">聯絡地址</label></td>
                                    <td><input class="" type="text" name="聯絡地址" value="" id="" required></td>
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
                                    <td><input class="" type="text" name="匯款金額" value="" id=""></td>
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
                                        <select id="edit_轉讓會員" name="轉讓會員" class="form-control" required>
                                            <?php
                                            for ($j=0; $j < count($employees); $j++) {
                                                echo "<option value=".$employees[$j]['NAME'].">".$employees[$j]['NAME']."</option>";
                                            }
                                            ?>
                                        </select>
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