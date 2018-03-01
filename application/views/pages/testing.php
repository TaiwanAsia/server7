<html>
    <head>
    	<title></title>

    	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js"></script>

        <script type="text/javascript">
            var windowSizeArray = [ "width=100,height=100",
									"width=300,height=400,scrollbars=yes" ];

            $(document).ready(function(){
                $('.newWindow').click(function (event){

                    var url = $(this).attr("href");
                    var windowName = "popUp";//$(this).attr("name");
                    var windowSize = windowSizeArray[$(this).attr("rel")];
                    window.open('http://www.google.com','GoogleWindow', 'width=400, height=300');
                    // window.open(url, windowName, windowSize);

                    event.preventDefault();

                });
            });
        </script>
    </head>

    <body>
        <a href="http://www.flashmn.com/" rel="0" class="newWindow" >click me</a>
        <a href="http://www.mnswf.com/" rel="1" class="newWindow" >click me</a>
    </body>
</html>