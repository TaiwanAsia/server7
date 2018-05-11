
                <main role="main" style="flex: 1 0 auto;" >
                  <div class="t-form-h">

                        <h1 class="h2">待對帳</h1>

       

                    <div class="t-form">
                        <table id="eoTable" class="table table-md table-hover table-responsive">
                            <thead class="thead-light">
                                <tr>
                                    <th>編號</th>
                                    <th>匯款人</th>
                                    <th>匯款帳號末5碼</th>
                                    <th>匯款金額</th>
                                    <th>查帳狀態</th>
                                    <th>動作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($data) { ?>
                                <tr>
                                  <td><?php echo $data[0]['ID']; ?></td>
                                  <td><?php echo $data[0]['匯款人']; ?></td>
                                  <td><?php echo $data[0]['匯款帳號末5碼']; ?></td>
                                  <td><?php echo $data[0]['已匯金額已收金額']; ?></td>
                                  <td>
                                    <?php if ($data[0]['通知查帳']=='待對帳') { ?>
                                      <img src="<?php echo base_url(); ?>static/待對帳.png" width="80" height="40">
                                    <?php } elseif ($data[0]['通知查帳']=='待確認') { ?>
                                      <img src="<?php echo base_url(); ?>static/待確認.png" width="80" height="40">
                                    <?php } ?>
                                  </td>
                                  <td><button>檢視</button></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>


    </body>
</html>
