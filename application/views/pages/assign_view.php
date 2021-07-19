
	<main id="mainSection" role="main" style="font-family:微軟正黑體;">
        <h1 class="h2" style="margin: 10px;">工單</h1>
        <div class="sec-three sec-s">
            <form action="add_assign" method="post" id="assign">
                <div class="sec-content">
<!--                    <h4></h4>-->

                    <h4>對象</h4>
                    <ul>
                        <?php for ($i=0; $i < count($employees); $i++) {
                            if ($employees[$i]['NAME']!='盤商'&&$employees[$i]['NAME']!='庫存'&&$employees[$i]['NAME']!='吉翔看單'&&$employees[$i]['NAME']!='KO'&&$employees[$i]['隱藏']==1) { ?>
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
                    <h4>等級</h4>
                    <ul>
                        <li>
                            <label>
                                <input type="radio" name="等級" value="normal">
                                一般
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="等級" value="important">
                                重要
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="等級" value="urgent">
                                重要且緊急
                            </label>
                        </li>
                    </ul>
                </div>

                <h4>工單內容</h4>
                <div>
                    <textarea cols="120" rows="5" name="工單內容"></textarea>
                    <button type="submit" form="assign">送出</button>
                </div>


            </form>
        </div>
	</main>


</body>
</html>