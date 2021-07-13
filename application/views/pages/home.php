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

		<div class="sec-three sec-s">
			<form action="add_assign" method="post" id="assign">
				<div class="sec-content">
		 			<h4>工單</h4>
		 			<p>對象：</p>
		 			<ul>
		 				<?php for ($i=0; $i < count($employees); $i++) {
		 					if ($employees[$i]['NAME']!='盤商'&&$employees[$i]['NAME']!='庫存'&&$employees[$i]['NAME']!='吉翔看單'&&$employees[$i]['NAME']!='KO'&&$employees[$i]['隱藏']==1) { ?>
		 					<li>
		 						<input type="checkbox" name="工單對象[]" value="<?php echo $employees[$i]['NAME'] ?>"><?php echo $employees[$i]['NAME'] ?>
		 					</li>
		 				<?php	}
		 				} ?>
		 			</ul>
		 		</div>

		 		<div class="sec-content">
		 			<h4>工單屬性</h4>
		 			<ul>
		 				<li>
		 					<label>
		 						<input type="radio" name="工單屬性" value="職務代理">
		 						職務代理
							</label>
		 				</li>
		 				<li>
		 					<label>
		 						<input type="radio" name="工單屬性" value="掛單">
		 						掛單
							</label>
		 				</li>
		 				<li>
		 					<label>
		 						<input type="radio" name="工單屬性" value="網頁修改">
		 						網頁修改
							</label>
		 				</li>
		 				<li>
		 					<label>
		 						<input type="radio" name="工單屬性" value="行政庶務">
		 						行政庶務
							</label>
		 				</li>
		 				<li>
		 					<label>
		 						<input type="radio" name="工單屬性" value="收送過戶">
		 						收送過戶
							</label>
						</li>
						<li>
							<label>
		 						<input type="radio" name="工單屬性" value="公告事項">
		 						公告事項
							</label>
		 				</li>
		 			</ul>
		 		</div>

		 		<!-- <div class="sec-content">
		 			<h4>附件</h4>
                	<input type="file" name="工單附件" class="f-file-s" id="exampleFormControlFile1">
                    <input type="hidden" name="id" value="<?php echo $orders[$i]['ID']?>">
                    <button type="submit" id="" name="" class="">上傳</button>
		 		</div> -->

                <div class="sec-content">
                    <h4>等級</h4>
                    <ul>
                        <li>
                            <label>
                                <input type="radio" name="等級" value="normal">
                                一般
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="等級" value="important">
                                重要
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="等級" value="urgent">
                                重要且緊急
                            </label>
                        </li>
                    </ul>
                </div>

		 		<div class="sec-content">
		 			<h4>工單內容</h4>
		 			<div class="note-sec">
						<textarea cols="120" rows="5" name="工單內容"></textarea>
						<button type="submit" form="assign">送出</button>
		 			</div>
		 		</div>


			</form>
	 	</div>
</main>

<style type="text/css">
	.need_data:hover {
		background-color: yellow;
	}
</style>