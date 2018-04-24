            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div>
                    <form method="post" name="edit_order_info" action="edit2_order" >
                        <div class="offset-md-1">
                            <table>
                                <tr>
                                    <td><?php echo form_error('編號'); ?></td>
                                    <td><label for="" class="">編號</label></td>       
                                    <td><input readonly type="text" name="ID" value="<?php echo $result[0]['ID'] ?>" id=""></td>
                                </td>
                                <tr>
                                    <td><?php echo form_error('客戶姓名'); ?></td>
                                    <td><label for="" class="">客戶姓名</label></td>
                                    <td><input class="" type="text" name="客戶姓名" id="" value="<?php echo $result[0]['客戶姓名']; ?>" required></td>
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
                                    <td><?php echo form_error('張數'); ?></td>
                                    <td><label for="" class="">張數</label></td>
                                    <td><input class="" type="text" name="張數" id="" value="<?php echo $result[0]['張數']; ?>" required></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">自行應付</label></td>
                                    <td><input class="" type="text" name="自行應付" id="" value="<?php echo $result[0]['自行應付']; ?>" ></td>
                                </tr>
                                
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">過戶費</label></td>
                                    <td><input class="" type="text" name="過戶費" id="" value="<?php echo $result[0]['過戶費']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">刻印</label></td>
                                    <td><input class="" type="text" name="刻印" id="" value="<?php echo $result[0]['刻印']; ?>" ></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><label for="" class="">轉讓會員</label></td>
                                    <td>
                                        <select id="edit_轉讓會員" name="轉讓會員" class="form-control" required>
                                            <option value="<?php echo $result[0]['轉讓會員'] ?>"><?php echo $result[0]['轉讓會員'] ?></option>
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
                                    <td><label for="" class="">過戶日期</label></td>
                                    <td><input class="" type="text" name="過戶日期" id="" value="<?php echo $result[0]['過戶日期']; ?>" ></td>
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
