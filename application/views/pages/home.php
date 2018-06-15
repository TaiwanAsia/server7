<main role="main">
	<div class="container">
 		<div class="sec-one sec-s">
			<div class="row">
				<div class="col-xl-6">
					<div class="note-sec">
						<table class="table-responsive">
							<thead>
								<tr>
									<th>需求者</th>
									<th>股名</th>
									<th>買價</th>
									<th>張數</th>
									<th>委託到期日</th>
									<th>把握度</th>
									<th>進度</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<?php if ($need) {
										for ($i=0; $i < count($need); $i++) {
											if ($need[$i]['買賣']==1) {
												echo "<td>".$need[$i]['需求者']."</td>";
												echo "<td>".$need[$i]['股名']."</td>";
												echo "<td>".$need[$i]['價格']."</td>";
												echo "<td>".$need[$i]['張數']."</td>";
												echo "<td>".$need[$i]['委託到期日']."</td>";
												echo "<td>".$need[$i]['把握度']."%</td>";
												echo "<td>".$need[$i]['進度']."</td>";
											}
										}
									} ?>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="note-sec">
						<table class="table-responsive">
							<thead>
								<tr>
									<th>需求者</th>
									<th>股名</th>
									<th>賣價</th>
									<th>張數</th>
									<th>委託到期日</th>
									<th>把握度</th>
									<th>進度</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<?php if ($need) {
										for ($i=0; $i < count($need); $i++) {
											if ($need[$i]['買賣']==0) {
												echo "<td>".$need[$i]['需求者']."</td>";
												echo "<td>".$need[$i]['股名']."</td>";
												echo "<td>".$need[$i]['價格']."</td>";
												echo "<td>".$need[$i]['張數']."</td>";
												echo "<td>".$need[$i]['委託到期日']."</td>";
												echo "<td>".$need[$i]['把握度']."%</td>";
												echo "<td>".$need[$i]['進度']."</td>";
											}
										}
									} ?>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="sec-two sec-s">
			<div style="background-color:#9F1CFF;" class="row row-s-1">
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
							<thead class="thead-light">
								<th>需求者</th>
								<th>股名</th>
								<th>買或賣</th>
								<th>價格</th>
								<th>張數</th>
								<th>委託到期日</th>
								<th>把握度(0~100%)</th>
								<th colspan="2">進度</th>
							</thead>
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
									<input type="checkbox">
									<label class="text-primary"><b>可議價</b></label>
								</td>
								<td>
									<input type="text" name="張數">
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
		 					if ($employees[$i]['NAME']!='盤商'&&$employees[$i]['NAME']!='庫存') { ?>
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
		 		<div class="sec-content">
		 			<h4>工單內容</h4>
		 			<div class="note-sec">
						<textarea cols="120" rows="5" name="工單內容"></textarea>
						<button type="submit" form="assign">送出</button>
		 			</div>
		 		</div>
			</form>
	 	</div>
	</div>
</main>