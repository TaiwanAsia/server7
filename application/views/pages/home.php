<main role="main">
	<div class="container">
 		<div class="sec-one sec-s">
			<div class="row">
				<div class="col-xl-6">
					<div class="note-sec">
						<table>
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
									<td>小祿</td>
									<td>廣達電子</td>
									<td>23</td>
									<td>30</td>
									<td>2018/09/01</td>
									<td>80%</td>
									<td>50%</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-xl-6">
					<div class="note-sec">
						<h1>備註區塊</h1>
					</div>
				</div>
			</div>
		</div>

		<div class="sec-two sec-s">
			<div class="row row-s-1">
				<div class="col-xl-12">
					<span>股票名稱:</span>
					<input type="text" name="">
					<span><button>搜索</button></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<p>請務必確實填寫<font>完整標的名稱</font>四個字 <font>與真實會員名稱</font>	</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12">
					<table id="table1" class="table table-md table-hover table-responsive">
						<thead class="thead-light">
							<th>需求者</th>
							<th>買或賣</th>
							<th>張數</th>
							<th>委託到期日</th>
							<th>把握度(0~100%)</th>
							<th>進度</th>
						</thead>
						<tbody>
							<td>小祿</td>
							<td>
								<label>
									買<input type="radio" name="買賣" value="買">
								</label>
								<label>
									賣
								<input type="radio" name="買賣" value="賣">
								</label>
							</td>
							<td>
								<input type="text" name="張數">
							</td>
							<td>
								<input type="date" name="到期日" value="<?php echo date("Y-m-d");?>" >
							</td>
							<td>
								<input type="text" name="把握度">
							</td>
							<td>
								<input type="text" name="進度">
							</td>
							<td>
								<button type="submit">送出</button>
							</td>
						</tbody>
					</table>
				</div>
		 	</div>
		</div>

		<div class="sec-three sec-s">
	 		<div class="sec-content">
	 			<h4>工單</h4>
	 			<p>對象：</p>
	 			<ul>
	 				<li><input type="radio" name="工單" value="小祿">小祿</li>
	 				<li><input type="radio" name="工單" value="JOY">JOY</li>
	 				<li><input type="radio" name="工單" value="月珍">月珍</li>
	 				<li><input type="radio" name="工單" value="卓大哥">卓大哥</li>
	 				<li><input type="radio" name="工單" value="志霖">志霖</li>
	 				<li><input type="radio" name="工單" value="吉翔">吉翔</li>
	 				<li><input type="radio" name="工單" value="清木">清木</li>
	 				<li><input type="radio" name="工單" value="亭妤">亭妤</li>
	 				<li><input type="radio" name="工單" value="福泉">福泉</li>
	 				<li><input type="radio" name="工單" value="KAN">KAN</li>
	 				<li><input type="radio" name="工單" value="其他">其他</li>
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
	 			</ul>
	 		</div>
	 		<div class="sec-content">
	 			<h4>工單內容</h4>
	 			<div class="note-sec">
					<textarea cols="120" rows="5" name="工單內容">
						
					</textarea>
					<button type="submit">送出</button>
	 			</div>
	 		</div>
	 	</div>
	</div>
</main>