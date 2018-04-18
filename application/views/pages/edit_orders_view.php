<div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
              <div class="modal-header">
                <h3>編輯成交單</h3>
              </div>
              <form method="post" name="edit_order_info" action="edit_order" >
                <div class="">
                  <table>
                    <tr>
                      <td><label>個人姓名</label></td>
                      <td><input type="text" name="個人姓名" value=""></td>
                      <td><label>身分證字號</label></td>
                      <td><input type="text" name="身分證字號" value=""></td>
                      <td><label>聯絡地址</label></td>
                      <td><input type="text" name="聯絡地址" value=""></td>
                      <td><label>聯絡電話</label></td>
                      <td><input type="text" name="聯絡電話" value=""></td>
                    </tr>
                    <tr>
                      <td><label>成交日期</label></td>
                      <td><input class="" type="date" name="成交日期" value="" id=""></td>
                      <td><label>過戶日期</label></td>
                      <td><input class="" type="date" name="過戶日期" value="" id=""></td>
                    </tr>
                    <tr>
                      <td><label>股票名稱</label></td>
                      <td><input type="text" name="股票名稱" value=""></td>
                      <td>
                        <input type="radio" name="買賣" value="1" checked>買
                        <input type="radio" name="買賣" value="0">賣
                      </td>
                      <td></td>
                      <td><label>張數</label></td>
                      <td><input type="text" name="張數" value=""></td>
                    </tr>
                    <tr>
                      <td><label>轉讓會員</label></td>
                      <td>
                        <select id="inputState" name="轉讓會員" class="form-control">
                            <?php
                            for ($j=0; $j < count($employees); $j++) {
                                echo "<option value=".$employees[$j]['NAME'].">".$employees[$j]['NAME']."</option>";
                            }
                            ?>
                        </select>
                      </td>
                      <td><label>完稅價</label></td>
                      <td><input type="text" name="完稅價" value=""></td>
                      <td><label>成交價</label></td>
                      <td><input type="text" name="成交價" value=""></td>
                      <td><label>盤價</label></td>
                      <td><input type="text" name="盤價" value=""></td>
                    </tr>
                    <tr>
                      <td><label>自付額</label></td>
                      <td><input type="text" name="自付額" value=""></td>
                    </tr>
                  </table>
                </div>
                <div class="">
                  <label><h4>賣方需填</h4></label>
                  <br>
                  <table>
                    <tr>
                      <td><label>匯款銀行</label></td>
                      <td><input type="text" name="匯款銀行" value=""></td>
                      <td><label>匯款分行</label></td>
                      <td><input type="text" name="匯款分行" value=""></td>
                      <td><label>匯款戶名</label></td>
                      <td><input type="text" name="匯款戶名" value=""></td>
                      <td><label>匯款帳號</label></td>
                      <td><input type="text" name="匯款帳號" value=""></td>
                    </tr>
                    <tr>
                      <td class="text-danger"><label><b>匯款金額<b/></label></td>
                      <td><input type="text" name="匯款金額" value=""></td>
                    </tr>
                    <tr>
                      <td><label>完稅人頭</label></td>
                      <td><input type="text" name="完稅人頭" value=""></td>
                      <td><label>過戶費</label></td>
                      <td>
                        <select id="inputState" name="過戶費" class="form-control">
                          <option value="500">500</option>
                          <option value="1000">1000</option>
                          <option value="1500">1500</option>
                          <option value="2000">2000</option>
                        </select>
                      </td>
                      <td><label>刻印收送</label></td>
                      <td>
                        <select id="inputState" name="刻印收送" class="form-control">
                            <?php
                              for($j=1; $j<=10; $j++) {
                                echo "<option value=".$j.">".$j."</option>";
                              }
                            ?>
                        </select>
                      </td>
                      <td><label>客戶來源</label></td>
                      <td>
                        <select id="inputState" name="客戶來源" class="form-control">
                          <option value="開發的">開發的</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td><label>成交單狀態</label></td>
                      <td>
                        <input type="radio" name="成交單狀態" value="審核完成" checked><label class="text-primary">審核完成</label>
                        <input type="radio" name="成交單狀態" value="審核中"><label class="text-success">審核中</label>
                        <input type="radio" name="成交單狀態" value="審核不通過"><label class="text-danger">審核不通過</label>
                      </td>
                    </tr>
                    <tr>
                      <td><label>現金或匯款</label></td>
                      <td>
                        <input type="radio" name="現金或匯款" value="未付款" checked><label class="">未付款</label>
                        <input type="radio" name="現金或匯款" value="現金"><label class="">現金</label>
                        <input type="radio" name="現金或匯款" value="匯款"><label class="">匯款</label>
                      </td>
                    </tr>
                    <tr>
                      <td><label>匯款日期</label></td>
                      <td><input class="" type="date" name="匯款日期" value="" id=""></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td><input class="" type="submit" name="修改完成" value="修改完成" id=""></td>
                    </tr>
                  </table>
                </div>
              </form>
                <span class="close">&times;</span>
            </div>
        </div>