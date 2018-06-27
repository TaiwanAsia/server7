
          <div class="t-form">
            <table id="receivTable" class="table table-md table-hover table-responsive" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>
              <thead class="thead-light">
                <tr>
                <!-- <th data-tablesaw-priority="1">編號</th> -->
                <th data-tablesaw-priority="1">日期</th>
                <th data-tablesaw-priority="1">轉出</th>
                <th data-tablesaw-priority="1">轉入</th>
                <th data-tablesaw-priority="1">帳號</th>
                <th data-tablesaw-priority="1">備註</th>
                <th data-tablesaw-priority="1">是否已對帳</th>
              </thead>
            <tbody>
                <?php if($data) {
                    for($i=0; $i<count($data); $i++) { 
                      if ($data[$i]['是否已對帳'] == 1) {
                        echo "<tr bgcolor='#FFFF77'>";
                      } else {
                        echo "<tr>";
                      }
                ?>
                    <!-- <td>
                      <?php echo ($data[$i]['id']) ?>
                    </td> -->
                    <td>
                      <?php echo ($data[$i]['日期']) ?>
                    </td>
                    <td>
                      <?php echo ($data[$i]['轉出']) ?>          
                    </td>
                    <td>
                      <?php echo ($data[$i]['轉入']) ?>
                    </td>
                    <td>
                      <?php echo ($data[$i]['帳號']) ?>
                    </td>
                    <td>
                      <?php echo ($data[$i]['備註']) ?>
                    </td>
                    <?php if ($data[$i]['是否已對帳'] == 1) {
                      echo "<td>已對帳</td>";
                    } else {
                      echo "<td>N</td>";
                    }
                    ?>
                </tr>
                <?php }} ?>
            </tbody>
          </table>
          </div>
        </main>
      </div>
    </div>
  </body>
    <script type="text/javascript">

    $("#receFileUpload").change(function(){
      fileName = $(this)[0].files[0].name;
       $('.filename_zone').html(fileName);
      console.log("fileName" + fileName);
      });
    </script>
</html>
