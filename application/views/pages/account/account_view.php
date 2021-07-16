
<main id="mainSection" role="main" style="font-family:微軟正黑體;">
        <div class="d-flex flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom t-form-t t-form-t">
            <h1 class="h2">帳號管理</h1>
            <div style="position: relative;top: 8px;left: 30px;z-index: -100;">
                <form action="go_add_employee" method="POST">
                    <input type="submit" name="" value="新增">
                </form>
            </div>
            <!-- 未完成 -->
<!--			<ul>-->
<!--				<li style="display:inline;">-->
<!--					<a href="account"><font size="4">帳號編輯</font></a>-->
<!--				</li>-->
<!--				<li style="display:inline;">-->
<!--					<a href="authority"><font size="4">權限編輯</font></a>-->
<!--				</li>-->
<!--			</ul>-->
		</div>

		<div class="t-form">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<!-- <th nowrap="nowrap">編號</th> -->
						<th nowrap="nowrap"></th>
						<th nowrap="nowrap">帳號</th>
<!--						<th nowrap="nowrap">密碼</th>-->
						<th nowrap="nowrap">權限</th>
						<th nowrap="nowrap">趴數</th>
						<th nowrap="nowrap">勞保</th>
						<th nowrap="nowrap">健保</th>
						<th nowrap="nowrap">勞退</th>
						<th nowrap="nowrap">隱藏</th>
						<th nowrap="nowrap"></th>
						<th nowrap="nowrap"></th>
					</tr>
				</thead>
				<tbody>
				<?php
				if (isset($data)) {
					for ($i=0; $i<count($data); $i++) {
						echo "<tr>";
						// echo "<td>".$data[$i]['ID']."</td>";
						echo "<td>".$data[$i]['NAME']."</td>";
						echo "<td>".$data[$i]['ACCOUNT']."</td>";
//						echo '<td nowrap="nowrap">'.$data[$i]['PASSWORD']."</td>";
						echo "<td>".$data[$i]['權限名稱']."</td>";
						echo "<td>".$data[$i]['趴數']."</td>";
						echo "<td>".$data[$i]['勞保']."</td>";
						echo "<td>".$data[$i]['健保']."</td>";
						echo "<td>".$data[$i]['勞退']."</td>";
						if ($data[$i]['隱藏'] == 1) {
							echo "<td>開啟</td>";						
						} else {
							echo "<td>關閉</td>";	
						}
						echo '<td>
							<form action="go_edit_employee" method="GET" style= "display:inline">
							<input type="hidden" name="employee_id" value="'.$data[$i]['ID'].'">
							<input type="submit" value="編輯">
							</form>
							</td>';?>
                        <td>
                            <a href="delete_employee?id=<?=$data[$i]['ID']?>&name=<?=$data[$i]['NAME']?>" onclick="return confirm('確定刪除嗎?');">刪除</a>
                        </td>
						<?php echo "</tr>";
					}
				}
				?>
				</tbody>
			</table>
		</div>
	</main>
