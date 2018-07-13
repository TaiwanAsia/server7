<!DOCTYPE html>
 
<html>
<head>
    <title>Editable Table with jQuery</title>
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.1.js" 
             type="text/javascript"></script>
    <script type="text/javascript">
        var notifyConfig = {
            body: '\\ ^o^ /', // 設定內容
            icon: '/images/favicon.ico' // 設定 icon
        };

        if (Notification.permission === 'default' || Notification.permission === 'undefined') {
            Notification.requestPermission(function (permission) {
            if (permission === 'granted') { // 使用者同意授權
                var notification = new Notification('Hi there!', notifyConfig); // 建立通知
            }
          });
        }
    </script>
    
</head>
<body>
    <table id="tblEditor"></table>
</body>
</html>