	<main id="mainSection" role="main" style="font-family:微軟正黑體;">
		<div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t">
     		<h1 class="h2">轉讓紀錄</h1>
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
                        <th nowrap="nowrap">刻印</th>
                        <th nowrap="nowrap">過戶費</th>
						<th nowrap="nowrap">金額</th>
                        <th nowrap="nowrap">差額</th>
						<th nowrap="nowrap">自得比率</th>
						<th nowrap="nowrap">自行應付</th>
						<th nowrap="nowrap">個人實得</th>
						<th nowrap="nowrap">公司</th>
						<th nowrap="nowrap">匯款日期</th>
						<th nowrap="nowrap">轉讓會員</th>
						<th nowrap="nowrap">狀態</th>
                        <th nowrap="nowrap">備註</th>
<!--						<th nowrap="nowrap">修改</th>-->
<!--						<th nowrap="nowrap">刪除</th>-->
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data as $k => $v) { ?>
					<tr>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="日期"'; ?>><?php echo $v['日期']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="姓名"'; ?>><?php echo $v['姓名']; ?></td>
						<?php
						if ($v['買賣'] == 1 ) {
				          	echo "<td class='text-danger'><b>買</b></td>";
				        } else {
				          	echo "<td class='text-primary'><b>賣</b></td>";
				        }
						?>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="業務"'; ?>><?php echo $v['業務']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="標的名稱"'; ?>><?php echo $v['標的名稱']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="張數"'; ?>><?php echo $v['張數']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="成交價"'; ?>><?php echo $v['成交價']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="盤價"'; ?>><?php echo $v['盤價']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="價差"'; ?>><?php echo $v['價差']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="稅金"'; ?>><?php echo $v['稅金']; ?></td>
                        <td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="刻印"'; ?>><?php echo $v['刻印']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="過戶費"'; ?>><?php echo $v['過戶費']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="金額"'; ?>><?php echo $v['金額']; ?></td>
                        <td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="差額"'; ?>><?php echo $v['差額']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="自得比率"'; ?>><?php echo $v['自得比率']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="自行應付"'; ?>><?php echo $v['自行應付']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="個人實得"'; ?>><?php echo $v['個人實得']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="公司"'; ?>><?php echo $v['公司']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="匯款日期"'; ?>><?php echo $v['匯款日期']; ?></td>
						<td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="轉讓會員"'; ?>><?php echo $v['轉讓會員']; ?></td>
						<?php
						if ($v['狀態'] == '已結案') {
							if ($v['買賣'] == 1 ) {
					          	echo "<td class='text-danger'><b>已結</b></td>";
					        } else {
					          	echo "<td class='text-primary'><b>已結</b></td>";
					        }
						} else {
							if ($v['買賣'] == 1 ) {
					          	echo "<td class='text-danger'><b>未結案</b></td>";
					        } else {
					          	echo "<td class='text-primary'><b>未結案</b></td>";
					        }
						} ?>
                        <td class="cell" <?php echo 'data-row="'.$v['ID'].'"'. 'data-type="備註"'; ?>><?php echo $v['備註']; ?></td>
					</tr>
                <?php } ?>


				
			</table>
		</div>
		<!-- <div title="【双击可直接修改】" class="changeSort" id="{$id}">{$sort}</div> -->
	</main>

    <style>
        th{
            text-align: center;
        }
    </style>

 <script type="text/javascript">

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
            	// alert($inp.val());
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



    </script>
</body>
</html>