
	<main id="mainSection" role="main" style="font-family:微軟正黑體;">
		<div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
     		<h1 class="h2">公佈欄</h1>
     		<!-- <?php 
			for ($j=0; $j < count($reply); $i++) { ?>
				<p>
					<?php echo $reply[$j]['回覆內容']; ?>
					<?php echo $reply[$j]['建立者']; ?>
				</p>
			<?php } ?> -->
		</div>

		<div class="t-form">
			<table id="billboardTable" class="table">
				<thead class="thead-light">
					<tr >
						<th nowrap="nowrap">對象</th>
						<th nowrap="nowrap">屬性</th>
						<th nowrap="nowrap">附件</th>
						<th nowrap="nowrap" colspan="">建立者</th>
						<th nowrap="nowrap">建立時間</th>
						<th colspan="3"></th>

					</tr>
				</thead>
				<tbody>
					<?php if($data[0]) { for ($i=0; $i < count($data[0]); $i++) { ?>
					<tr>

						<td>
							<!-- <?php echo $data[0][$i]['ID']; ?> -->
							<?php echo '給 <b>'.$data[0][$i]['工單對象'].'</b>'; ?>
						</td>
						<td>
							<?php echo $data[0][$i]['工單屬性']; ?>
						</td>
						<td>
							<div>
					 			<?php
					 			$exist = false;
					 			if (file_exists("upload/attachment/".$data[0][$i]['ID'].".jpg")) {
					 				$exist = "jpg";
					 			}
					 			if (file_exists("upload/attachment/".$data[0][$i]['ID'].".png")) {
					 				$exist = "png";
					 			}
					 			if (file_exists("upload/attachment/".$data[0][$i]['ID'].".xls")) {
					 				$exist = "xls";
					 			}
					 			if (file_exists("upload/attachment/".$data[0][$i]['ID'].".xlsx")) {
					 				$exist = "xlsx";
					 			}
					 			if (file_exists("upload/attachment/".$data[0][$i]['ID'].".csv")) {
					 				$exist = "csv";
					 			}
					 			if ($exist) { ?>
					 				<!-- <a class="clickable_hint" href="<?='../../upload/attachment/'.$data[0][$i]['ID']?>" target="_blank">檢視（點開檢視檔案）</a> -->
					 				<a href="<?php echo "../../upload/attachment/".$data[0][$i]['ID'].".".$exist ?>" download="<?php echo $data[0][$i]['ID'].".".$exist ?>" >下載夾帶檔案
					 					<img src="../../static/icon_attachment2.jpg" width="40" height="40">
					 				</a>
					 			<?php } else { ?>
			                	<form method="post" action="upload_attachment" enctype="multipart/form-data">
				                  	<div class="form-group">
				                      	<input type="file" name="file" class="f-file-s" id="exampleFormControlFile1">
				                      	<input type="hidden" name="id" value="<?php echo $data[0][$i]['ID']?>">
				                      	<button type="submit" id="" name="" class="">上傳</button>
				                  	</div>
				                </form>
				            	<?php } ?>
					 		</div>
						</td>
						<td>
							<?php echo '從 <b>'.$data[0][$i]['建立者'].'</b>'; ?>
						</td>
						<td>
							<?php echo $data[0][$i]['建立時間']; ?>
						</td>
						<!-- <td class="bb-btn">
							<span class="btn-pl"></span>
						</td> -->
						<td>
							<form method="get" action="delete_assign">
								<input type="hidden" name="id" value="<?=$data[0][$i]['ID']?>">
								<button type="submit" class="">刪除</button>
							</form>
							
						</td>
					</tr>
					<tr class="ex-t-row">
						<td colspan="5">
							<p style="color: #CC0000">
							<!-- <?php echo $data[0][$i]['工單屬性']; ?> -->
							<?php echo '從　<b>'.$data[0][$i]['建立者'].'</b>　'.$data[0][$i]['建立時間'].'　　　　　　<b>'.$data[0][$i]['工單內容'].'</b>'; ?>
							</p>
						</td>
						<td class="bb-btn">
							<span class="btn-pl"></span>
						</td>
					</tr>

					<tr class="ex-t-row">

						<td colspan="4">
							<p style="color: #CC0000">
							<?php				
							for ($j=0; $j < count($data[1]); $j++) { 
								if ($data[0][$i]['ID'] == $data[1][$j]['a_ID']) {
								echo '<p style="color: black;background-color: #DDDDDD"><br>'.'從　<b>'.$data[1][$j]['建立者'].'</b>　'.$data[1][$j]['建立時間'].'　　　　　　<b>'.$data[1][$j]['回覆內容'].'</b><br>';
								}
							}
							?>
							</p>
						</td>
						<td height="150"  colspan="2">
							<form method="post" action="assign_reply">
								<input type="hidden" name="id" value="<?=$data[0][$i]['ID']?>">
								<textarea name="回覆內容" placeholder="回覆..." class="billtd" rows="4" cols="40"></textarea>
								
								<button type="submit">送出</button>
							</form>
							
						</td>
					</tr>

					<?php } }?>
					
				</tbody>
			</table>
		</div>
	</main>


</body>
</html>