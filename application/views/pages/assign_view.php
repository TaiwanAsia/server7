
	<main id="mainSection" role="main" class="col-md-9 col-lg-10 pt-3 px-4">
		<div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
     		<h1 class="h2">公佈欄</h1>
		</div>

		<div class="t-form">
			<table id="billboardTable" class="table">
				<thead class="thead-light">
					<tr>
						<th nowrap="nowrap">對象</th>
						<th nowrap="nowrap">屬性</th>
						<!-- <th nowrap="nowrap">內文</th> -->
						<th nowrap="nowrap" colspan="">建立者</th>
						<th nowrap="nowrap">建立時間</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php for ($i=0; $i < count($data); $i++) { ?>
					<tr>

						<td>
							<?php echo $data[$i]['工單對象']; ?>
						</td>
						<td>
							<?php echo $data[$i]['工單屬性']; ?>
						</td>
						<td>
							<?php echo $data[$i]['建立者']; ?>
						</td>
						<td>
							<?php echo $data[$i]['建立時間']; ?>
						</td>
						<td class="bb-btn">
							<span class="btn-pl"></span>
						</td>
					</tr>
					<tr class="ex-t-row">
						<td colspan="6" class="billtd">
							<p>
							<!-- <?php echo $data[$i]['工單屬性']; ?> -->
							<?php echo $data[$i]['工單內容']; ?>
							<!-- <?php echo $data[$i]['建立者']; ?> -->
						</p></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</main>


</body>
</html>