	<main id="mainSection" role="main" class="col-md-9 col-lg-10 pt-3 px-4">
		<div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
     		<h1 class="h2">轉讓紀錄</h1>
		</div>
		<div class="t-form">

			<table class="table" id="tblEditor">
				<thead class="thead-light">
					<?php if ($_SESSION['NAME'] == '小祿' || $_SESSION['NAME'] == 'Anthony') { ?>
					<tr>
						<td class="cell">
							<form action="turn_passrecord" method="post" id="turn_passrecord">
								<button type="submit" form="turn_passrecord">補齊轉讓紀錄</button>
							</form>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<th nowrap="nowrap">媒合編號</th>
						<th nowrap="nowrap">日期</th>
						<th nowrap="nowrap">姓名</th>
						<th nowrap="nowrap">買賣</th>
						<th nowrap="nowrap">業務</th>
						<th nowrap="nowrap">標的名稱</th>
						<th nowrap="nowrap">張數</th>
						<th nowrap="nowrap">成交價</th>
						<th nowrap="nowrap">盤價</th>
						<th nowrap="nowrap">價差</th>
						<th nowrap="nowrap">稅金</th>
						<th nowrap="nowrap">過戶費</th>
						<th nowrap="nowrap">金額</th>
						<th nowrap="nowrap">自得比率</th>
						<th nowrap="nowrap">自行應付</th>
						<th nowrap="nowrap">扣款利息</th>
						<th nowrap="nowrap">個人實得</th>
						<th nowrap="nowrap">營業支出</th>
						<th nowrap="nowrap">公司</th>
						<th nowrap="nowrap">匯款日期</th>
						<th nowrap="nowrap">轉讓會員</th>
						<th nowrap="nowrap">備註</th>
						<th nowrap="nowrap">狀態</th>
						<th nowrap="nowrap">修改</th>
						<th nowrap="nowrap">刪除</th>
					</tr>
				</thead>
				<?php if ($_SESSION['權限名稱'] == '最高權限') { ?>
				<tbody>
					<?php if ($data) {
					for ($i=0; $i < count($data); $i++) { ?>
					<tr>
						<!-- <td class="cell"><?php echo $data[$i]['ID']; ?></td> -->
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="媒合"'; ?>><?php echo $data[$i]['媒合']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="日期"'; ?>><?php echo $data[$i]['日期']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="姓名"'; ?>><?php echo $data[$i]['姓名']; ?></td>
						<!-- <td class="cell"><?php if ($data[$i]['買賣'] == 1) {
								echo "買";
							} elseif($data[$i]['買賣'] == 0) {
								echo "賣";
							} ?>	
						</td> -->
						<?php
						if ($data[$i]['買賣'] == 1 ) {
				          	echo "<td class='text-danger'><b>買</b></td>";
				        } else {
				          	echo "<td class='text-primary'><b>賣</b></td>";
				        }
						?>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="業務"'; ?>><?php echo $data[$i]['業務']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="標的名稱"'; ?>><?php echo $data[$i]['標的名稱']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="張數"'; ?>><?php echo $data[$i]['張數']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="成交價"'; ?>><?php echo $data[$i]['成交價']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="盤價"'; ?>><?php echo $data[$i]['盤價']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="價差"'; ?>><?php echo $data[$i]['價差']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="稅金"'; ?>><?php echo $data[$i]['稅金']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="過戶費"'; ?>><?php echo $data[$i]['過戶費']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="金額"'; ?>><?php echo $data[$i]['金額']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="自得比率"'; ?>><?php echo $data[$i]['自得比率']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="自行應付"'; ?>><?php echo $data[$i]['自行應付']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="扣款利息"'; ?>><?php echo $data[$i]['扣款利息']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="個人實得"'; ?>><?php echo $data[$i]['個人實得']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$i.'"'. 'data-type="營業支出"'; ?>><?php echo $data[$i]['營業支出']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="公司"'; ?>><?php echo $data[$i]['公司']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="匯款日期"'; ?>><?php echo $data[$i]['匯款日期']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="轉讓會員"'; ?>><?php echo $data[$i]['轉讓會員']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['ID'].'"'. 'data-type="備註"'; ?>><?php echo $data[$i]['備註']; ?></td>
						<!-- <td class="cell"><?php echo $data[$i]['狀態']; ?></td> -->
						<?php
						if ($data[$i]['狀態'] == '已結案') {
							if ($data[$i]['買賣'] == 1 ) {
					          	echo "<td class='text-danger'><b>已結</b></td>";
					        } else {
					          	echo "<td class='text-primary'><b>已結</b></td>";
					        }
						} else {
							if ($data[$i]['買賣'] == 1 ) {
					          	echo "<td class='text-danger'><b>未結案</b></td>";
					        } else {
					          	echo "<td class='text-primary'><b>未結案</b></td>";
					        }
						}
						
						?>

					</tr>

					<?php }
					}?>
				</tbody>
				<?php } else { ?>
				<tbody>
					<?php if ($data) {
					for ($i=0; $i < count($data); $i++) { ?>
					<tr>
						<!-- <td class="cell"><?php echo $data[$i]['ID']; ?></td> -->
						<td class=""><?php echo $data[$i]['媒合']; ?></td>
						<td class=""><?php echo $data[$i]['日期']; ?></td>
						<td class=""><?php echo $data[$i]['姓名']; ?></td>
						<!-- <td class="cell"><?php if ($data[$i]['買賣'] == 1) {
								echo "買";
							} elseif($data[$i]['買賣'] == 0) {
								echo "賣";
							} ?>	
						</td> -->
						<?php
						if ($data[$i]['買賣'] == 1 ) {
				          	echo "<td class='text-danger'><b>買</b></td>";
				        } else {
				          	echo "<td class='text-primary'><b>賣</b></td>";
				        }
						?>
						<td class=""><?php echo $data[$i]['業務']; ?></td>
						<td class=""><?php echo $data[$i]['標的名稱']; ?></td>
						<td class=""><?php echo $data[$i]['張數']; ?></td>
						<td class=""><?php echo $data[$i]['成交價']; ?></td>
						<td class=""><?php echo $data[$i]['盤價']; ?></td>
						<td class=""><?php echo $data[$i]['價差']; ?></td>
						<td class=""><?php echo $data[$i]['稅金']; ?></td>
						<td class=""><?php echo $data[$i]['過戶費']; ?></td>
						<td class=""><?php echo $data[$i]['金額']; ?></td>
						<td class=""><?php echo $data[$i]['自得比率']; ?></td>
						<td class=""><?php echo $data[$i]['自行應付']; ?></td>
						<td class=""><?php echo $data[$i]['扣款利息']; ?></td>
						<td class=""><?php echo $data[$i]['個人實得']; ?></td>
						<td class=""><?php echo $data[$i]['營業支出']; ?></td>
						<td class=""><?php echo $data[$i]['公司']; ?></td>
						<td class=""><?php echo $data[$i]['匯款日期']; ?></td>
						<td class=""><?php echo $data[$i]['轉讓會員']; ?></td>
						<td class=""><?php echo $data[$i]['備註']; ?></td>
						<!-- <td class="cell"><?php echo $data[$i]['狀態']; ?></td> -->
						<?php
						if ($data[$i]['狀態'] == '已結案') {
							if ($data[$i]['買賣'] == 1 ) {
					          	echo "<td class='text-danger'><b>已結</b></td>";
					        } else {
					          	echo "<td class='text-primary'><b>已結</b></td>";
					        }
						} else {
							if ($data[$i]['買賣'] == 1 ) {
					          	echo "<td class='text-danger'><b>未結案</b></td>";
					        } else {
					          	echo "<td class='text-primary'><b>未結案</b></td>";
					        }
						}
						
						?>

					</tr>

					<?php }
					}?>
				</tbody>
				<?php }?>
				
			</table>
		</div>
		<!-- <div title="【双击可直接修改】" class="changeSort" id="{$id}">{$sort}</div> -->
	</main>

 <!--script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.js"></script>
 <script> var jq161 = jQuery.noConflict(true); </script-->

 <script type="text/javascript">

        jQuery(function($){

            //加上點選進入編輯模式的事件
            $("td.cell").on("dblclick", function (event) {
                //若已有其他欄位在編輯中，強制結束
                if (window.$currEditing)
                    finishEditing($currEditing);
                var $cell = $(this);
                console.log('>>> dbclick: ' + $cell.data('row') + ' ' + $cell.data('type'));
                var $inp = $("<input type='text' id=editing />");
                $inp.val($cell.text());
                $cell.addClass("cell-editor").html("").append($inp);
                $inp[0].select();
                window.$currEditing = $inp;
            }).on("click", function () {
                //點選其他格子，強制結束目前的編輯欄
                if (window.$currEditing
                    //排除點選目前編輯欄位的情況
                    && $currEditing.parent()[0] != this)
                    finishEditing($currEditing);
            });
            //加上按Enter/Tab切回原來Text的事件
            $("table").on("keydown", "input", function (e) {
                if (e.which == 13 || e.which == 9) {
                    finishEditing($(this));
                }
            });
            //結束編輯模式

            function finishEditing($inp) {
            	// alert($inp.val());
            	var data = $inp.val();
            	var $cell = $inp.parent();
            	console.log('>>> dbclick: ' + $cell.data('row') + ' ' + $cell.data('type') + ' ' + data);
            	// alert(data);
            	// var x = document.getElementsByTagName("TD")[1].getAttribute("class");
            	/*alert(x);
            	console.log(x);
            	var y = document.getElementsByTagName("TD")[1].getAttribute("data-type");
            	alert(y);
            	console.log(y);*/
		        $.ajax({
		            type: "POST",
		            data: {id:$cell.data('row'), type:$cell.data('type'), data:data},
		            url: "<?=base_url()?>index.php/orders/passrecord_edit",
		            dataType: "json",
		            success: function(data) {
		                // alert(data);
		            },
		            error: function(jqXHR,data) {
		                alert("發生錯誤: " + jqXHR.status);
		            }
		        })
                $inp.parent().removeClass("cell-editor").text($inp.val());
                window.$currEditing = null;

            }
        });



    </script>
</body>
</html>