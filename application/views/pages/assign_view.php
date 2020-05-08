
	<main id="mainSection" role="main">
		<div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
     		<h1 class="h2">公佈欄</h1>
		</div>

		<div class="t-form">
			<table id="billboardTable" class="table">
				<thead class="thead-light">
					<tr>
						<th nowrap="nowrap">對象</th>
						<th nowrap="nowrap">屬性</th>
						<th nowrap="nowrap">附件</th>
						<th nowrap="nowrap" colspan="">建立者</th>
						<th nowrap="nowrap">建立時間</th>
						<th colspan="3"></th>

					</tr>
				</thead>
				<tbody>
					<?php for ($i=0; $i < count($data); $i++) { ?>
					<tr>

						<td>
							<?php echo $data[$i]['ID']; ?>
							<?php echo $data[$i]['工單對象']; ?>
						</td>
						<td>
							<?php echo $data[$i]['工單屬性']; ?>
						</td>
						<td>
							<div class="sec-content">
					 			<?php
					 			$exist = false;
					 			if (file_exists("upload/attachment/".$data[$i]['ID'].".jpg")) {
					 				$exist = "jpg";
					 			}
					 			if (file_exists("upload/attachment/".$data[$i]['ID'].".png")) {
					 				$exist = "png";
					 			}
					 			if (file_exists("upload/attachment/".$data[$i]['ID'].".xls")) {
					 				$exist = "xls";
					 			}
					 			if (file_exists("upload/attachment/".$data[$i]['ID'].".xlsx")) {
					 				$exist = "xlsx";
					 			}
					 			if ($exist) { ?>
					 				<!-- <a class="clickable_hint" href="<?='../../upload/attachment/'.$data[$i]['ID']?>" target="_blank">檢視（點開檢視檔案）</a> -->
					 				<a href="<?php echo "../../upload/attachment/".$data[$i]['ID'].".".$exist ?>" download="<?php echo $data[$i]['ID'].".".$exist ?>" >點選下載</a>
					 			<?php } else { ?>
			                	<form method="post" action="upload_attachment" enctype="multipart/form-data">
				                  	<div class="form-group">
				                      	<input type="file" name="file" class="f-file-s" id="exampleFormControlFile1">
				                      	<input type="hidden" name="id" value="<?php echo $data[$i]['ID']?>">
				                      	<button type="submit" id="" name="" class="">上傳</button>
				                  	</div>
				                </form>
				            	<?php } ?>
					 		</div>
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
						<td>
							<form method="get" action="delete_assign">
								<input type="hidden" name="id" value="<?=$data[$i]['ID']?>">
								<button type="submit" class="btn btn-danger">刪除</button>
							</form>
							
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