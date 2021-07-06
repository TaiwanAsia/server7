
<main id="mainSection" role="main" style="font-family:微軟正黑體;">
		<div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
			<table>
				<tr>
					<h1 class="h2">文件下載</h1>
				</tr>
				<tr>
					<td>
						<input type ="button" onclick="history.back()" value="回到上一頁" class="btn btn-sm btn-outline-secondary">

					</td>

					<td>
						<form method="post" action="upload_document" enctype="multipart/form-data" id="upload">
			              	<div class="form-group">
				                <input type="file" name="file" class="" id="exampleFormControlFile1">
				                <button type="submit" id="" name="" class="" form="upload">上傳</button>
			              	</div>
			            </form>
					</td>
				</tr>
			</table>
		</div>

		<div class="t-form">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<!-- <th nowrap="nowrap">文件編號</th> -->
						<th nowrap="nowrap">文件名稱</th>
						<th nowrap="nowrap">下載</th>
						<th nowrap="nowrap"></th>
					</tr>
				</thead>
				<tbody>
					<?php for ($i=0; $i < count($file_info); $i++) { ?>
						<tr>
							<td><?php echo $file_info[$i]; ?></td>
							<td>
								<form action="document_download" method="POST">
									<input type="hidden" name="file" value="<?php echo $file_info[$i]; ?>">
									<button type="submit">下載</button>
								</form>
							</td>
							<td>
								<form action="document_delete" method="POST">
									<input type="hidden" name="file" value="<?php echo $file_info[$i]; ?>">
									<button type="submit">刪除</button>
								</form>
							</td>

						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</main>


</body>
</html>