	<main id="mainSection" role="main" class="col-md-9 col-lg-10 pt-3 px-4">
		<div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
     		<h1 class="h2">已新增列表</h1>
		</div>
		<div class="t-form">

			<table class="table" id="tblEditor">
				<thead class="thead-light">
					<!-- <?php if ($_SESSION['NAME'] == '小祿' || $_SESSION['NAME'] == 'Anthony') { ?>
					<tr>
						<td class="cell">
							<form action="turn_passrecord" method="post" id="turn_passrecord">
								<button type="submit" form="turn_passrecord">補齊轉讓紀錄</button>
							</form>
						</td>
					</tr>
					<?php } ?> -->
					<tr>
						<th nowrap="nowrap"></th>
						<th nowrap="nowrap">媒合編號</th>
						<th nowrap="nowrap">成交日期</th>
						<th nowrap="nowrap">股票名稱</th>
						<th nowrap="nowrap">業務</th>
						<th nowrap="nowrap">買賣</th>
						<th nowrap="nowrap">張數</th>
						<th nowrap="nowrap">主要</th>
						<th nowrap="nowrap"></th>
					</tr>
				</thead>
				<?php if ($_SESSION['權限名稱'] == '最高權限') { ?>
				<tbody>
					<?php if ($data) {
					for ($i=0; $i < count($data); $i++) { ?>
					<tr>
						<!-- <td class="cell"><?php echo $data[$i]['id']; ?></td> -->
						<td class="cell" <?php echo 'data-row="'.$data[$i]['id'].'"'. 'data-type="id"'; ?>><?php echo $data[$i]['id']; ?>
						</td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['id'].'"'. 'data-type="媒合編號"'; ?>><?php echo $data[$i]['媒合編號']; ?>
						</td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['id'].'"'. 'data-type="成交日期"'; ?>><?php echo $data[$i]['成交日期']; ?>
						</td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['id'].'"'. 'data-type="股票名稱"'; ?>><?php echo $data[$i]['股票名稱']; ?>
						</td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['id'].'"'. 'data-type="業務"'; ?>><?php echo $data[$i]['業務']; ?></td>
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
						<td class="cell" <?php echo 'data-row="'.$data[$i]['id'].'"'. 'data-type="張數"'; ?>><?php echo $data[$i]['張數']; ?>
							
						</td>
						<td class="cell" <?php echo 'data-row="'.$data[$i]['id'].'"'. 'data-type="主要"'; ?>><?php echo $data[$i]['主要']; ?>
							
						</td>
						<td>
							<form action="delete_add_quene_by_matchid" method="post">
								<input type="hidden" name="id" value="<?php echo $data[$i]['id'];?>">
								<input type="hidden" name="媒合編號" value="<?php echo $data[$i]['媒合編號'];?>">
								<button type="submit">刪除</button>
							</form>
							
						</td>

					</tr>

					<?php }
					}?>
				</tbody>
				<?php } ?>
				
			</table>
		</div>
		<!-- <div title="【双击可直接修改】" class="changeSort" id="{$id}">{$sort}</div> -->
	</main>

 <!--script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.js"></script>
 <script> var jq161 = jQuery.noConflict(true); </script-->

 <script type="text/javascript">

        /*
        jQuery(function($){

            //加上點選進入編輯模式的事件
            $("td.cell").on("dblclick", function (event) {
                //若已有其他欄位在編輯中，強制結束
                if (window.$currEditing)
                    finishEditing($currEditing);
                var $cell = $(this);
                var $inp = $("<input type='text' id=editing />");
                $inp.val($cell.text());
                var original_data = $inp.val();
                console.log('>>> dbclick: ' + $cell.data('row') + ' ' + $cell.data('type') + ' ' + original_data);
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
            	var data = $inp.val();
            	var $cell = $inp.parent();
            	console.log('>>> dbclick: ' + $cell.data('row') + ' ' + $cell.data('type') + ' ' + data);
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
        */



    </script>
</body>
</html>