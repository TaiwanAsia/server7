<main id="mainSection" role="main" style="flex: 1 0 auto;" >
  <div class="t-form-h">
    <div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
        <h1 class="h2">應收帳款</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/checkbill'" value="所有應收"></input>
                <?php if ($_SESSION['權限名稱']=='最高權限') { ?>
                    <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/boss_check_money'" value="尚未對帳"></input>
                <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/check_record'" value="紀錄"></input>
                <?php } ?>
                <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/pay_error'" value="轉出異常"></input>
                <input class="btn btn-sm btn-outline-secondary" type ="button" onclick="javascript:location.href='<?php echo base_url(); ?>index.php/orders/show_bank'" value="銀行明細"></input>
            </div>
        </div>
    </div>