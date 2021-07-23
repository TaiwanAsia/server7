<main id="mainSection" role="main">
 		<div class="sec-one sec-s">
			<div class="row">
				<div class="col-xl-6">
					<div class="note-sec">
						<table class="note-table">
							<thead class="thead-s1">
								<tr>
									<th>需求者</th>
									<th>標的</th>
									<th>買價</th>
									<th>張數</th>
									<th>委託到期日</th>
									<th>進度</th>
									<th>議價</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php if ($need) {
									for ($i=0; $i < count($need); $i++) { ?>
									<tr class="need_data">
										<?php if ($need[$i]['買賣']==1) {
											echo "<td>".$need[$i]['需求者']."</td>";
											echo "<td>".$need[$i]['股名']."</td>";
											echo "<td>".$need[$i]['價格']."</td>";
											echo "<td>".$need[$i]['張數']."</td>";
											echo "<td>".$need[$i]['委託到期日']."</td>";
											echo "<td>".$need[$i]['進度']."</td>";
											if ($need[$i]['議價'] == 1) {
												echo "<td>可</td>";
											} else {
												echo "<td>不可</td>";
											}
										
										if ($_SESSION['權限名稱'] == '最高權限') { ?>
											<td>
												<form method="get" action="delete_need">
													<input type="hidden" name="id" value="<?=$need[$i]['ID']?>">
													<button type="submit" class="btn btn-danger">刪</button>
												</form>
											</td>
											

										<?php } elseif ($_SESSION['NAME'] == $need[$i]['需求者']) { ?>
											<td>
												<form method="get" action="delete_need">
													<input type="hidden" name="id" value="<?=$need[$i]['ID']?>">
													<button type="submit" class="btn btn-danger">刪</button>
												</form>
											</td>
										<?php } } ?>
									</tr>
								<?php	}
								} ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="note-sec">
						<table class="note-table">
							<thead class="thead-s2">
								<tr>
									<th>需求者</th>
									<th>股名</th>
									<th>賣價</th>
									<th>張數</th>
									<th>委託到期日</th>
									<th>進度</th>
									<th>議價</th>
									<th></th>
								</tr>
							</thead>
							<tbody>

								<?php if ($need) {
									for ($i=0; $i < count($need); $i++) { ?>
									<tr>
										<?php if ($need[$i]['買賣']==0) {
											echo "<td>".$need[$i]['需求者']."</td>";
											echo "<td>".$need[$i]['股名']."</td>";
											echo "<td>".$need[$i]['價格']."</td>";
											echo "<td>".$need[$i]['張數']."</td>";
											echo "<td>".$need[$i]['委託到期日']."</td>";
											echo "<td>".$need[$i]['進度']."</td>";
											if ($need[$i]['議價'] == 1) {
												echo "<td>可</td>";
											} else {
												echo "<td>不可</td>";
											}
										
										if ($_SESSION['權限名稱'] == '最高權限') { ?>
											<td>
												<form method="get" action="delete_need">
													<input type="hidden" name="id" value="<?=$need[$i]['ID']?>">
													<button type="submit" class="btn btn-danger">刪</button>
												</form>
											</td>
											

										<?php } elseif ($_SESSION['NAME'] == $need[$i]['需求者']) { ?>
											<td>
												<form method="get" action="delete_need">
													<input type="hidden" name="id" value="<?=$need[$i]['ID']?>">
													<button type="submit" class="btn btn-danger">刪</button>
												</form>
											</td>
										<?php } }?>
									</tr>
								<?php	}
								} ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="sec-two sec-s">
			<div style="background-color:#B87070;" class="row row-s-1">
				<div class="col-xl-12">
					<span><b>股票名稱</b></span>
					<input type="text" name="">
					<span><button>搜索</button></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p>請務必確實填寫<font color="red">　完整標的名稱　</font>四個字</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12">
					<form action="add_need" method="post" id="need">
						<table id="table1" class="table table-md table-hover table-responsive">
							<tr>
							<thead class="thead-light">
								<th>需求者</th>
								<th>股名</th>
								<th>買或賣</th>
								<th>價格</th>
								<th>張數</th>
								<!-- <th>客戶姓名</th>
								<th>手機</th>
								<th>委託到期日</th>
								<th colspan="2">進度</th>
 -->						</thead>
							<tbody>
								<td>
									<p><?php echo $_SESSION['NAME']; ?></p>
									<input type="hidden" name="需求者" value="<?php echo $_SESSION['NAME']; ?>">
								</td>
								<td>
									<input type="text" name="股名">
								</td>
								<td>
									<input type="radio" name="買賣" value="1">
					                <label class="text-danger"><b>買</b></label>
					                <input type="radio" name="買賣" value="0">
					                <label class="text-primary"><b>賣</b></label>
								</td>
								<td>
									<input type="text" class="input-ty1" name="價格">
									<input type="checkbox" name="議價" value="1">
									<label class="text-primary"><b>可議價</b></label>
								</td>
								<td>
									<input type="text" name="張數">
								</td>
								<!-- <td>
									<input type="text" name="客戶姓名">
								</td>
								<td>
									<input type="text" name="手機">
								</td>
								<td>
									<input type="date" name="委託到期日">
								</td>
								<td>
									<input type="text" name="進度">
								</td>
								<td>
									<button type="submit" form="need">送出</button>
								</td> -->
							</tbody>
							</tr>
							<tr>
								<thead class="thead-light">
								<th>客戶姓名</th>
								<th>手機</th>
								<th>委託到期日</th>
								<th>進度(文字敘述)</th>
								<th>把握度(1~10)</th>

							</thead>
							<tbody>
								<td>
									<input type="text" name="客戶姓名">
								</td>
								<td>
									<input type="text" name="手機">
								</td>
								<td>
									<input type="date" name="委託到期日">
								</td>
								<td>
									<input type="text" name="把握度">
								</td>
								<td>
									<input type="text" name="進度">
								</td>
								<td>
									<button type="submit" form="need">送出</button>
								</td>
							</tbody>
							</tr>
						</table>
						
					</form>
				</div>
		 	</div>
		</div>



    <div class="t-form">
        <table id="billboardTable" class="table">
            <thead class="thead-light">
            <tr >
                <th nowrap="nowrap">對象</th>
                <th nowrap="nowrap">屬性</th>
                <th nowrap="nowrap" style="width: 100px">附件</th>
                <th nowrap="nowrap">等級</th>
                <th nowrap="nowrap">建立者</th>
                <th nowrap="nowrap">建立時間</th>
                <th colspan="3"></th>

            </tr>
            </thead>
            <tbody>
            <?php if($assigns) { for ($i=0; $i < count($assigns); $i++) { ?>
                <tr>

                    <td>
                        <?php echo '給 <b>'.$assigns[$i]['工單對象'].'</b> ('.$assigns[$i]['ID'].')'; ?>
                    </td>
                    <td>
                        <?php echo $assigns[$i]['工單屬性']; ?>
                    </td>
                    <td>
                        <div>
                            <?php
                            $exist = false;
                            if (file_exists("uploads/work/".$assigns[$i]['ID'].".jpg")) {
                                $exist = ".jpg";
                            }
                            if (file_exists("uploads/work/".$assigns[$i]['ID'].".jpeg")) {
                                $exist = ".jpeg";
                            }
                            if (file_exists("uploads/work/".$assigns[$i]['ID'].".png")) {
                                $exist = ".png";
                            }
                            if (file_exists("uploads/work/".$assigns[$i]['ID'].".xls")) {
                                $exist = ".xls";
                            }
                            if (file_exists("uploads/work/".$assigns[$i]['ID'].".xlsx")) {
                                $exist = ".xlsx";
                            }
                            if (file_exists("uploads/work/".$assigns[$i]['ID'].".csv")) {
                                $exist = ".csv";
                            }
                            if (file_exists("uploads/work/".$assigns[$i]['ID'].".doc")) {
                                $exist = ".doc";
                            }
                            if (file_exists("uploads/work/".$assigns[$i]['ID'].".docx")) {
                                $exist = ".docx";
                            }
                            if (file_exists("uploads/work/".$assigns[$i]['ID'].".pdf")) {
                                $exist = ".pdf";
                            }
                            if ($exist) { ?>
                                <a href="<?php echo 'http'.'://'.$_SERVER['HTTP_HOST'].'/server7/uploads/work/'.$assigns[$i]['ID'].$exist;?>" target="_blank">附件</a>
                            <?php } else { ?>
                                <form action="upload_attachment" enctype="multipart/form-data" method="post">
                                    <input type="file" name="userfile" size="20" />
                                    <input type="hidden" name="id" value="<?php echo $assigns[$i]['ID']?>">
                                    <input type="submit" value="上傳" />
                                </form>
                            <?php } ?>
                        </div>
                    </td>
                    <td>
                        <?php echo '<b>'.$assigns[$i]['等級'].'</b>'; ?>
                    </td>
                    <td>
                        <?php echo '<b>'.$assigns[$i]['建立者'].'</b>'; ?>
                    </td>
                    <td>
                        <?php echo $assigns[$i]['建立時間']; ?>
                    </td>
                    <td>
                        <form method="get" action="delete_assign">
                            <input type="hidden" name="id" value="<?=$assigns[$i]['ID']?>">
                            <button type="submit" class="">刪除</button>
                        </form>

                    </td>
                </tr>
                <tr class="ex-t-row">
                    <td colspan="7">
                        <div style="display: flex;flex-direction: row">
                            <form method="post" action="assign_reply">
                                <div id="new-reply" style="display: flex; flex-direction: column;">
                                    <input type="hidden" name="pid" value="<?=$assigns[$i]['ID']?>">
                                    <input type="hidden" name="toid" value="<?=$assigns[$i]['工單對象']?>">
                                    <textarea name="回覆內容" placeholder="回覆..." cols="80" rows="5"></textarea>
                                    <button type="submit" style="align-self: flex-start">送出</button>
                                </div>
                            </form>
                            <div id="replies" style="margin-left: 70px; display: flex; flex-direction: row; white-space: normal;">
                                <div>
                                    <div class="dynamic-height" id="<?='content'.$assigns[$i]['ID']?>" style="word-break: break-all; background-color: honeydew; border-radius: 12px; padding: 5px; margin-bottom: 5px; width: 700px;">
                                        <?php echo nl2br($assigns[$i]['工單內容'])?>
                                    </div>
                                    <?php foreach ($reply as $k => $v){
                                        if ($v['pid'] == $assigns[$i]['ID']){?>
                                            <div class="dynamic-height" id="<?='content'.$v['ID']?>" style="word-break: break-all; background-color: beige; border-radius: 12px; padding: 5px; margin-bottom: 5px; width: 700px;">
                                                <?php echo nl2br($v['工單內容'])?>
                                            </div>
                                        <?php } }?>
                                </div>
                                <div>
                                    <div id="<?='author'.$assigns[$i]['ID']?>" style="padding: 5px; margin-bottom: 5px;">
                                        <?php echo nl2br($assigns[$i]['建立者'])?>
                                    </div>
                                    <?php foreach ($reply as $k => $v){
                                        if ($v['pid'] == $assigns[$i]['ID']){?>
                                            <div id="<?='author'.$v['ID']?>" style="padding: 5px; margin-bottom: 5px;">
                                                <?php echo nl2br($v['建立者'])?>
                                            </div>
                                        <?php } }?>
                                </div>
                                <div>
                                    <div id="<?='created'.$assigns[$i]['ID']?>" style="padding: 5px; margin-bottom: 5px; margin-left: 25px;">
                                        <?php echo nl2br($assigns[$i]['建立時間'])?>
                                    </div>
                                    <?php foreach ($reply as $k => $v){
                                        if ($v['pid'] == $assigns[$i]['ID']){?>
                                            <div id="<?='created'.$v['ID']?>" style="padding: 5px; margin-bottom: 5px; margin-left: 25px;">
                                                <?php echo nl2br($v['建立時間'])?>
                                            </div>
                                        <?php } }?>
                                </div>
                            </div>

                        </div>
                    </td>
                </tr>


            <?php } }?>

            </tbody>
        </table>
    </div>

</main>

<style type="text/css">
	.need_data:hover {
		background-color: yellow;
	}
</style>

<script type="text/javascript">
    /*
    [建立者]、[建立時間]對齊[工單內容]的高度
     */
    jQuery(document).ready(function($){ //wait for the document to load
        $('.dynamic-height').each(function(){ //loop through each element with the .dynamic-height class
            var ids  = this.id;
            var nums = ids.substring(7);
            var h = $(this).height();
            $("#author"+nums).height(h);
            $("#created"+nums).height(h);
        });
    });
</script>